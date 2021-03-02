<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPhotos;
use App\Models\StatusProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;

class ProductsController extends Controller
{
    const PRODUCT_MONEY_FIX_NUMBER = 10000; // для точных операций с денежными значениями

    const PRODUCT_DEFAULT_STATUS_NAME = 'hiddencompletely'; //


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

//                $productPhoto = ProductPhotos::getProductPhotoByProductId($product->id)->first();
                $productPhoto = ProductPhotos::where('product_id', '=', $product->id)->orderBy('index', 'asc')->first();
//                dd($productPhoto->uuid);
                //TODO перенести в отдельный метод
                $dataProductPhoto = [
                    'uuid' => $productPhoto->uuid,
                    'description_ru' => $productPhoto->description_ru,
                    'link' => ProductPhotosController::PRODUCT_PHOTO_PUBLIC_DIRECTORY .'/'. $productPhoto->file_name,
                ];

                $dataProducts[$key] = [
                    'price_float' => $price_float,
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
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_ru' => 'required|min:4',
            'description_ru' => 'required|min:10',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
//            'tax' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'quantity' => 'required|integer', // unsigned
        ]);

        //$rr = self::PRODUCT_DEFAULT_STATUS_ID;

        $uuidNew  = Uuid::generate()->string;

        $product = new Product([
            'article_number' => 0, //TODO придумать как генерировать уникальный артикул
            'price' => $request->get('price') * self::PRODUCT_MONEY_FIX_NUMBER, // x 10000
            'tax' => $request->get('tax') * self::PRODUCT_MONEY_FIX_NUMBER, // x 10000
            'quantity' => $request->get('quantity'),
            'category_id' => 0,
            'user_own_id' => Auth::user()->id,
            'uuid' => $uuidNew,
            'title_ru' => $request->get('title_ru'),
            'description_ru' => $request->get('description_ru'),
            'meta_keywords' => '',
            'meta_description' => '',
        ]);

        $product->save();

        $defaultStatus = StatusProduct::where('name', '=', self::PRODUCT_DEFAULT_STATUS_NAME)->firstOrFail();

        if( !empty($defaultStatus) )
        {
            StatusProduct::createManyToManyWithStatus($product->id, $defaultStatus->id);
        }



        return redirect()
            ->route('product.show', [$product->uuid])
            ->with('success', 'Product saved!');
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
//        dd($product);

        if( empty($product) )
            abort(404);

        $productPhotos = ProductPhotos::getProductPhotoByProductId($product->id); // + product_uuid
//        dd($productPhotos);
//        $productPhotos = ProductPhotos::where('product_id', '=', $product->id)->get();

        $price_float = round($product->price / self::PRODUCT_MONEY_FIX_NUMBER, 2);
        $tax_float = round($product->tax / self::PRODUCT_MONEY_FIX_NUMBER, 2);

        $user_own = User::find($product->user_own_id);
        $user_own_you = Auth::user() != null && $product->user_own_id == Auth::user()->id;

        $dataProductPhotos = [];

        //TODO перенести в отдельный метод
        if( count($productPhotos) > 0 )
        {
            foreach ($productPhotos as $key => $productPhoto) {
                $dataProductPhotos[$key] = [
                    'uuid' => $productPhoto->uuid,
                    'description_ru' => $productPhoto->description_ru,
                    'link' => ProductPhotosController::PRODUCT_PHOTO_PUBLIC_DIRECTORY .'/'. $productPhoto->file_name,
                ];
            }
        }

        $dataProduct = [
            'price_float' => $price_float,
            'productPhotos' => $dataProductPhotos,
//            'tax_float' => $tax_float,
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
    public function edit($uuid)
    {
        $product = Product::where('uuid', '=', $uuid)->firstOrFail();

        if( empty($product) )
            abort(404);

        $price_float = round($product->price / self::PRODUCT_MONEY_FIX_NUMBER, 2);
        $tax_float = round($product->tax / self::PRODUCT_MONEY_FIX_NUMBER, 2);

        $user_own = User::find($product->user_own_id);
        $user_own_you = Auth::user() != null && $product->user_own_id == Auth::user()->id;

        $dataProduct = [
            'price_float' => $price_float,
//            'tax_float' => $tax_float,
            //TODO может перенести в user?
            'user_own' => [
                'id' => $user_own->id,
                'name' => $user_own->name,
                'you' => $user_own_you, // " [id: ". $user_own->id ."]"
            ],
        ];

        return view('products.edit', compact('product', 'dataProduct'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $request->validate([
            'title_ru' => 'required|min:4',
            'description_ru' => 'required|min:10',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
//            'tax' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'quantity' => 'required|integer',
        ]);

        $product = Product::where('uuid', '=', $uuid)->firstOrFail();

        if( empty($product) )
            abort(404);


        $product->title_ru = $request->get('title_ru');
        $product->description_ru = $request->get('description_ru');
        $product->price = $request->get('price') * self::PRODUCT_MONEY_FIX_NUMBER; // x 10000
        $product->tax = $request->get('tax') * self::PRODUCT_MONEY_FIX_NUMBER; // x 10000
        $product->quantity = $request->get('quantity');

        $product->save();

        return redirect()
            ->route('product.edit', [$product->uuid])
            ->with('success', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $product = Product::where('uuid', '=', $uuid)->firstOrFail();

        if( empty($product) )
            abort(404);

        $product->delete();

        return redirect()
            ->route('product.index')
            ->with('success', 'Product deleted!');
    }

    //TODO реализовать поиск

}
