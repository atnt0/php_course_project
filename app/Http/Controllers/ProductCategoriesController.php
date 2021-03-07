<?php

namespace App\Http\Controllers;

use App\Models\ProductCategories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use That0n3guy\Transliteration\Facades\Transliteration;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ProductCategories::all();

        return view('productcategories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productcategories.create');
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
            'title_ru' => 'required|min:2',
            'description_ru' => 'required|min:10',
        ]);

        $title_ruRaw = $request->get('title_ru');
        $toSlugTransLit = Transliteration::clean_filename($title_ruRaw);
        //todo добавить проверку на уникальность

        $category = new ProductCategories([
            'slug' => $toSlugTransLit,
            'title_ru' => $request->get('title_ru'),
            'description_ru' => $request->get('description_ru'),
        ]);

        $category->save();

        return redirect()
            ->route('product.category.show', [$category->id])
            ->with('success', 'Category saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = ProductCategories::find($id);

        if( empty($category) )
            abort(404);

        $breadcrumbs = ProductCategoriesController::getParents($category->id);

        $dataCategory = [
            'breadcrumbs' => $breadcrumbs,
        ];

        return view('productcategories.show', compact('category', 'dataCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = ProductCategories::find($id);

        if( empty($category) )
            abort(404);

        $allProductCategories = ProductCategories::all();

        //todo вынести в отдельный метод
        $productCategories = [];
        if( count($allProductCategories) > 0 ) {
            foreach ($allProductCategories as $key => $productCategory) {
                if( $productCategory->id !==  $category->id) {
                    $selected = !empty($category->parent_id) && $productCategory->id == $category->parent_id;
                    $productCategories[] = [
                        'selected' => $selected,
                        'id' => $productCategory->id,
                        'name' => $productCategory->name,
                        'title_ru' => $productCategory->title_ru,
                    ];
                }
            }
        }

        $dataCategory = [
            'select_category' => $productCategories,
        ];

        return view('productcategories.edit', compact('category', 'dataCategory'));
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
        $request->validate([
            'title_ru' => 'required|min:2',
            'description_ru' => 'required|min:10',
            'parent_category_id' => 'integer|nullable',
        ]);

        $category = ProductCategories::find($id);

        if( empty($category) )
            abort(404);

        $category->title_ru = $request->get('title_ru');
        $category->description_ru = $request->get('description_ru');
        $parent_category_id = $request->get('parent_category_id') !== null ? (int) $request->get('parent_category_id') : null;

        if( $parent_category_id !== null && $category->id !== $parent_category_id)
            $categoryCategoryNew = ProductCategories::where('id', '=', $parent_category_id)->first();

        $category->parent_id = !empty($categoryCategoryNew) ? $categoryCategoryNew->id : null;


        $category->save();

        return redirect()
            ->route('product.category.edit', [$category->id])
            ->with('success', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = ProductCategories::find($id);

        if( empty($category) )
            abort(404);

        $category->delete();

        return redirect()
            ->route('product.category.index')
            ->with('success', 'Category deleted!');
    }



    /**
     * Функция возвращает одномерный массив родителей категории
     */
    public static function getParents($category_id, $max = 2){

        function getParentsFromDBRecurcive($obj, $category_id = null)
        {
            if( $category_id !== null ) {
                $object = ProductCategories::where('id', '=', $category_id)->first()->toArray();
                $next = [];
                if( !empty($object['parent_id']) ){
                    $next = getParentsFromDBRecurcive($obj, $object['parent_id']);
                }
                $obj = [
                    'object' => $object,
                    'next' => $next,
                ];
            }
            return $obj;
        }

        $arr = [];
        $categories = getParentsFromDBRecurcive($arr, $category_id);

        $arrayKeys = ['id', 'slug', 'title_ru'];
        $results = [];
        array_walk_recursive($categories, function ($item, $key) use (&$results, &$arrayKeys) {
            if( in_array($key, $arrayKeys) )
                $results[$key][] = $item;
        });

        $items = [];
        if( count($results) > 0 )
            foreach ($results as $key1 => $result)
                foreach ($result as $key2 => $item)
                    $items[$key2][$key1] = $item;
        $items = array_reverse($items);

        return $items;
    }





}
