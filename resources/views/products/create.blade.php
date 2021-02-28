@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Add a Product</h1>

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

                <form enctype="multipart/form-data" method="post" action="{{ route('product.store') }}">
                    @csrf

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="name_ru">Title ru:</label>
                            <input type="text" class="form-control" name="title_ru"/>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="description_ru">Description ru:</label>
                            <textarea class="form-control" name="description_ru" rows="6"></textarea>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="number">Quantity:</label>
                            <input type="number" class="form-control text-right" name="quantity" value="10"/>
                        </div>
                    </div>

                    <div class="col-6">
{{--                        <div class="form-group">--}}
{{--                            <label for="price">Price:</label>--}}
{{--                            <input type="text" class="form-control" name="price"/>--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}
{{--                            <label for="tax">Tax:</label>--}}
{{--                            <input type="text" class="form-control" name="tax"/>--}}
{{--                        </div>--}}

                        <div class="form-group">
                            <label for="price">Price:</label>
                            <div class="input-group">
                                <input type="text" class="form-control text-right" aria-label="" name="price" value="0.00">
                                <div class="input-group-append">
                                    <span class="input-group-text">₴</span>
                                    <span class="input-group-text">0.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

{{--                    <div class="col-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="tax">Tax:</label>--}}
{{--                            <div class="input-group">--}}
{{--                                <input type="text" class="form-control text-right" aria-label="" name="tax" value="0.00">--}}
{{--                                <div class="input-group-append">--}}
{{--                                    <span class="input-group-text">₴</span>--}}
{{--                                    <span class="input-group-text">0.00</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <br>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>

                </form>
            </div>
        </div>
@endsection
