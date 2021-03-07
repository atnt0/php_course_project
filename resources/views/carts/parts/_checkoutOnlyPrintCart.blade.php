<div class="card mb-3" style="position: sticky; top: 80px; ">
    {{--   padding: 6px; background: linear-gradient(127deg, #6875e5, #003c94);--}}
    <div style="background: #ffffff;">
        <h5 class="card-header">In your order <span>{{ count($cart['products']) }} products</span></h5>

        <div class="card-body">

            <div class="form-group">
                {{--    <label for="orderComment">Comment</label>--}}
                <div style="overflow-y: auto; max-height: calc(60vh); ">

                    <table class="table table-striped">
                        @if( !empty($cart) )
                            @foreach($cart['products'] as $product_id => $dataOfProduct)
                                <tr>

                                    <td>
                                        <a href="{{ $dataOfProduct['photo_main']['link'] }}" target="_blank">
                                            <img src="{{ $dataOfProduct['photo_main']['link'] }}"
                                                 title="{{ $dataOfProduct['photo_main']['description_ru'] }}"
                                                 style="width: 50px; height: auto; max-height: 100px;" />
                                        </a>
                                    </td>

                                    <td>
                                        <a href="{{ route('product.show', [ $dataOfProduct['uuid'] ]) }}" target="_blank">
                                            {{ mb_substr($dataOfProduct['title_ru'], 0, 60) }}
                                            {{ mb_strlen($dataOfProduct['title_ru']) > 60 ? "..." : "" }}
                                        </a>
                                    </td>

                                    <td class="text-right" style="white-space: nowrap;">
                                        <span>{{ $dataOfProduct['quantity'] }}</span><span> x</span>
                                        <b><span>{{ $dataOfProduct['price_float'] }}</span><span> ₴</span></b>
                                        <br>
                                        <b><span>{{ $dataOfProduct['multi_price_float'] }}</span><span> ₴</span></b>
                                    </td>

                            @endforeach

                        @endif
                    </table>
                </div>
            </div>

            <div style="display: table; width: 100%;">
                <div style="display: table-cell; vertical-align: middle; white-space: nowrap; padding-right: 20px; font-size: 18px;">
                    Total price
                </div>
                <div style="display: table-cell; vertical-align: middle; text-align: right; white-space: nowrap; font-size: 36px; font-weight: 700;">
                    <b><span class="content">{{ $cart['dataCart']['total_price_float'] }}</span> ₴</b>
                </div>
            </div>

        </div>
    </div>

</div>
