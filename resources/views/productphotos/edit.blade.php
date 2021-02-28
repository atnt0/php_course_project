@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Edit a Photo</h1>

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

            <form method="post" action="{{ route('product.photo.update', $photo->uuid) }}">
                @method('PATCH')
                @csrf

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="description_ru">For Product ru:</label>
                        <select class="form-control" name="product_uuid" id="product_uuid">
                            @foreach($products as $product)
                                <option value="{{ $product->uuid }}">{{ $product->title_ru }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="description_ru">Description ru:</label>
                        <textarea class="form-control" name="description_ru" rows="6">{{ $photo->description_ru }}</textarea>
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
