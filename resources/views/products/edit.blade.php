@extends('base')

@section('title', $product->title_ru .' - '. 'Редактирование')

@section('main')
    <div class="row">
        <div class="col-12">
{{--            <h1 class="display-3">Edit a Product</h1>--}}
            <h2 class="display-5">{{ $product->title_ru }}</h2>
            @include('layouts.parts._flash-message')

            <div class="row">
                <div class="col">
                    <a href="{{ route('product.show', [$product->uuid]) }}" class="btn btn-primary">View</a>
                    <a href="{{ route('product.photo.editListForProduct', ['product_uuid' => $product->uuid]) }}"
                       class="btn btn-primary">Edit photos</a>
                </div>
            </div>
        </div>
    </div>
    <br>

    <form method="post" action="{{ route('product.update', $product->uuid) }}">
        @method('PATCH')
        @csrf

        <div class="row">
            <div class="col-7">
                <div class="form-group">
                    <label for="title_ru">Title ru:</label>
                    <input type="text" class="form-control" name="title_ru" value="{{ $product->title_ru }}" />
                </div>
            </div>

            <div class="col-2">
                <div class="form-group">
                    <label for="quantity">Quantity:</label>

                    <div class="block_quantity" data-action="{{ route('cart.changeQuantityProductInCart', ['product_uuid' => $product->uuid]) }}">
                        {{--  <input type="number" class="form-control" name="add_to_cart[quantity]" value="1">--}}
                        <input type="button" name="btn_down_quantity" class="btn btn-sm btn-info text-white" value="-"
                               {{ $product->quantity <= 1 ? ' disabled="disabled"' : '' }}
                               style="display: inline-block; vertical-align: middle;">
                        <input type="text" class="form-control text-center" name="quantity" value="{{ $product->quantity }}"
                               min="0" max="1000000" maxlength="100"
                               style="display: inline-block; vertical-align: middle; width: auto; width: 4em;">
{{--                        <input type="decimal" name="product_quantity" class="form-control text-center"--}}
{{--                               decimal_separators=",,." min="0" max="1000000" maxlength="100" value="1"--}}
{{--                               style="idsplay: inline-block; vertical-align: middle; width: auto; width: 4em;">--}}
                        <input type="button" name="btn_up_quantity" class="btn btn-sm btn-info text-white" value="+"
                               style="display: inline-block; vertical-align: middle;">
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="price">Price:</label>
                    <div class="input-group">
                        <input type="text" class="form-control text-right" aria-label="" name="price" value="{{ $dataProduct['price_float'] }}">
                        {{-- Hrivnya amount (with dot and two decimal places) --}}
                        <div class="input-group-append">
                            <span class="input-group-text">₴</span>
                            <span class="input-group-text">0.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="description_ru">Description ru:</label>
                    <textarea class="form-control" name="description_ru" rows="6">{{ $product->description_ru }}</textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control" name="status" id="status">
                        @foreach($dataProduct['select_status'] as $k => $productStatus)
                            <option value="{{ $productStatus['name'] }}"{{ $productStatus['selected'] ? ' selected="selected"' : '' }}>
                                {{ $productStatus['title_ru'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select class="form-control" name="category_id" id="category">
                        <option value="">Not have a parent</option>
                        @foreach($dataProduct['select_category'] as $k => $productCategory)
                            <option value="{{ $productCategory['id'] }}"{{ $productCategory['selected'] ? ' selected="selected"' : '' }}>
                                {{ $productCategory['title_ru'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
        <br>
    </form>
    <br>

{{--    <div class="row">--}}
{{--        <div class="col-12">--}}
{{--            <h4 class="display-6">Actions:</h4>--}}

{{--            <div class="buttons">--}}
{{--                <div class="buttons-item d-inline-block">--}}
{{--                    <form action="{{ route('product.destroy', [$product->uuid]) }}" method="post">--}}
{{--                        @csrf--}}
{{--                        @method('DELETE')--}}
{{--                        <button class="btn btn-danger" type="submit">Delete</button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <br>--}}

@endsection
