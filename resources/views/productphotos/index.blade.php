@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Product Photos</h1>
            @include('layouts.parts._flash-message')

        </div>
    </div>
    <br>

    <div class="row">
        <div class="col">
            <table class="table table-striped" data-table="insert_here">
                <thead>
                <tr>
                    <th>Index</th>
                    <th>File name</th>
                    <th>Description ru</th>
                    <th colspan="3">Links</th>
                </tr>
                </thead>
                <tbody>
                    @include('productphotos.parts._items')
                </tbody>
            </table>
        </div>
    </div>
@endsection
