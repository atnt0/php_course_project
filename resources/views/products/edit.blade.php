@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Edit a Product</h1>
            @include('layouts.parts._flash-message')

            <form method="post" action="{{ route('product.update', $product->uuid) }}">
                @method('PATCH')
                @csrf

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="title_ru">Title ru:</label>
                        <input type="text" class="form-control" name="title_ru" value="{{ $product->title_ru }}" />
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="description_ru">Description ru:</label>
                        <textarea class="form-control" name="description_ru" rows="6">{{ $product->description_ru }}</textarea>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control text-right" name="quantity" value="{{ $product->quantity }}"/>
                    </div>
                </div>

                <div class="col-6">
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

{{--                <div class="col-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="tax">Tax:</label>--}}
{{--                        <div class="input-group">--}}
{{--                            <input type="text" class="form-control text-right" aria-label="" name="tax" value="{{ $dataProduct['tax_float'] }}">--}}
{{--                            <div class="input-group-append">--}}
{{--                                <span class="input-group-text">₴</span>--}}
{{--                                <span class="input-group-text">0.00</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <br>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="submit" class="btn btn-primary">Update
                </div>
            </form>
        </div>
    </div>
@endsection
