@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Edit a Photos for Product</h1>
            @include('layouts.parts._flash-message')

            <div class="row">
                <div class="col">
                    <a href="{{ route('product.photo.createForProduct', [$product->uuid]) }}" class="btn btn-info text-white">Add photo</a>

                    <a href="{{ route('product.show', [$product->uuid]) }}" class="btn btn-primary">View_Product</a>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col">
            <div data-table="sortable" data-action="{{ route('product.photo.editListForProduct.setProductPhotosPositions', [$product->uuid]) }}">
                @csrf
                <div class="row">
                    @include('productphotos.parts._editItems')
                </div>
            </div>
        </div>
    </div>

@endsection
