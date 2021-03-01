@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Show a Product</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br />
            @endif

{{--            @if (Auth::guest())--}}
{{--                Only registred users can be use this function.--}}
{{--            @else--}}
{{--                <a href="{{ route('product.complaints.createForProductId', ['productId' => $product->id]) }}"--}}
{{--                   class="btn btn-primary">Add complaint</a>--}}
{{--            @endif--}}

{{--            @if( \Illuminate\Support\Facades\Auth::user() != null && \Illuminate\Support\Facades\Auth::user()->hasRole('admin') )--}}
{{--                <a href="{{ route('product.complaints.indexComplaintsForProduct', ['productId' => $product->id]) }}"--}}
{{--                   class="btn btn-primary" title="All complaints for Product">All Complaints</a>--}}
{{--            @endif--}}

            <br>

            <div class="row">
                <div class="col col-12">

{{--                    <div class="row">--}}
{{--                        <div class="col-4 text-right"><b>ID:</b></div>--}}
{{--                        <div class="col-8">{{ $product->id }}</div>--}}
{{--                    </div>--}}

                    <div class="row">
                        <div class="col-2 text-right"><b>Title ru:</b></div>
                        <div class="col-10">{{ $product->title_ru }}</div>
                    </div>

                    <div class="row">
                        <div class="col-2 text-right"><b>Description ru:</b></div>
                        <div class="col-10">
                            <p>{{ $product->description_ru }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2 text-right"><b>Status:</b></div>
                        <div class="col-10">
                            <b>{{ $product->product_status_title_ru }}</b>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2 text-right"><b>User own:</b></div>
                        <div class="col-10">
                            <span {{-- data-user-own-id="{{ $dataProduct['user_own']['id'] }}"--}}>
                                {{ $dataProduct['user_own']['name'] }}{{ ($dataProduct['user_own']['you'] ? " (You)" : "" ) }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2 text-right"><b>Category:</b></div>
                        <div class="col-10">{{ $product->category_title_ru }}</div>
                    </div>

                    <div class="row">
                        <div class="col-2 text-right"><b>Price:</b></div>
                        <div class="col-10"><b>{{ $dataProduct['price_float'] }}</b></div>
                    </div>

{{--                    <div class="row">--}}
{{--                        <div class="col-2 text-right"><b>Created at:</b></div>--}}
{{--                        <div class="col-10">{{ $product->created_at }}</div>--}}
{{--                    </div>--}}

{{--                    <div class="row">--}}
{{--                        <div class="col-2 text-right"><b>Updated at:</b></div>--}}
{{--                        <div class="col-10">{{ $product->updated_at }}</div>--}}
{{--                    </div>--}}

                    <div class="row">
                        <div class="col-2 text-right"><b>Photos:</b></div>
                        <div class="col-10">
                            <ul style="list-style: none; padding: 0;">
                            @foreach($dataProduct['productPhotos'] as $productPhoto)
                                <li style=" display: inline-block; padding: 5px 20px; border: 1px solid #ccc;">
                                    <a href="{{ $productPhoto['link'] }}" target="_blank">
                                        <img src="{{ $productPhoto['link'] }}" title="{{ $productPhoto['description_ru'] }}"
                                             style="width: 100px; height: auto; max-height: 100px;">
                                    </a>

                                    <a href="{{ route('product.photo.edit', $productPhoto['uuid']) }}"
                                       class="btn btn-sm btn-primary">Edit</a>
                                </li>
                            @endforeach
                            </ul>
                            <a href="{{ route('product.photo.editPositionsForProduct', ['product_uuid' => $product->uuid]) }}"
                               class="btn btn-primary">Edit positions photos</a>
                        </div>
                    </div>

                </div>
            </div>
            <br>


            <div class="row">
                <div class="col-12">
                    <h4 class="display-6">Actions:</h4>

                    <div class="buttons">

                            <div class="buttons-item d-inline-block">
                                <a href="{{ route('product.edit', [$product->uuid]) }}" class="btn btn-primary">Edit</a>
                            </div>

                            <div class="buttons-item d-inline-block">
                                <form action="{{ route('product.destroy', [$product->uuid]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </div>

                    </div>
                </div>
            </div>
            <br>

        </div>
    </div>
@endsection
