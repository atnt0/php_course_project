<?php

namespace App\Http\Controllers;

use App\Models\ProductCategories;
use Illuminate\Http\Request;

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

        $category = new ProductCategories([
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

        return view('productcategories.show', compact('category'));
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

        return view('productcategories.edit', compact('category'));
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
        ]);

        $category = ProductCategories::find($id);

        if( empty($category) )
            abort(404);

        $category->title_ru = $request->get('title_ru');
        $category->description_ru = $request->get('description_ru');

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
}
