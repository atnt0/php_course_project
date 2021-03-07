@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Show an Order</h1>
            @include('layouts.parts._flash-message')

            <div class="row">
                <div class="col">

                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col">

            <div class="row">
                <div class="col-2 text-right"><b>UUID:</b></div>
                <div class="col-10">{{ $order->uuid }}</div>
            </div>

            <div class="row">
                <div class="col-2 text-right"><b>Created at:</b></div>
                <div class="col-10">
                    {{ $order->created_at }}
                </div>
            </div>

            <div class="row">
                <div class="col-2 text-right"><b>Phone:</b></div>
                <div class="col-10">{{ $order->client_phone }}</div>
            </div>

            <div class="row">
                <div class="col-2 text-right"><b>Email:</b></div>
                <div class="col-10">{{ $order->client_email }}</div>
            </div>

            <div class="row">
                <div class="col-2 text-right"><b>Comment:</b></div>
                <div class="col-10">{{ $order->comment }}</div>
            </div>


            <div class="row">
                <div class="col-2 text-right"><b>Address:</b></div>
                <div class="col-10">
                    {{ $order->address_city }},
                    {{ $order->address_zip }},
                    {{ $order->address_street }},
                    {{ $order->address_house }},
                    {{ $order->address_floor }},
                    {{ $order->address_apart }},
                    NP Office: {{ $order->address_np_number }}
                </div>
            </div>

            <div class="row">
                <div class="col-2 text-right"><b>User own:</b></div>
                <div class="col-10">
                    {{--      {{ $order->user_own_id }}--}}
                    {{ $dataOrder['user_own_name'] }}
                </div>
            </div>

            <div class="row">
                <div class="col-2 text-right"><b>User ip:</b></div>
                <div class="col-10">
                    {{ $order->guest_ip }}
                </div>
            </div>

            <div class="row">
                <div class="col-2 text-right"><b>User-agent:</b></div>
                <div class="col-10">
                    {{ $order->guest_useragent }}
                </div>
            </div>

            <div class="row">
                <div class="col-2 text-right"><b>Products:</b></div>
                <div class="col-10">
                    @include('orders.parts._itemsProductsForOrder')
                </div>
            </div>

        </div>
    </div>

@endsection
