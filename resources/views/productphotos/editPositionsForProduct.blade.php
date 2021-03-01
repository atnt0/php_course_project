@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Edit Positions Photos for Product</h1>

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
                @if (Auth::guest())
                    {{--                    Only registred users can be use this function.--}}
                @else
                    <div class="col">
                        <a href="{{ route('product.photo.create') }}" class="mb-3 btn btn-info text-white">Add photo</a>
                    </div>
                @endif

            </div>
            <br>

            <table class="table table-striped" data-table="sortable">
                <thead>
                <tr>
                    {{--                    <th>Id</th>--}}
{{--                    <th>UUID</th>--}}
                    <th>Index</th>
                    <th>File name</th>
                    <th>Description ru</th>
                </tr>
                </thead>
                <tbody>
                    @include('productphotos.parts._editItems')
                </tbody>
            </table>

        </div>
    </div>

@endsection
