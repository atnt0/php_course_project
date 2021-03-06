<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductPhotos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Webpatser\Uuid\Uuid;


class CartsController extends Controller
{

    /**
     * Pages
     */

    /**
     * Возвращает первую страницу корзины - список Товаров в корзине с возможностью их редактировать
     */
    public function cart() // может быть show?
    {
        $cart = session('cart');

        $cart = self::createCartIfNotExists($cart);
        session()->put('cart', $cart);
        session()->save();

        return view('carts.cart', compact('cart',));
    }


    /**
     * Возвращает данные Корзины со всеми Продуктами
     */
    public function checkout() // может быть show?
    {
        $cart = session('cart');

        $cart = self::createCartIfNotExists($cart);
        session()->put('cart', $cart);
        session()->save();




        // значения для генерирования формы
        $dataCart = [
            'select_method_payment' => [
                'name' => 'method_payment',
                'options' => [
                    'cashondelivery' => [
                        'selected' => true,
                        'title' => 'Сash on delivery',
                        'title_ua' => 'Післяплатою',
                        'title_ru' => 'Наложенным платежом',
                    ],
                    'сashpayment' => [
                        'title' => 'Сash payment',
                        'title_ua' => 'Готівкою',
                        'title_ru' => 'Наличными',
                    ],
                ]
            ],
            'select_method_delivery' => [
                'name' => 'method_delivery',
                'options' => [
                    'tobranch' => [
                        'selected' => true,
                        'title' => 'Delivery to the branch',
                        'title_ua' => 'Доставка до відділення',
                        'title_ru' => 'Доставка в отделение',
                    ],
                    'сourier' => [
                        'title' => 'Courier delivery to the address',
                        'title_ua' => 'Доставка кур\'єром на адресу',
                        'title_ru' => 'Доставка курьером на адрес',
                    ],
                    'selfpickup' => [
                        'title' => 'Self-pickup',
                        'title_ua' => 'Самовивіз',
                        'title_ru' => 'Самовывоз',
                    ],
                ],
            ],
        ];

        // тестовые значения для заполнения формы, в дальнейшем извлекать из сессии правильные данные
        $dataFrom = [
            'address' => [
                'city' => 'Киев',
                'zip' => '02000',
                'street' => 'просп. Героев Сталинграда',
                'house' => '7',
                'entrance' => '2',
                'floor' => '9',
                'apartment' => '48',
                'np_number' => '12',
            ],
            'name' => [
                'last' => 'Уваров',
                'first' => 'Егор',
                'patronymic' => 'Станиславович',
            ],
            'contact' => [
                'phone' => '+380509876543',
                'email' => 'you@and.you.too',
            ],
            'order' => [
                'comment' => '',
            ],
        ];




        return view('carts.checkout',
            compact('cart', 'dataCart', 'dataFrom'));
    }


    /**-
     * Events
     */

    /**
     * Добавление продукта в Корзину
     */
    public function addToCart(Request $request, $product_uuid)
    {
        $request->validate([
            'product_uuid' => 'required|uuid',
            'product_quantity' => 'required|integer|min:0|max:1000', // unsigned
        ]);

        $post_product_uuid = $request->get('product_uuid');
        $post_product_quantity = (int) $request->get('product_quantity');

        if( empty($post_product_quantity) || empty($product_uuid) || empty($post_product_uuid)  )
            abort(404);

        //todo добавить проверку на "скрытость" товара от лишних глазок
        $product = Product::where('uuid', '=', $product_uuid)->firstOrFail();

        if( empty($product) )
            abort(404);

        $result = '';

        $cart = session('cart');

        // создаем корзину
        $cart = self::createCartIfNotExists($cart);
        session()->put('cart', $cart);
        session()->save();


        //todo проверить есть ли необходимое количество на складе - quantity in stock

        // если в корзине нет данного продукта
        if ( !isset($cart['products'][$post_product_uuid]) ) {
            $newProduct = self::getStructureCartProductNew($cart, $product, [
                'post_quantity' => $post_product_quantity,
            ]);
            $cart['products'][$post_product_uuid] = $newProduct;

            session()->put('cart', $cart);
            session()->save();

            $result = 'add new';
        }
        else {
            $updateProduct = self::getStructureCartProductUpdated($cart, $cart['products'][$post_product_uuid], $product, [
                'add_quantity' => true,
                'post_quantity' => $post_product_quantity,
            ]);
            $cart['products'][$post_product_uuid] = $updateProduct;

            session()->put('cart', $cart);
            session()->save();

            $result = 'add quantity';
        }

        $cart = self::getCartWithRefreshedTotalPrice($cart);

        session()->put('cart', $cart);
        session()->save();

        // success
        return $result; //view('productphotos.createForProduct', compact('product'));
    }

