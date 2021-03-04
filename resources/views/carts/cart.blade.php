{{--{{ dd($cart) }}--}}
@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Cart</h1>

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

            <table class="table table-striped" data-table="insert_here">
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>Index</th>--}}
{{--                    <th>UUID</th>--}}
{{--                    <th>Title ru</th>--}}
{{--                    <th>Image</th>--}}
{{--                    <th>Price</th>--}}
{{--                    <th>Quantity</th>--}}
{{--                    <th>Total Price</th>--}}
{{--                    <th>Actions</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
                    @include('carts.parts._items')
{{--                </tbody>--}}
            </table>

        </div>
    </div>

@endsection
