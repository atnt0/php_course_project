<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    const PRODUCT_MONEY_FIX_NUMBER = 10000; // для точных операций с денежными значениями

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$products = Product::all();
        $products = Product::getProducts();

        if( empty($products) )
            abort(404);

        $dataProducts = [[]];

        //todo требуется реализовать Пагинацию

        //TODO разобрать на отдельные методы
        if( count($products) > 0 ) {
            foreach ($products as $key => $product) {
                $price_float = round($product->price / self::PRODUCT_MONEY_FIX_NUMBER, 2);

                $user_own = User::find($product->user_own_id);
                $user_own_you = Auth::user() != null && $product->user_own_id == Auth::user()->id;



                $dataProducts[$key] = [
                    'price_float' => $price_float,
                    //TODO может перенести в user?
                    'user_own' => [
                        'id' => $user_own->id,
                        'name' => $user_own->name,
                        'you' => $user_own_you, // " [id: ". $user_own->id ."]"
                    ],
                ];
            }
        }

        // получить список тегов продукта
        // получить список фотографий продукта в сортированном виде по порядку


        return view('products.index', compact('products', 'dataProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function show($id)
    public function show($uuid)
    {
        $product = Product::getProduct($uuid);


        if( empty($product) )
            abort(404);

        $dataProduct = [];

        $price_float = round($product->price / self::PRODUCT_MONEY_FIX_NUMBER, 2);

        $user_own = User::find($product->user_own_id);
        $user_own_you = Auth::user() != null && $product->user_own_id == Auth::user()->id;



        $dataProduct = [
            'price_float' => $price_float,
            //TODO может перенести в user?
            'user_own' => [
                'id' => $user_own->id,
                'name' => $user_own->name,
                'you' => $user_own_you, // " [id: ". $user_own->id ."]"
            ],
        ];

        return view('products.show', compact('product', 'dataProduct'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

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
