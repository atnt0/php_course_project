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

//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        //
//    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

//        $order2 = Order::find(1);

//        $products = $order->products();
//
//        $arr = [];
//        foreach ($order2->products as $product) {
//            $arr[] = $product;
//        }

        $products = $order->getProducts(); //TODO заменить на вызом через ссылки "morphToMany"

        $dataProducts = [];

//        dd($products);

        $dataOrder = [];

        $userOwn = User::find($order->user_own_id);

        $dataOrder['user_own_name'] = $userOwn ? $userOwn->name : '';
        $dataOrder['total_price'] = 0;

        if( count($products) > 0 )
        {
            foreach ($products as $key => $product) {
                $price_float = round($product->price / ProductsController::PRODUCT_MONEY_FIX_NUMBER, 2);

                $user_own = User::find($product->user_own_id);
                $user_own_you = Auth::user() != null && $product->user_own_id == Auth::user()->id;

                $productPhoto = ProductPhotos::where('product_id', '=', $product->id)
                    ->orderBy('index', 'asc')->first(); //->firstOrFail(); // - выдает ошибку

                if( !empty($productPhoto) ){
//                    $tmpProductPhoto = $productPhoto->toArray();

                    //TODO перенести в отдельный метод
                    $dataProductPhoto = [
                        'uuid' => $productPhoto['uuid'],
                        'description_ru' => $productPhoto['description_ru'],
                        'link' => ProductPhotosController::PRODUCT_PHOTO_PUBLIC_DIRECTORY .'/'. $productPhoto['file_name'],
                    ];
                }
                else
                {
                    //TODO перенести в отдельный метод
                    $dataProductPhoto = [
                        'uuid' => '',
                        'description_ru' => 'not_found_image',
                        'link' => 'not_found_image',
                    ];
                }

                $price_total = $product->op_quantity * $price_float;
                $dataOrder['total_price'] += $price_total;

                $dataProducts[$key] = [
                    'price_float' => $price_float,
                    'price_total' => $price_total,

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


    /**
     * Create fake-order for tests
     */
    public function createFakeOrder()
    {


    }








}
