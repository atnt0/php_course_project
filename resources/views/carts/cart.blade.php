@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Cart</h1>

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
                <div class="col-12">
                    {{--                    <h4 class="display-6">Actions:</h4>--}}

                    <div class="buttons">
                        <div class="buttons-item d-inline-block">
                            <a href="{{ route('cart.checkout', []) }}"
                               class="btn btn-primary">Next</a>
                        </div>
                    </div>
                </div>
            </div>
            <br>


            <table class="table table-striped" data-table="insert_here">
                @include('carts.parts._items')
            </table>
            <br>


            <div class="row">
                <div class="col-12">
{{--                    <h4 class="display-6">Actions:</h4>--}}

                    <div class="buttons">
                        <div class="buttons-item d-inline-block">
                            <a href="{{ route('cart.checkout', []) }}"
                               class="btn btn-primary">Next</a>
                        </div>
                    </div>
                </div>
            </div>
            <br>

        </div>
    </div>

@endsection
