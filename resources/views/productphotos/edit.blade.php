@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Edit a Photo</h1>
            @include('layouts.parts._flash-message')

            <div class="row">
                <div class="col">
                    <a href="{{ route('product.photo.editListForProduct', ['product_uuid' => $product->uuid]) }}"
                       class="btn btn-primary">Back to Edit photos</a>
                    <a href="{{ route('product.show', [$product->uuid]) }}" class="btn btn-primary">View_Product</a>
                </div>
            </div>
        </div>
    </div>
    <br>

    <form method="post" action="{{ route('product.photo.update', $productPhoto->uuid) }}">
        @method('PATCH')
        @csrf

        <div class="row">
            <div class="col">
                <div>
                    <img src="{{  $dataProductPhoto['link'] }}" style="width: 300px; height: auto; max-height: 300px;">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="description_ru">For Product:</label>
                    <select class="form-control" name="product_uuid" id="product_uuid" disabled>
{{--                        @foreach($products as $product)--}}
                            <option value="{{ $product->uuid }}">{{ $product->title_ru }}</option>
{{--                        @endforeach--}}
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="description_ru">Description ru:</label>
                    <textarea class="form-control" name="description_ru" rows="4">{{ $productPhoto->description_ru }}</textarea>
                </div>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>

    </form>
@endsection
