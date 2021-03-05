

{{--{{ dd( session() ) }}--}}
<thead>
<tr>
    <th>Index</th>
    {{--                    <th>UUID</th>--}}
    <th>Title ru</th>
    <th>Image</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Total Price</th>
    <th>Actions</th>
</tr>
</thead>

<tbody>

@if( !empty($cart) )
{{--        {{ dd( $cart ) }}--}}

    @csrf
    @foreach($cart['products'] as $product_id => $dataOfProduct)
    <tr>
{{--        <td>--}}
{{--            {{ dd($dataOfProduct) }}--}}
{{--            {{ $dataOfProduct['uuid'] }}--}}
{{--        </td>--}}

        <td style="vertical-align: middle;">
            {{ $dataOfProduct['index'] }}
        </td>

        <td style="vertical-align: middle;">
            <a href="{{ route('product.show', [ $dataOfProduct['uuid'] ]) }}" target="_blank">
                {{ mb_substr($dataOfProduct['title_ru'], 0, 50) }}
                {{ mb_strlen($dataOfProduct['title_ru']) > 50 ? "..." : "" }}
            </a>
        </td>

        <td style="vertical-align: middle;">
            <a href="{{ $dataOfProduct['photo_main']['link'] }}" target="_blank">
                <img src="{{ $dataOfProduct['photo_main']['link'] }}"
                     title="{{ $dataOfProduct['photo_main']['description_ru'] }}"
                     style="width: 50px; height: auto; max-height: 100px;" />
            </a>
        </td>

        <td class="text-right" data-type="price" style="vertical-align: middle;">
            {{--            {{ $dataOfProduct['price'] }}--}}
            <b>{{ $dataOfProduct['price_float'] }} ₴</b>
        </td>

        <td class="text-right" data-type="quantity" style="vertical-align: middle;">

            <div class="block_quantity" data-action="{{ route('cart.changeQuantityProductInCart', ['product_uuid' => $dataOfProduct['uuid'] ]) }}"
                 data-product-uuid="{{ $dataOfProduct['uuid'] }}">
                {{--                            <input type="number" class="form-control" name="add_to_cart[quantity]" value="1">--}}
                <input type="button" name="btn_down_quantity" class="btn btn-sm btn-info text-white"
                    value="-" {{ $dataOfProduct['quantity'] <= 1 ? ' disabled="disabled"' : '' }}
                    style="display: inline-block; vertical-align: middle;">
                <input type="decimal" name="product_in_cart_quantity" class="form-control text-center"
                       decimal_separators=",,." min="0" max="1000000" maxlength="100" value="{{ $dataOfProduct['quantity'] }}"
                       style="display: inline-block; vertical-align: middle; width: auto; width: 4em;">
                <input type="button" name="btn_up_quantity" class="btn btn-sm btn-info text-white"
                    value="+"
                    style="display: inline-block; vertical-align: middle;">
            </div>
        </td>

        <td class="text-right" data-type="multi_price" style="vertical-align: middle;">
            <b><span class="content">{{ $dataOfProduct['multi_price_float'] }}</span> ₴</b>
        </td>

        <td style="vertical-align: middle;">
            <a href="{{ route('cart.removeFromCart', ['product_uuid' => $dataOfProduct['uuid'] ]) }}"
               data-remove-from-cart-product-id="{{ $dataOfProduct['uuid'] }}"
               title="Remove from cart"
               class="btn btn-sm btn-danger">Remove</a>
        </td>
    </tr>
    @endforeach
</tbody>

<tfoot class="thead-light">
    <tr>
        <td style="vertical-align: middle;"></td>
        <td class="text-right" style="vertical-align: middle;"><b>Total:</b></td>
        <td style="vertical-align: middle;"></td>
        <td style="vertical-align: middle;"></td>
        <td style="vertical-align: middle;"></td>
        <td class="text-right" data-type="total_price" style="vertical-align: middle;">
            <b><span class="content">{{ $cart['dataCart']['total_price_float'] }}</span> ₴</b>
        </td>
        <td></td>
    </tr>
</tfoot>

@endif
