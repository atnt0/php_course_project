<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPhotos;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;

class ProductPhotosController extends Controller
{
    public const PRODUCT_PHOTO_PUBLIC_DIRECTORY = '/storage/productphotos'; // публичный путь к директории, от куда пользователи получают изображение
    public const PRODUCT_PHOTO_SERVER_DIRECTORY = '/public/productphotos'; // серверный путь к директории, куда сохраняются фотографии

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$photos = ProductPhotos::all();
        $productPhotos = ProductPhotos::getProductPhotos();
//        $productPhotos = ProductPhotos::all();
//        dd($productPhotos);

        $dataProductPhotos = [[]];

        if( count($productPhotos) > 0 )
        {
            foreach ($productPhotos as $key => $productPhoto) {
                $dataProductPhotos[$key] = [
                    'uuid' => $productPhoto->uuid,
                    'description_ru' => $productPhoto->description_ru,
                    'link' => self::PRODUCT_PHOTO_PUBLIC_DIRECTORY .'/'. $productPhoto->file_name,
                ];
            }
        }

        return view('productphotos.index', compact('productPhotos', 'dataProductPhotos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();

        return view('productphotos.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // , $product_uuid
    {
        $request->validate([
//            'product_uuid' => 'required|regex:/^[a-f0-9]{8}\-[a-f0-9]{4}\-4[a-f0-9]{3}\-(8|9|a|b)[a-f0-9]{3}\-[a-f0-9]{12}?$/',
            'product_uuid' => 'required|uuid',
            'file'=>'required|file|mimes:jpg,png', // bmp,pdf,
            //'description_ru' => 'required|min:10',
            'description_ru' => 'max:255',
        ]);

        $product = Product::where('uuid', '=',  $request->get('product_uuid') )->firstOrFail();

        if( empty($product) )
            abort(404);

        $maxIndex = ProductPhotos::getMaxIndex($product->id);

        $newIndex = $maxIndex + 1;

        $file = $request->file("file");
//        $file->getClientOriginalName();
//        $file->getClientMimeType();
        $fileName = Uuid::generate()->string .'.'. $file->guessClientExtension();

        $newFilePath = Storage::putFileAs( self::PRODUCT_PHOTO_SERVER_DIRECTORY, new File($file->getPathname()), $fileName); // new File($file->getPathname())


        $userId = Auth::user() ? Auth::user()->id : 0; // -1
//        dd(['$userId'=>$userId]);

        $uuid = Uuid::generate()->string;

        $productPhoto = new ProductPhotos([
            'uuid' => $uuid,
            'product_id' => $product->id, // simple id
            'index' => $newIndex,
            'file_name' => $fileName,
            'user_own_id' => $userId,
            'description' => '',
            'description_ua' => '',
            'description_ru' => $request->get('description_ru'),
        ]);
        $productPhoto->save();

        return redirect()
            ->route('product.photo.editListForProduct', ['product_uuid' => $product->uuid])
            ->with('success', 'Product Photo saved!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $productPhoto = ProductPhotos::where('uuid', '=', $uuid)->firstOrFail();

        if( empty($productPhoto) )
            abort(404);

        $product = Product::where('id', '=',  $productPhoto->product_id )->firstOrFail();

        $dataProductPhotos = [];

        //TODO перенести в отдельный метод
        $dataProductPhoto = [
            'uuid' => $productPhoto->uuid,
            'description_ru' => $productPhoto->description_ru,
            'link' => ProductPhotosController::PRODUCT_PHOTO_PUBLIC_DIRECTORY .'/'. $productPhoto->file_name,
        ];

        //$products = Product::all();

        return view('productphotos.edit', compact('productPhoto', 'dataProductPhoto', 'product'));
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
//            'product_uuid' => 'required|regex:/^[a-f0-9]{8}\-[a-f0-9]{4}\-4[a-f0-9]{3}\-(8|9|a|b)[a-f0-9]{3}\-[a-f0-9]{12}?$/',
            'product_uuid' => 'required|uuid',
            'description_ru' => 'max:255',
        ]);

        $productPhoto = ProductPhotos::where('uuid', '=', $uuid)->firstOrFail();

        if( empty($productPhoto) )
            abort(404);

        $productPhoto->description_ru = $request->get('description_ru');

        $productPhoto->save();

        return redirect()
            ->route('product.photo.edit', [$productPhoto->uuid])
            ->with('success', 'Product Photo updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $productPhoto = ProductPhotos::where('uuid', '=', $uuid)->firstOrFail();

        if( empty($productPhoto) )
            abort(404);

        $product = Product::where('id', '=',  $productPhoto->product_id )->firstOrFail();

        $filePath = self::PRODUCT_PHOTO_SERVER_DIRECTORY .'/'. $productPhoto->file_name;

        $productPhoto->delete();

        Storage::delete($filePath);

        return redirect()
            ->route('product.photo.editListForProduct', ['product_uuid' => $product->uuid])
            ->with('success', 'Product Photo deleted!');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     *
     */
    public function editPositionsForProductByUuid($product_uuid)
    {
        $product = Product::where('uuid', '=',  $product_uuid )->firstOrFail();

        if( empty($product) )
            abort(404);

        $productPhotos = ProductPhotos::where('product_id', '=', $product->id)
            ->orderBy('index', 'asc')->get();

        if( empty($productPhotos) )
            abort(404);

        $dataProductPhotos = self::getPreDataForPhotos($productPhotos);

        return view('productphotos.editListForProduct',
            compact('product', 'productPhotos', 'dataProductPhotos'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createForProduct($product_uuid)
    {
        $product = Product::where('uuid', '=',  $product_uuid )->firstOrFail();

        if( empty($product) )
            abort(404);

        return view('productphotos.createForProduct', compact('product'));
    }




    /**
     * Метод устанавливает новый порядок в списке фотографий продукта
     */
    public static function setProductPhotosPositions(Request $request, $product_uuid)
    {

        $uuidPhotos = $request->get('photos');

//        dd([
//            'product_uuid' => $product_uuid,
//            'photos' => $uuidPhotos,
//        ]);

        if( count($uuidPhotos) > 0 )
        {
            $arr = [];
            foreach ($uuidPhotos as $index => $uuidPhoto) {
                ProductPhotos::where('uuid', '=', $uuidPhoto)->update(['index' => $index]);
            }
        }

//        return 1;
    }







    /**
     * Метод возвращает подготовленные к выводу на view данные по одному Фото
     */
    public static function getPreDataForPhoto(ProductPhotos $productPhoto)
    {
        return [
            'uuid' => $productPhoto->uuid,
            'description_ru' => $productPhoto->description_ru,
            'link' => self::PRODUCT_PHOTO_PUBLIC_DIRECTORY .'/'. $productPhoto->file_name,
        ];
    }

    /**
     * Метод возвращает подготовленные к выводу на view данные по Массиву Фото
     */
    public static function getPreDataForPhotos( $productPhotos) //  ...
    {
        $dataProductPhotos = [];

        if( count($productPhotos) > 0 )
        {
            foreach ($productPhotos as $key => $productPhoto) {
                $dataProductPhotos[$key] = self::getPreDataForPhoto($productPhoto);
            }
        }

        return $dataProductPhotos;
    }





}
