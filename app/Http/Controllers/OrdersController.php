<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProductPhotos;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use That0n3guy\Transliteration\Facades\Transliteration;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = Order::all();


        return view('orders.index', compact('orders', ));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $order = Order::where('uuid', '=', $uuid)->firstOrFail(); //->get();

        $products = $order->getProducts(); //TODO заменить на вызом через ссылки "morphToMany"

        $dataProducts = [];
        $dataOrder = [];

        $userOwn = User::find($order->user_own_id);

        $dataOrder['user_own_name'] = $userOwn ? $userOwn->name : '';

        $dataOrder['total_price'] = 0;
        $total_price_float = ProductsController::toPriceForDisplay(0, true);
        $dataOrder['total_price_float'] = $total_price_float;

        if( count($products) > 0 )
        {
            foreach ($products as $key => $product) {

                $user_own = User::find($product->user_own_id);
                $user_own_you = Auth::user() != null && $product->user_own_id == Auth::user()->id;

                $productPhoto = ProductPhotos::where('product_uuid', '=', $product->uuid)
                    ->orderBy('index', 'asc')->first(); //->firstOrFail(); // - выдает ошибку

                $dataProductPhoto = ProductPhotosController::getPreDataForPhoto($productPhoto);

                $price_float = ProductsController::toPriceForDisplay($product->op_price, true);
                $price_total = $product->op_quantity * $product->op_price;
                $price_multi_float = ProductsController::toPriceForDisplay($price_total, true);

                $total_price = (int) $dataOrder['total_price'] + (int) $price_total;
                $total_price_float = ProductsController::toPriceForDisplay($total_price, true);
                $dataOrder['total_price'] = $total_price;
                $dataOrder['total_price_float'] = $total_price_float;

                $dataProducts[$key] = [
                    'price_float' => $price_float,
                    'price_multi_float' => $price_multi_float,

                    'photo_main' => $dataProductPhoto,
                    //TODO может перенести в user?
                    'user_own' => [
                        'id' => $user_own->id,
                        'name' => $user_own->name,
                        'you' => $user_own_you, // " [id: ". $user_own->id ."]"
                    ],
                ];
            }
        }

        return view('orders.show', compact('order', 'dataOrder', 'products', 'dataProducts', ));
    }

//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function edit($id)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }







}