    /**
     * Удаление продукта из Корзины
     */
    public function removeFromCart(Request $request, $product_uuid)
    {
        $request->validate([
            'remove_from_cart_product_uuid' => 'required|uuid',
        ]);

        $post_product_uuid = $request->get('remove_from_cart_product_uuid');

        if( empty($product_uuid) || empty($post_product_uuid) )
            abort(404);

        //todo добавить проверку на "скрытость" товара от лишних глазок
        $product = Product::where('uuid', '=', $product_uuid)->firstOrFail();

        if( empty($product) )
            abort(404);

        $result = '';

        $cart = session('cart');
        $cart = self::createCartIfNotExists($cart);
        session()->put('cart', $cart);
        session()->save();

        if ( isset($cart['products'][$post_product_uuid]) ) {
            unset($cart['products'][$post_product_uuid]);

            session()->put('cart', $cart);
            session()->save();

            $result = 'remove product';
        }


        $cart = self::getCartWithRefreshedTotalPrice($cart);

        session()->put('cart', $cart);
        session()->save();


        $cart = session('cart');

        // success
        return view('carts.parts._items', compact('cart'));
    }

    /**
     * Изменение количества Продукта в Корзине
     */
    public function changeQuantityProductInCart(Request $request, $product_uuid)
    {
        $request->validate([
            'product_uuid' => 'required|uuid',
            'product_quantity' => 'required|integer|min:0|max:1000', // unsigned
        ]);

        $post_product_uuid = $request->get('product_uuid');
        $post_product_quantity = (int) $request->get('product_quantity');

        if( empty($post_product_quantity) || empty($product_uuid) || empty($post_product_uuid)  )
            abort(404);

        //todo добавить проверку на "скрытость" товара от лишних глазок
        $product = Product::where('uuid', '=', $product_uuid)->firstOrFail();

        if( empty($product) )
            abort(404);

        $result = '';

        $cart = session('cart');

        // создаем корзину
        $cart = self::createCartIfNotExists($cart);
        session()->put('cart', $cart);
        session()->save();


        // если товар есть в корзине
        if ( isset($cart['products'][$post_product_uuid]) ) {

            $updateProduct = self::getStructureCartProductUpdated($cart, $cart['products'][$post_product_uuid], $product, [
                //'post_quantity' => $post_product_quantity,
                'post_quantity' => $post_product_quantity,
            ]);
            $cart['products'][$post_product_uuid] = $updateProduct;

            session()->put('cart', $cart);
            session()->save();

            $result = 'add quantity';


        }


        $cart = self::getCartWithRefreshedTotalPrice($cart);

        session()->put('cart', $cart);
        session()->save();



        $product_multi_price = $cart['products'][$post_product_uuid] ? $cart['products'][$post_product_uuid]['multi_price_float'] : 0.0;
        $cart_total_price = $cart['dataCart']['total_price_float'] ? $cart['dataCart']['total_price_float'] : 0.0;


        return response()->json ([
            'update' => [
                'product_in_cart' => [
                    'uuid' => $post_product_uuid,
                    'fields' => [
                        'multi_price' => $product_multi_price,
                    ],
                ],
                'cart' => [
                    'total_price' => $cart_total_price,
                ]
            ],
        ]);
    }

