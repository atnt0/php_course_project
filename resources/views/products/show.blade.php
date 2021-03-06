@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Show a Product</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br />
            @endif


            <div class="row">
                <div class="col col-12">

                    <div class="row">
                        <div class="col-2 text-right"><b>Title ru:</b></div>
                        <div class="col-10">{{ $product->title_ru }}</div>
                    </div>

                    <div class="row">
                        <div class="col-2 text-right"><b>Category:</b></div>
                        <div class="col-10">{{ $product->category_title_ru }}</div>
                    </div>

                    <div class="row">
                        <div class="col-2 text-right"><b>Status:</b></div>
                        <div class="col-10">
                            <b>{{ $product->product_status_title_ru }}</b>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2 text-right"><b>Photos:</b></div>
                        <div class="col-10">
                            <ul style="list-style: none; padding: 0;">
                            @foreach($dataProduct['productPhotos'] as $productPhoto)
                                <li style=" display: inline-block; padding: 5px 20px; border: 1px solid #ccc;">
                                    <a href="{{ $productPhoto['link'] }}" target="_blank">
                                        <img src="{{ $productPhoto['link'] }}" title="{{ $productPhoto['description_ru'] }}"
                                             style="width: 100px; height: auto; max-height: 100px;">
                                    </a>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                    <br>


                    <div class="row">
                        <div class="col-2 text-right"><b>Price:</b></div>
                        <div class="col-10"><b>{{ $dataProduct['price_float'] }} ₴</b></div>
                    </div>

                    <div class="row">
                        <div class="col-2 text-right"><b>Quantity in stock:</b></div>
                        <div class="col-10">{{ $product->quantity }}</div>
                    </div>

                    <div class="row">
                        <div class="col-2 text-right"><b>Quantity:</b></div>
                        <div class="block_quantity" data-action="{{ route('cart.changeQuantityProductInCart', ['product_uuid' => $product->uuid]) }}">
{{--                            <input type="number" class="form-control" name="add_to_cart[quantity]" value="1">--}}
                            <input type="button" name="btn_down_quantity" class="btn btn-sm btn-info text-white" value="-" disabled="disabled"
                                   style="display: inline-block; vertical-align: middle;">
                            <input type="decimal" name="product_quantity" class="form-control text-center"
                                   decimal_separators=",,." min="0" max="1000000" maxlength="100" value="1"
                                   style="display: inline-block; vertical-align: middle; width: auto; width: 4em;">
                            <input type="button" name="btn_up_quantity" class="btn btn-sm btn-info text-white" value="+"
                                   style="display: inline-block; vertical-align: middle;">
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-2"></div>
                        <div class="block_add_to_cart">
                            @csrf
{{--                            <input type="hidden" class="form-control" name="add_to_cart[product_uuid]" value="{{ $product->uuid }}">--}}
                            <input type="hidden" class="form-control"
                                   name="product_uuid" value="{{ $product->uuid }}">
                            <a href="{{ route('cart.addToCart', ['product_uuid' => $product->uuid]) }}"
                               data-add-to-cart-product-id="{{ $product->uuid }}"
                               title="Add to cart"
                               class="btn btn-success">Add to cart</a>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-2 text-right"><b>User own:</b></div>
                        <div class="col-10">
                            <span {{-- data-user-own-id="{{ $dataProduct['user_own']['id'] }}"--}}>
                                {{ $dataProduct['user_own']['name'] }}{{ ($dataProduct['user_own']['you'] ? " (You)" : "" ) }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2 text-right"><b>Description ru:</b></div>
                        <div class="col-10">
                            <p>{{ $product->description_ru }}</p>
                        </div>
                    </div>

                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-12">
                    <h4 class="display-6">Actions:</h4>

                    <div class="buttons">
                        <div class="buttons-item d-inline-block">
                            <a href="{{ route('product.photo.editListForProduct', ['product_uuid' => $product->uuid]) }}"
                               class="btn btn-primary">Edit photos</a>
                        </div>

                        <div class="buttons-item d-inline-block">
                            <a href="{{ route('product.edit', [$product->uuid]) }}" class="btn btn-primary">Edit</a>
                        </div>

                        <div class="buttons-item d-inline-block">
                            <form action="{{ route('product.destroy', [$product->uuid]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>

        </div>
    </div>
@endsection
