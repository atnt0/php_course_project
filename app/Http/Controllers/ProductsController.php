<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategories;
use App\Models\ProductPhotos;
use App\Models\StatusProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use That0n3guy\Transliteration\Facades\Transliteration;
use Webpatser\Uuid\Uuid;
//use Illuminate\Support\Facades\Session as Session;

class ProductsController extends Controller
{
    //todo убрать паблик
    public const PRODUCT_MONEY_FIX_NUMBER = 10000; // для точных операций с денежными значениями

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
                $price_float = self::toPriceForDisplay($product->price, true);

                $user_own = User::find($product->user_own_id);
                $user_own_you = Auth::user() != null && $product->user_own_id == Auth::user()->id;

                $lastStatus = StatusProduct::getLastProductStatusByProduct($product->uuid)->first();

//                dd($lastStatus);

                $productPhoto = ProductPhotos::where('product_uuid', '=', $product->uuid)
                    ->orderBy('index', 'asc')->first(); //->firstOrFail(); // - выдает ошибку
                $dataProductPhoto = ProductPhotosController::getPreDataForPhoto($productPhoto);

                $dataProducts[$key] = [
                    'price_float' => $price_float,
                    'photo_main' => $dataProductPhoto,
                    'last_status' => $lastStatus,
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
            'quantity' => 'required|integer', // unsigned
            'category_id' => 'integer', // unsigned
        ]);

        $title_ruRaw = $request->get('title_ru');
        $toSlugTransLit = Transliteration::clean_filename($title_ruRaw);
        //todo добавить проверку на уникальность

        $price = $request->get('price');

        $price = self::toPriceForDB($price);

        $quantity = (int) $request->get('quantity');

        $category_id = (int) $request->get('category_id');
//        $category_id = 1;

        $user_own_id = Auth::user()->id;

        $title_ru = $request->get('title_ru');

        $description_ru = $request->get('description_ru');


        $uuidNew  = Uuid::generate()->string;

        $product = new Product([
            'uuid' => $uuidNew,
            'article_number' => 0, //TODO придумать как генерировать уникальный артикул
            'price' => $price,
            'quantity' => $quantity,
            'category_id' => $category_id,
            'user_own_id' => $user_own_id,
            'slug' => $toSlugTransLit,
            'title_ru' => $title_ru,
            'description_ru' => $description_ru,
            'meta_keywords' => '',
            'meta_description' => '',
        ]);