    /**
     * Обработка формы оформления заказа
     */
    public function checkoutSubmit(Request $request) {
        $request->validate([
            'method_payment' => 'required|string|min:4|max:30',
            'method_delivery' => 'required|string|min:4|max:30',

            'address_city' => 'required|string|min:4|max:30',
            'address_zip' => 'min:1|max:10',
            'address_street' => 'required|string|min:4|max:50', // ?
            'address_house' => 'required|string|min:1|max:10', // ?
            'address_entrance' => 'integer|min:1|max:20',
            'address_floor' => 'integer|min:1|max:100',
            'address_apartment' => 'required|string|min:1|max:5', // ?

            'address_np_number' => 'string|min:1|max:50', // ?

            'name_first' => 'string|min:1|max:100',
            'name_last' => 'string|min:1|max:100',
            'name_patronymic' => 'string|min:1|max:100',

            'contact_phone' => 'string|min:1|max:50',
            'contact_email' => 'string|min:1|max:255',
            'order_comment' => 'max:255',

        ]);

        $fields = $request->all();

        $order_comment = $request->get('order_comment');
        $contact_email = $request->get('contact_email');
        $contact_phone = $request->get('contact_phone');

        $name_patronymic = $request->get('name_patronymic');
        $name_last = $request->get('name_last');
        $name_first = $request->get('name_first');

        $address_np_number = $request->get('address_np_number');

        $address_apartment = $request->get('address_apartment');
        $address_floor = $request->get('address_floor');
        $address_entrance = $request->get('address_entrance');
        $address_house = $request->get('address_house');
        $address_street = $request->get('address_street');
        $address_zip = $request->get('address_zip');
        $address_city = $request->get('address_city');

        $user_own_id = Auth::user() != null ? Auth::user()->id : null;

        $guest_ip = '';
        $guest_useragent = '';
//        $guest_language = '';

        $cart = session('cart');

        if( !empty($cart) ) {

            if( isset($cart['guest']) ) {
                $guest_ip = $cart['guest']['ip'];
                $guest_useragent = $cart['guest']['user_agent'];
    //            $guest_language = $cart['guest']['language'];
            }


            $uuid = Uuid::generate()->string;

            //todo перенести логику создания заказа в OrderController?

            $order = new Order([
                'user_own_id' => $user_own_id,

                'uuid' => $uuid,

                'address_city' => $address_city,
                'address_zip' => $address_zip,
                'address_street' => $address_street,
                'address_house' => $address_house,
                'address_entrance' => $address_entrance,
                'address_floor' => $address_floor,
                'address_apart' => $address_apartment,

                'address_np_number' => $address_np_number,

                'client_first_name' => $name_first,
                'client_last_name' => $name_last,
                'client_patronymic_name' => $name_patronymic,

                'client_phone' => $contact_phone,
                'client_email' => $contact_email,
                'comment' => $order_comment,

                'guest_ip' => $guest_ip,
                'guest_useragent' => $guest_useragent,
            ]);


            $order->save();


            if( isset($cart['products']) ) {
                $arrayOrderProducts = [];

                foreach ($cart['products'] as $product) {
                    $arrayOrderProducts[] = [
                        'order_id' => $order->id, // может все таки uuid?
                        'product_id' => $product['id'], // может все таки uuid?
                        'quantity' => $product['quantity'],
                        'price' => $product['price'],
                    ];
                }
            }

            if (count($arrayOrderProducts) > 0) {
                foreach ($arrayOrderProducts as $orderProduct) {
                    Order::createReferenceOrderWithProduct($orderProduct);
                }
            }
        }








        // не получается через with, он просто не работает, значит используем сессию пока вручную
        // так же требуется очистка, при загрузке страницы
        session()->put('status', 'Order created!');

        return redirect()
            ->route('cart.checkout', []);
//            ->with('success', 'Order created!');

    }



    /**
     * Other methods
     */

