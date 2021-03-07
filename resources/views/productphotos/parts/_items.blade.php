@foreach($productPhotos as $key => $productPhoto)
    <tr data-product-id="{{ $productPhoto->uuid }}">
        <td>
            {{ $productPhoto->index }}
        </td>
        <td>
            <img src="{{  $dataProductPhotos[$key]['link'] }}" style="width: 100px; height: auto; max-height: 100px;">
        </td>
        <td>
            {{ mb_substr($productPhoto->description_ru, 0, 20) }}
            {{ mb_strlen($productPhoto->description_ru) > 20 ? "..." : "" }}
        </td>
        <td>
            <a href="{{ route('product.show', [$productPhoto->product_uuid]) }}" class="btn btn-primary"
               title="This photo attached for product">View_Product</a>
        </td>
    </tr>
@endforeach
