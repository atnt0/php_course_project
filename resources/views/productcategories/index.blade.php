@extends('base')

@section('title', 'Категории товаров')

@section('main')
    <div class="row">
        <div class="col-12">
{{--            <h1 class="display-3">Product Categories</h1>--}}
            <h2 class="display-5">{{ 'Категории товаров' }}</h2>
            @include('layouts.parts._flash-message')

            <div class="row">
                @if (Auth::guest())
                    {{--                    Only registred users can be use this function.--}}
                @else
                    <div class="col">
                        <a href="{{ route('product.category.create') }}" class="mb-3 btn btn-primary">Add Category</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col">
            <table class="table table-striped" data-table="insert_here">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Title ru</th>
                    <th>Description ru</th>
                    <th colspan="3">Actions</th>
                </tr>
                </thead>
                <tbody>
                    @include('productcategories.parts._items')
                </tbody>
            </table>
        </div>
    </div>

@endsection