    /**
     * Создаем Корзину если ее нет
     */
    private function createCartIfNotExists($cart) {
        if( empty($cart) || !isset($cart['products']) )
            $cart = self::getStructureCartNewWithGuestData();

        return $cart;
    }


    /**
     * Метод возвращает структуру для новой Корзины
     * */
    private function getStructureCartNewWithGuestData() : array
    {
        return [
            'guest' => [
                'ip' => $_SERVER['REMOTE_ADDR'],
                'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                'language' => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
                'referer' => $_SERVER['HTTP_REFERER'],
            ],
            'products' => [],
            'dataCart' => [
                'user_own_name' => '',
                'total_price' => 0,
                'total_price_float' => 0,
            ],
        ];
    }

    /**
     * Метод возвращает структуру нового Продукта
     * */
    private function getStructureCartProductNew($cart, $productFromDB, $dataArray = []) : array
    {
        $new_quantity = (int) (!empty($dataArray['post_quantity']) && $dataArray['post_quantity'] > 1 ? $dataArray['post_quantity'] : 1);

        $price_float = ProductsController::toPriceForDisplay($productFromDB->price);

        $multi_price = $productFromDB->price * $new_quantity;
        $multi_price_float = ProductsController::toPriceForDisplay($multi_price);

        //todo firstOrFail(); выдает ошибку
        $productPhoto = ProductPhotos::where('product_id', '=', $productFromDB->id)->orderBy('index', 'asc')->first();
        $dataProductPhoto = ProductPhotosController::getPreDataForPhoto($productPhoto);

        $newIndex = count($cart['products']) + 1;

        $productCart = [
            'index' => $newIndex,
            'id' => $productFromDB->id,
            'uuid' => $productFromDB->uuid,

            'title_ru' => $productFromDB->title_ru,
            'photo_main' => $dataProductPhoto,
            // for one item
            'price' => $productFromDB->price,
            'price_float' => $price_float, // for one item

            'quantity' => $new_quantity,
            // for all items
            'multi_price' => $multi_price,
            'multi_price_float' => $multi_price_float,
        ];

        return $productCart;
    }

    /**
     * Метод возвращает структуру обновленного Продукта
     */
    private function getStructureCartProductUpdated($cart, $productCart, $productFromDB, $dataArray = []) : array
    {
        // не "добавить количество", а "изменить на количество"

        $add_quantity = !empty($dataArray['add_quantity']) && $dataArray['add_quantity'];

        $in_new_quantity = (int) (!empty($dataArray['post_quantity']) && $dataArray['post_quantity'] > 1 ? $dataArray['post_quantity'] : 1);

        $now_quantity = $add_quantity ? $productCart['quantity'] + $in_new_quantity : $in_new_quantity;

//        dd([
//            'add_quantity' => $add_quantity,
//            'in_new_quantity' => $in_new_quantity,
//            'now_quantity' => $now_quantity,
//        ]);
        $productCart['quantity'] = $now_quantity;

        $multi_price = $productFromDB->price * $now_quantity;
        $multi_price_float = ProductsController::toPriceForDisplay($multi_price);

        $productCart['multi_price'] = $multi_price;
        $productCart['multi_price_float'] = $multi_price_float;

        return $productCart;
    }

    /**
     * Метод пересчитывает полную стоимость всех Продуктов в Корзине
     */
    private function getCartWithRefreshedTotalPrice($cart)
    {
//        if( isset($cart['products']) ) {
            $dataCart = $cart['dataCart'];

            $now_total_price = 0;
            foreach ($cart['products'] as $cart_product) {
                $now_total_price += $cart_product['multi_price'];
            }
            $dataCart['total_price'] = $now_total_price;

            $dataCart_total_price_float = ProductsController::toPriceForDisplay($dataCart['total_price']);
            $dataCart['total_price_float'] = $dataCart_total_price_float;

            $cart['dataCart'] = $dataCart;
//            dd('++');
//        }

        return $cart;
    }







}
