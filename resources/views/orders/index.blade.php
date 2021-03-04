@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Orders</h1>

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
{{--                    --}}{{--                    Only registred users can be use this function.--}}
{{--                @else--}}
{{--                    <div class="col">--}}
{{--                        <a href="{{ route('order.createFakeOrder') }}" class="mb-3 btn btn-info text-white">[Create fake Order]</a>--}}
{{--                    </div>--}}
{{--                @endif--}}

{{--                <div class="col">--}}
{{--                    <div class="float-right">--}}
{{--                        <form id="searchForm" name="searchForm" action="{{ route('order.search.ajax') }}" method="post">--}}
{{--                            @csrf--}}
{{--                            <input type="text" name="searchString" placeholder="name" />--}}
{{--                            <button class="btn btn-info text-white" type="submit">Search</button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <br>

            <table class="table table-striped" data-table="insert_here">
                <thead>
                <tr>
                    <th>Index</th>
                    <th>UUID</th>
                    <th>Comment</th>
                    <th>Full name</th>
                    <th>Contacts</th>
                    <th>Address</th>
{{--                    <th>User_own</th>--}}
                    <th>User Data</th>
{{--                    <th colspan="3">Links</th>--}}
                </tr>
                </thead>
                <tbody>
                    @include('orders.parts._items')
                </tbody>
            </table>

        </div>
    </div>

@endsection
