
<table class="table table-striped" data-table="insert_here">
    <thead>
    <tr>
        <th>Title ru</th>
        <th>Image</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Total Price</th>
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
                <b>{{ $dataProducts[$key]['price_multi_float'] }} ₴</b>
            </td>
        </tr>
    @endforeach

    </tbody>
    <tfoot class="thead-light">
    <tr>
        <td class="text-right"><b>Total:</b></td>
        <td colspan="3"></td>
        <td class="text-right">
            <b>{{ $dataOrder['total_price_float'] }} ₴</b>
        </td>
    </tr>
    </tfoot>
</table>
