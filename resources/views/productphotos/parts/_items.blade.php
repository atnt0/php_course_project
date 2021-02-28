@foreach($productPhotos as $key => $productPhoto)
    <tr>
        <td>
            {{ $productPhoto->uuid }}
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
        <td>

        </td>
        <td>
            <a href="{{ route('product.photo.edit', $productPhoto->uuid) }}" class="btn btn-primary">Edit</a>

            <div class="buttons-item d-inline-block">
                <form action="{{ route('product.photo.destroy', [$productPhoto->uuid]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </div>
        </td>
        <td>
            <a href="{{ route('product.show', $productPhoto->product_uuid) }}" class="btn btn-primary"
               title="This photo attached for product">View_Product</a>
        </td>
    </tr>
@endforeach
