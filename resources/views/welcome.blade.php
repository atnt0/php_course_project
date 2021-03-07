@extends('layouts.app')

@section('title', 'Добро пожаловать!')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-12">
{{--            <h1 class="display-3">Hello!</h1>--}}
            @include('layouts.parts._flash-message')
        </div>
    </div>
    <br>

    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
{{--                <div class="card-header">{{ __('Dashboard') }}</div>--}}
                <div class="card-header">Hello!</div>

                <div class="card-body">
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    {{ __('You are logged in!') }}--}}
                    This is main page for all users and guests
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
