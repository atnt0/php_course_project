@extends('base')

@section('title', $category->title_ru .' - '. 'Редактирование категории')

@section('main')
    <div class="row">
        <div class="col-12">
{{--            <h1 class="display-3">Edit a Category</h1>--}}
            <h2 class="display-5">{{ $category->title_ru }}</h2>
            @include('layouts.parts._flash-message')

            <div class="row">
                <div class="col">
                    <a href="{{ route('product.category.show', [$category->id]) }}" class="btn btn-primary">View</a>

                </div>
            </div>
        </div>
    </div>
    <br>

    <form method="post" action="{{ route('product.category.update', $category->id) }}">
        @method('PATCH')
        @csrf

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="title_ru">Title ru:</label>
                    <input type="text" class="form-control" name="title_ru" value="{{ $category->title_ru }}" />
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="parentCategory">Parent Category:</label>
                    <select class="form-control" name="parent_category_id" id="parentCategory">
                        <option value="">Not have a parent</option>
                        @foreach($dataCategory['select_category'] as $k => $categoryCategory)
                            <option value="{{ $categoryCategory['id'] }}"{{ $categoryCategory['selected'] ? ' selected="selected"' : '' }}>
                                {{ $categoryCategory['title_ru'] }}</option>
                        @endforeach
                    </select>
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
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>

    </form>
    <br>

    <div class="row">
        <div class="col-12">
            <h4 class="display-6">Actions:</h4>

            <div class="buttons">
                <div class="buttons-item d-inline-block">
                    <form action="{{ route('product.category.destroy', [$category->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <br>
@endsection
