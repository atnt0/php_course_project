@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Show an Order</h1>

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
                        <div class="col-2 text-right"><b>Created at:</b></div>
                        <div class="col-10">
                            {{ $order->created_at }}
                        </div>
                    </div>

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
{{--                            {{ $order->user_own_id }}--}}
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

{{--                    <div class="row">--}}
{{--                        <div class="col-2 text-right"><b>Quantity:</b></div>--}}
{{--                        <div class="col-10">{{ $order->quantity }}</div>--}}
{{--                    </div>--}}

                    <div class="row">
                        <div class="col-2 text-right"><b>Products:</b></div>
                        <div class="col-10">

                            <table class="table table-striped" data-table="insert_here">
                                <thead>
                                <tr>
{{--                                    <th>UUID</th>--}}
                                    <th>Title ru</th>
                                    <th>Image</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total Price</th>
{{--                                    <th colspan="3">Actions</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $key => $product)
                                    <tr>
                                        <td>
                                            <a href="{{ route('product.show', [$product->uuid]) }}" target="_blank">
                                                {{ mb_substr($product->title_ru, 0, 50) }}
                                                {{ mb_strlen($product->title_ru) > 50 ? "..." : "" }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ $dataProducts[$key]['photo_main']['link'] }}" target="_blank">
                                                <img src="{{ $dataProducts[$key]['photo_main']['link'] }}"
                                                     title="{{ $dataProducts[$key]['photo_main']['description_ru'] }}"
                                                     style="width: 50px; height: auto; max-height: 100px;">
                                            </a>
                                        </td>
                                        <td class="text-right">
                                            <b>{{ $product->op_quantity }}</b>
                                        </td>
                                        <td class="text-right">
                                            <b>{{ $dataProducts[$key]['price_float'] }} ₴</b>
                                        </td>
                                        <td class="text-right">
                                            <b>{{ $dataProducts[$key]['price_total'] }} ₴</b>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot class="thead-light">
                                <tr>
                                    <td class="text-right"><b>Total:</b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right">
                                        <b>{{ $dataOrder['total_price'] }} ₴</b>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <br>


{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <h4 class="display-6">Actions:</h4>--}}

{{--                    <div class="buttons">--}}

{{--                        <div class="buttons-item d-inline-block">--}}
{{--                            <form action="{{ route('product.destroy', [$product->uuid]) }}" method="post">--}}
{{--                                @csrf--}}
{{--                                @method('DELETE')--}}
{{--                                <button class="btn btn-danger" type="submit">Delete</button>--}}
{{--                            </form>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <br>

        </div>
    </div>
@endsection