//        dd($product->toArray());

        $product->save();

        $defaultStatus = StatusProduct::where('name', '=', self::PRODUCT_DEFAULT_STATUS_NAME)->firstOrFail();

        if( !empty($defaultStatus) )
        {
//            StatusProduct::createManyToManyWithStatus($product->uuid, $defaultStatus->id);
            StatusProduct::createReferenceStatusWithProduct([ 'product_uuid' => $product->uuid, 'status_id' => $defaultStatus->id ]);
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

        if( empty($product) )
            abort(404);

        $productPhotos = ProductPhotos::getProductPhotoByProductId($product->uuid);

        $price_float = self::toPriceForDisplay($product->price, true);

        //todo вынести в отдельный метод по работе с textarea
        $description_ru_float = mb_ereg_replace('\n', '<br>', $product->description_ru); // \r\n

        $user_own = User::find($product->user_own_id);
        $user_own_you = Auth::user() != null && $product->user_own_id == Auth::user()->id;

        $dataProductPhotos = ProductPhotosController::getPreDataForPhotos($productPhotos);

        // приставка float - значит обработанное или приведенное к тексту значение
        $dataProduct = [
            'description_ru_float' => $description_ru_float,
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
        $product = Product::where('uuid', '=', $uuid)->first(); //firstOrFail();

        if( empty($product) )
            abort(404);

        $price_float = self::toPriceForDisplay($product->price, false);

        $user_own = User::find($product->user_own_id);
        $user_own_you = Auth::user() != null && $product->user_own_id == Auth::user()->id;

        $allProductStatuses = StatusProduct::getAllProductStatuses()->toArray();
        $lastProductStatus = StatusProduct::getLastProductStatusByProduct($product->uuid)->first();

        /**
         * (array) и ->toArray() выполняют разные задачи
         * (array) - полностью преобразовывает объект к массиву - названия ключей в цвете
         * ->toArray() - только объект объектов в массив объектов - белые названия ключей
         */

        //todo вынести в отдельный метод
        $productStatuses = [];
        if( count($allProductStatuses) > 0 ) {
            foreach ($allProductStatuses as $key => $status) {
                $selected = !empty($lastProductStatus) && $status->name == $lastProductStatus->name;
                $productStatuses[] = [
                    'selected' => $selected,
                    'name' => $status->name,
                    'title_ru' => $status->title_ru,
                ];
            }
        }

        $allProductCategories = ProductCategories::all();

        //todo вынести в отдельный метод
        $productCategories = [];
        if( count($allProductCategories) > 0 ) {
            foreach ($allProductCategories as $key => $category) {
                $selected = !empty($product->category_id) && $category->id == $product->category_id;
                $productCategories[] = [
                    'selected' => $selected,
                    'id' => $category->id,
                    'name' => $category->name,
                    'title_ru' => $category->title_ru,
                ];
            }
        }

        $dataProduct = [
            'price_float' => $price_float,
            //TODO может перенести в user?
            'user_own' => [
                'id' => $user_own->id,
                'name' => $user_own->name,
                'you' => $user_own_you, // " [id: ". $user_own->id ."]"
            ],
            'select_status' => $productStatuses,
            'select_category' => $productCategories,
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
            'price' => 'required|regex:/^(\d+\.{0,1}\d{1,2})?$/',
            'quantity' => 'required|integer',
            'status' => 'regex:/^(\w+)$/',
            'category_id' => 'integer|nullable',
        ]);

        $quantity = $request->get('quantity');
        $title_ru = $request->get('title_ru');
        $description_ru = $request->get('description_ru');
        $status = $request->get('status');
        $category_id = $request->get('category_id') !== null ? (int) $request->get('category_id') : null;

        $priceRaw = $request->get('price');
        $priceWOS = self::removeSpaces($priceRaw);
        $priceFDB = self::toPriceForDB($priceWOS);

        if( $category_id !== null)
            $productCategoryNew = ProductCategories::where('id', '=', $category_id)->first();

        $product = Product::where('uuid', '=', $uuid)->first(); // firstOrFail

        if( empty($product) )
            abort(404);

        $product->category_id = !empty($productCategoryNew) ? $productCategoryNew->id : null;

        $product->price = $priceFDB;
        $product->quantity = $quantity;
        $product->title_ru = $title_ru;
        $product->description_ru = $description_ru;

        $product->save();

        $statusNew = StatusProduct::where('name', '=', $status)->first();
        $lastProductStatus = StatusProduct::getLastProductStatusByProduct($product->uuid)->first();

        if( !empty($statusNew) && ( empty($lastProductStatus) || $statusNew->name !== $lastProductStatus->name) )
            StatusProduct::createReferenceStatusWithProduct(['product_uuid'=>$product->uuid, 'status_id'=>$statusNew->id]);

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

        //TODO Добавить пересортировку индексов

        $product->delete();

        return redirect()
            ->route('product.index')
            ->with('success', 'Product deleted!');
    }

    //TODO реализовать поиск


    /**
     * Метод конвертирует значение цены в читаемое для пользователя
     */
    public static function toPriceForDisplay($price, $withThousandSpaces = false) : string
    {
//        return $price > 0 ? round($price / self::PRODUCT_MONEY_FIX_NUMBER, 2) : 0.0;
//        $number = round($price / self::PRODUCT_MONEY_FIX_NUMBER, 2);
        $number = $price / self::PRODUCT_MONEY_FIX_NUMBER;
        return number_format($number, 2, '.', $withThousandSpaces ? ' ' : '');
    }

    /**
     * Метод конвертирует значение цены для записи в базу данных поправив и множив на 10000
     */
    public static function toPriceForDB($price) : int
    {
//        return (int) ($price * self::PRODUCT_MONEY_FIX_NUMBER);
        $price_f = $price * self::PRODUCT_MONEY_FIX_NUMBER;
        return (int) number_format($price_f, 0, '', false);
    }

    /**
     * Удаление пробелов из строки "числа"
     */
    public static function removeSpaces($price){
        return mb_ereg_replace('\s', '', $price);
    }


}
