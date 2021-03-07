@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Add a Product</h1>
            @include('layouts.parts._flash-message')

            <div class="buttons-item d-inline-block">
                <a href="{{ route('product.index', []) }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <br>

    <form enctype="multipart/form-data" method="post" action="{{ route('product.store') }}">
        @csrf

        <div class="row">
            <div class="col-7">
                <div class="form-group">
                    <label for="name_ru">Title ru:</label>
                    <input type="text" class="form-control" name="title_ru"/>
                </div>
            </div>

            <div class="col-2">
                <div class="form-group">
                    <label for="number">Quantity:</label>
                    <input type="number" class="form-control text-center" name="quantity" value="10"/>
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="price">Price:</label>
                    <div class="input-group">
                        <input type="text" class="form-control text-right" aria-label="" name="price" value="0.00">
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
                    <textarea class="form-control" name="description_ru" rows="6"></textarea>
                </div>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </div>

    </form>
@endsection
