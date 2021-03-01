@foreach($productPhotos as $key => $productPhoto)
    <tr id="{{ $productPhoto->uuid }}" data-product-id="{{ $productPhoto->uuid }}">
        <td class="icon-move">
            <input type="hidden" value="{{ $productPhoto->uuid }}" id="item" name="item">
            <div class="" style="padding: 20px; background-color: #ccc">
                +
            </div>
        </td>
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
    </tr>
@endforeach
