<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPhotos;
use Illuminate\Http\Request;


class CartsController extends Controller
{

    public function cart() // может быть show?
    {
        $cart = session('cart');

        return view('carts.cart', compact('cart',));
    }

    public function addToCart(Request $request, $product_uuid)
    {
        $request->validate([
            'add_to_cart_product_uuid' => 'required|uuid',
            'add_to_cart_quantity' => 'required|integer', // unsigned
        ]);

        $post_quantity = (int) $request->get('add_to_cart_quantity');
        $post_product_uuid = $request->get('add_to_cart_product_uuid');

        if( empty($post_quantity) || empty($product_uuid) || empty($post_product_uuid)  )
            abort(404);

        //todo добавить проверку на "скрытость" товара от лишних глазок
        $product = Product::where('uuid', '=', $product_uuid)->firstOrFail();

        if( empty($product) )
            abort(404);

        $add_quantity = $post_quantity > 1 ? $post_quantity : 1;


        $result = '';

        $cart = session('cart');

        // создаем корзину
        if( empty($cart) || !isset($cart['products']) ) {
            $cart = [
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
                ],
            ];

            session()->put('cart', $cart);
            session()->save();

            $result = 'create cart and add new';
        }


        //todo проверить есть ли необходимое количество на складе - quantity in stock

        // если в корзине нет данного продукта
        if ( !isset($cart['products'][$product_uuid]) ) {
            $price_float = ProductsController::toPriceForDisplay($product->price);

            $multi_price = $product->price * $add_quantity;
            $multi_price_float = ProductsController::toPriceForDisplay($multi_price);

            $productPhoto = ProductPhotos::where('product_id', '=', $product->id)
                ->orderBy('index', 'asc')->first(); //->firstOrFail(); // - выдает ошибку

            //TODO перенести в отдельный метод
            if( !empty($productPhoto) ){
                $dataProductPhoto = [
                    'uuid' => $productPhoto['uuid'],
                    'description_ru' => $productPhoto['description_ru'],
                    'link' => ProductPhotosController::PRODUCT_PHOTO_PUBLIC_DIRECTORY .'/'. $productPhoto['file_name'],
                ];
            }
            else
            {
                $dataProductPhoto = [
                    'uuid' => '',
                    'description_ru' => 'not_found_image',
                    'link' => 'not_found_image',
                ];
            }

            $cart['products'][$product_uuid] = [
                'index' => count($cart['products']) + 1,
                'id' => $product->id,
                'uuid' => $product->uuid,
                'price' => $product->price, // for one item
                'price_float' => $price_float, // for one item
                'title_ru' => $product->title_ru,
                'quantity' => $add_quantity,
                'multi_price' => $multi_price, // for all by quantity
                'multi_price_float' => $multi_price_float,
                'photo_main' => $dataProductPhoto,
            ];

            session()->put('cart', $cart);
            session()->save();

            $result = 'add new';
        }
        else {
//            $cart['products'][$product_uuid]['quantity']++;
            $cart['products'][$product_uuid]['quantity'] += $add_quantity;

            session()->put('cart', $cart);
            session()->save();

            $result = 'add quantity';
        }

        if( count($cart['products']) ) {
            foreach ($cart['products'] as $cart_product) {
                $cart['dataCart']['total_price'] += $cart_product['multi_price'];
            }

            $dataCart_total_price_float = ProductsController::toPriceForDisplay($cart['dataCart']['total_price']);
            $cart['dataCart']['total_price_float'] = $dataCart_total_price_float;

            session()->put('cart', $cart);
            session()->save();
        }

        // success
        return $result; //view('productphotos.createForProduct', compact('product'));
    }


}
