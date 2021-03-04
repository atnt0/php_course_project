<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPhotos;
use Illuminate\Http\Request;


class CartsController extends Controller
{

    /**
     * Возвращает данные Корзины со всеми Продуктами
     */
    public function cart() // может быть show?
    {
//        dd($_SERVER);

        $cart = session('cart');

        return view('carts.cart', compact('cart',));
    }


    /**
     * Добавление продукта в Корзину
     */
    public function addToCart(Request $request, $product_uuid)
    {
        $request->validate([
            'add_to_cart_product_uuid' => 'required|uuid',
            'add_to_cart_quantity' => 'required|integer', // unsigned
        ]);

        $post_product_uuid = $request->get('add_to_cart_product_uuid');
        $post_quantity = (int) $request->get('add_to_cart_quantity');

        if( empty($post_quantity) || empty($product_uuid) || empty($post_product_uuid)  )
            abort(404);

        //todo добавить проверку на "скрытость" товара от лишних глазок
        $product = Product::where('uuid', '=', $product_uuid)->firstOrFail();

        if( empty($product) )
            abort(404);

        $result = '';

        $cart = session('cart');

        // создаем корзину
        if( empty($cart) || !isset($cart['products']) ) {
            $cart = self::getStructureCartNewWithGuestData();

            session()->put('cart', $cart);
            session()->save();

            $result = 'create cart and add new';
        }

        $cart = session('cart');
        $cart = self::createCartIfNotExists($cart);
        session()->put('cart', $cart);
        session()->save();


        //todo проверить есть ли необходимое количество на складе - quantity in stock

        // если в корзине нет данного продукта
        if ( !isset($cart['products'][$post_product_uuid]) ) {
            $newProduct = self::getStructureCartProductNew($cart, $product, [
                'post_quantity' => $post_quantity,
            ]);
            $cart['products'][$post_product_uuid] = $newProduct;

            session()->put('cart', $cart);
            session()->save();

            $result = 'add new';
        }
        else {
            $updateProduct = self::getStructureCartProductUpdated($cart, $cart['products'][$post_product_uuid], $product, [
                'post_quantity' => $post_quantity,
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
     * Создаем Корзину если ее нет
     */
    private function createCartIfNotExists($cart){
        if( empty($cart) || !isset($cart['products']) ) {
            $cart = self::getStructureCartNewWithGuestData();
        }

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
        $add_quantity = (int) (!empty($dataArray['post_quantity']) && $dataArray['post_quantity'] > 1 ? $dataArray['post_quantity'] : 1);

        $price_float = ProductsController::toPriceForDisplay($productFromDB->price);

        $multi_price = $productFromDB->price * $add_quantity;
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

            'quantity' => $add_quantity,
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
        $add_quantity = (int) (!empty($dataArray['post_quantity']) && $dataArray['post_quantity'] > 1 ? $dataArray['post_quantity'] : 1);

        $now_quantity = $productCart['quantity'] + $add_quantity;
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
