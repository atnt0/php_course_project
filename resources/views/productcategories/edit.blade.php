@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Edit a Category</h1>

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

            <form method="post" action="{{ route('product.category.update', $category->id) }}">
                @method('PATCH')
                @csrf

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="title_ru">Title ru:</label>
                        <input type="text" class="form-control" name="title_ru" value="{{ $category->title_ru }}" />
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="description_ru">Description ru:</label>
                        <textarea class="form-control" name="description_ru" rows="6">{{ $category->description_ru }}</textarea>
                    </div>
                </div>
                <br>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="submit" class="btn btn-primary">Update
                </div>
            </form>
        </div>
    </div>
@endsection
