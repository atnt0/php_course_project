@foreach($products as $product)
    <tr>
{{--        <td>--}}
{{--            {{ $product->id }}--}}
{{--        </td>--}}
        <td>
            {{ $product->uuid }}
        </td>
        <td>
            {{ $product->title_ru }}
        </td>
        <td>
            {{ mb_substr($product->description_ru, 0, 20) }}
            {{ mb_strlen($product->description_ru) > 20 ? "..." : "" }}
        </td>
        <td>

        </td>
        <td>

        </td>

        <td>
            <a href="{{ route('product.show', [$product->uuid]) }}" class="btn btn-primary">View</a>
        </td>
        <td>

        </td>
    </tr>
@endforeach
