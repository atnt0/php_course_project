{{--{{ dd( session()->all() ) }}--}}
@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Checkout - Order Information</h1>
            @include('layouts.parts._flash-message')


            <div class="row">
                <div class="col-12">
                    <a href="{{ route('cart.index', []) }}"
                       class="btn btn-primary">Back to change cart</a>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 g-3">
        <div class="col">
            @include('carts.parts._checkoutForm')
        </div>

        <div class="col">
            @include('carts.parts._checkoutOnlyPrintCart')
        </div>
    </div>
    <br>

@endsection
