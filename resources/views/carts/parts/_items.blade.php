

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

        <td>
            {{ $dataOfProduct['index'] }}
        </td>

        <td>
            <a href="{{ route('product.show', [$dataOfProduct['uuid']]) }}" target="_blank">
                {{ mb_substr($dataOfProduct['title_ru'], 0, 50) }}
                {{ mb_strlen($dataOfProduct['title_ru']) > 50 ? "..." : "" }}
            </a>
        </td>

        <td>
            <a href="{{ $dataOfProduct['photo_main']['link'] }}" target="_blank">
                <img src="{{ $dataOfProduct['photo_main']['link'] }}"
                     title="{{ $dataOfProduct['photo_main']['description_ru'] }}"
                     style="width: 50px; height: auto; max-height: 100px;" />
            </a>
        </td>

        <td class="text-right">
            {{--            {{ $dataOfProduct['price'] }}--}}
            <b>{{ $dataOfProduct['price_float'] }} ₴</b>
        </td>

        <td class="text-right">
{{--            <b>{{ $dataOfProduct['quantity'] }}</b>--}}
            <input type="number" class="form-control text-center" name="product_cart_quantity" value="{{ $dataOfProduct['quantity'] }}">
        </td>

        <td class="text-right">
            <b>{{ $dataOfProduct['multi_price_float'] }} ₴</b>
        </td>

        <td>
            <a href="{{ route('cart.removeFromCart', ['product_uuid' => $dataOfProduct['uuid'] ]) }}"
               data-remove-from-cart-product-id="{{ $dataOfProduct['uuid'] }}"
               title="Remove from cart"
               class="btn btn-danger">Remove</a>
        </td>
    </tr>
    @endforeach
</tbody>

<tfoot class="thead-light">
    <tr>
        <td></td>
        <td class="text-right"><b>Total:</b></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-right">
            <b>{{ $cart['dataCart']['total_price_float'] }} ₴</b>
        </td>
        <td></td>
    </tr>
</tfoot>

@endif
