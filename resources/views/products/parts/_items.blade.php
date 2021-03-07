@foreach($products as $key => $product)
        <div class="col">
            <a href="{{ route('product.show', [$product->uuid]) }}" style="color:#000;">
                <div>
                    <img src="{{  $dataProducts[$key]['photo_main']['link'] }}" style="width: 100%;">
                </div>
                <div>
                    {{ $product->title_ru }}
                </div>
                <div>
                    {{ mb_substr($product->description_ru, 0, 20) }}
                    {{ mb_strlen($product->description_ru) > 20 ? "..." : "" }}
                </div>
                <div>
                    <b>{{ $dataProducts[$key]['price_float'] }}  ₴</b>
                </div>
                <div>
                    <b>{{ !empty($dataProducts[$key]['last_status']) ? $dataProducts[$key]['last_status']->title_ru : '' }}</b>
                </div>
            </a>
        </div>
@endforeach
