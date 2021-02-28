@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Category</h1>

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

            <br>

            <div class="row">
                <div class="col col-12">

                    <div class="row">
                        <div class="col-2 text-right"><b>Title ru:</b></div>
                        <div class="col-10">{{ $category->title_ru }}</div>
                    </div>

                    <div class="row">
                        <div class="col-2 text-right"><b>Description ru:</b></div>
                        <div class="col-10">
                            <p>{{ $category->description_ru }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2 text-right"><b>Created at:</b></div>
                        <div class="col-10">{{ $category->created_at }}</div>
                    </div>

                    <div class="row">
                        <div class="col-2 text-right"><b>Updated at:</b></div>
                        <div class="col-10">{{ $category->updated_at }}</div>
                    </div>

                </div>
            </div>
            <br>


            <div class="row">
                <div class="col-12">
                    <h4 class="display-6">Actions:</h4>

                    <div class="buttons">

                        <div class="buttons-item d-inline-block">
                            <a href="{{ route('product.category.edit', [$category->id]) }}" class="btn btn-primary">Edit</a>
                        </div>

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

        </div>
    </div>
@endsection
