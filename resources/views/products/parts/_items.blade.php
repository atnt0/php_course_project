@foreach($products as $key => $product)

    <div class="col-sm-3">
{{--        <td>--}}
{{--            {{ $product->id }}--}}
{{--        </td>--}}
        <div>
            <img src="{{  $dataProducts[$key]['photo_main']['link'] }}" style="width: 100%;">
        </div>
{{--        <div>--}}
{{--            {{ $product->uuid }}--}}
{{--        </div>--}}
        <div>
            {{ $product->title_ru }}
        </div>
        <div>
            {{ mb_substr($product->description_ru, 0, 20) }}
            {{ mb_strlen($product->description_ru) > 20 ? "..." : "" }}
        </div>
        <div>
            {{ $dataProducts[$key]['price_float'] }}
        </div>
        <div>
            {{ $product->category_title_ru }}
        </div>
        <div>
            <b>{{ $product->product_status_title_ru }}</b>
        </div>
        <div>
            <a href="{{ route('product.show', [$product->uuid]) }}" class="btn btn-primary">View</a>
        </div>
    </div>
@endforeach
