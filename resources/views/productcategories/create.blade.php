@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Add a Category</h1>
            @include('layouts.parts._flash-message')

            <div class="row">
                <div class="col">

                </div>
            </div>
        </div>
    </div>
    <br>

    <form enctype="multipart/form-data" method="post" action="{{ route('product.category.store') }}">
        @csrf

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="name_ru">Title ru:</label>
                    <input type="text" class="form-control" name="title_ru"/>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="description_ru">Description ru:</label>
                    <textarea class="form-control" name="description_ru" rows="6"></textarea>
                </div>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </div>

    </form>
@endsection
