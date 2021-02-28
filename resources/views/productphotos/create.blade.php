@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Add a Photo</h1>

            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br/>
                @endif

                <form enctype="multipart/form-data" method="post" action="{{ route('product.photo.store') }}">
                    @csrf

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <select class="form-control" name="product_uuid" id="product_uuid">
                                <option value="">Not Selected</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->uuid }}">{{ $product->title_ru }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="file">File:</label>
                            <input type="file" class="form-control" name="file"/>
                            <small class="form-text text-muted">Maximum file size 10 MB</small>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="description_ru">Description ru:</label>
                            <textarea class="form-control" name="description_ru" rows="2"></textarea>
                        </div>
                    </div>
                    <br>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>

                </form>
            </div>
        </div>
@endsection
