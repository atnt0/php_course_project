@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Show a Order</h1>

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

            <br>

            <div class="row">
                <div class="col col-12">

                    <div class="row">
                        <div class="col-2 text-right"><b>ID:</b></div>
                        <div class="col-10">{{ $order->id }}</div>
                    </div>

                    <div class="row">
                        <div class="col-2 text-right"><b>UUID:</b></div>
                        <div class="col-10">{{ $order->uuid }}</div>
                    </div>

{{--                    <div class="row">--}}
{{--                        <div class="col-2 text-right"><b>Status:</b></div>--}}
{{--                        <div class="col-10">--}}
{{--                            <b>{{ $order->product_status_title_ru }}</b>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="row">
                        <div class="col-2 text-right"><b>Comment:</b></div>
                        <div class="col-10">{{ $order->comment }}</div>
                    </div>

                    <div class="row">
                        <div class="col-2 text-right"><b>Email:</b></div>
                        <div class="col-10">{{ $order->email }}</div>
                    </div>

                    <div class="row">
                        <div class="col-2 text-right"><b>Phone:</b></div>
                        <div class="col-10">{{ $order->phone }}</div>
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
                            {{ $order->user_own_id }}
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

{{--                    <div class="row">--}}
{{--                        <div class="col-2 text-right"><b>Quantity:</b></div>--}}
{{--                        <div class="col-10">{{ $order->quantity }}</div>--}}
{{--                    </div>--}}


                </div>
            </div>
            <br>


            <div class="row">
                <div class="col-12">
                    <h4 class="display-6">Actions:</h4>

                    <div class="buttons">

{{--                        <div class="buttons-item d-inline-block">--}}
{{--                            <form action="{{ route('product.destroy', [$product->uuid]) }}" method="post">--}}
{{--                                @csrf--}}
{{--                                @method('DELETE')--}}
{{--                                <button class="btn btn-danger" type="submit">Delete</button>--}}
{{--                            </form>--}}
{{--                        </div>--}}

                    </div>
                </div>
            </div>
            <br>

        </div>
    </div>
@endsection
