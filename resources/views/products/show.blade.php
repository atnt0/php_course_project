@extends('base')

@section('title', $product->title_ru .' - '. 'Товар')

@section('main')
    <div class="row">
        <div class="col-12">
{{--            <h1 class="display-3">Show a Product</h1>--}}
            <h2 class="display-5">{{ $product->title_ru }}</h2>
            @include('layouts.parts._flash-message')

            <div class="row">
                <div class="col">
                    <a href="{{ route('product.edit', [$product->uuid]) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
    <br>


   <div class="row">
       <div class="col col-12">

           <div class="row">
               <div class="col-2 text-right"><b>Title ru:</b></div>
               <div class="col-10">{{ $product->title_ru }}</div>
           </div>

           <div class="row">
               <div class="col-2 text-right"><b>Category:</b></div>
               <div class="col-10">{{ $product->category_title_ru ? $product->category_title_ru : 'Not have a parent' }}</div>
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
                   <div class="buttons-item d-inline-block">
                       <a href="{{ route('product.photo.editListForProduct', ['product_uuid' => $product->uuid]) }}"
                          class="btn btn-sm btn-primary">Edit photos</a>
                   </div>
               </div>
           </div>
           <br>


           <div class="row">
               <div class="col-2 text-right"><b>Price:</b></div>
               <div class="col-10" style=" font-size: 28px; ">
                   <b>{{ $dataProduct['price_float'] }} ₴</b>
               </div>
           </div>

           <div class="row">
               <div class="col-2 text-right"><b>Quantity in stock:</b></div>
               <div class="col-10">{{ $product->quantity }}</div>
           </div>

           <div class="row">
               <div class="col-2 text-right"><b>Quantity:</b></div>
               <div class="block_quantity" data-action="{{ route('cart.changeQuantityProductInCart', ['product_uuid' => $product->uuid]) }}">
                   {{--  <input type="number" class="form-control" name="add_to_cart[quantity]" value="1">--}}
                   <input type="button" name="btn_down_quantity" class="btn btn-sm btn-info text-white" value="-" disabled="disabled"
                          style="display: inline-block; vertical-align: middle;">
                   <input type="text" name="product_quantity" class="form-control text-center"
                          min="0" max="1000000" maxlength="100" value="1"
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
                   {{--     $product->description_ru--}}
                   <p>{!! $dataProduct['description_ru_float'] !!}</p>
               </div>
           </div>

       </div>
   </div>
   <br>


@endsection
