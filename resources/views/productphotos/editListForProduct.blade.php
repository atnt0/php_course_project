@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Edit a Photos for Product</h1>

            <div class="row">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="col">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <br />
                @endif
            </div>

            <div class="row">
{{--                @if (Auth::guest())--}}
                    {{--                    Only registred users can be use this function.--}}
{{--                @else--}}
                    <div class="col">
                        <a href="{{ route('product.photo.createForProduct', [$product->uuid]) }}" class="btn btn-info text-white">Add photo</a>

                        <a href="{{ route('product.show', [$product->uuid]) }}" class="btn btn-primary">View_Product</a>
                    </div>
{{--                @endif--}}
            </div>
            <br>

            <div data-table="sortable" data-action="{{ route('product.photo.editListForProduct.setProductPhotosPositions', [$product->uuid]) }}">
                @csrf
                <div class="row">
                    @include('productphotos.parts._editItems')
                </div>
            </div>

        </div>
    </div>

@endsection
