@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Add a Photo for Product</h1>
            @include('layouts.parts._flash-message')

            <div class="row">
                <div class="col">

                </div>
            </div>
        </div>
    </div>
    <br>

    <form enctype="multipart/form-data" method="post" action="{{ route('product.photo.store', ['product_uuid' => $product->uuid]) }}">
        @csrf

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <select class="form-control" name="product_uuid" id="product_uuid" disabled>
                        {{--     <option value="">Not Selected</option>--}}
                        {{--       @foreach($products as $product)--}}
                            <option value="{{ $product->uuid }}">{{ $product->title_ru }}</option>
                        {{--       @endforeach--}}
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="file">File:</label>
                    <input type="file" class="form-control" name="file"/>
                    <small class="form-text text-muted">Maximum file size 10 MB</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="description_ru">Description ru:</label>
                    <textarea class="form-control" name="description_ru" rows="4"></textarea>
                </div>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </div>

    </form>
@endsection
