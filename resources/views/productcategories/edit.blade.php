@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Edit a Category</h1>
            @include('layouts.parts._flash-message')

            <div class="row">
                <div class="col">

                </div>
            </div>
        </div>
    </div>
    <br>

    <form method="post" action="{{ route('product.category.update', $category->id) }}">
        @method('PATCH')
        @csrf

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="title_ru">Title ru:</label>
                    <input type="text" class="form-control" name="title_ru" value="{{ $category->title_ru }}" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="description_ru">Description ru:</label>
                    <textarea class="form-control" name="description_ru" rows="6">{{ $category->description_ru }}</textarea>
                </div>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>

    </form>
@endsection
