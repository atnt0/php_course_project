@if ($message = \Illuminate\Support\Facades\Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

{{--@if ($message = \Illuminate\Support\Facades\Session::get('error'))--}}
{{--    <div class="alert alert-danger alert-block">--}}
{{--        <button type="button" class="close" data-dismiss="alert">×</button>--}}
{{--        <strong>{{ $message }}</strong>--}}
{{--    </div>--}}
{{--@endif--}}

@if ($message = \Illuminate\Support\Facades\Session::get('warning'))
    <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = \Illuminate\Support\Facades\Session::get('info'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        Please check the form below for errors
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{--@if (session('status'))--}}
@if( $message = \Illuminate\Support\Facades\Session::get('status') )
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
        {{ \Illuminate\Support\Facades\Session::remove('status') }}
    </div>
@endif


{{--@if( Illuminate\Support\Facades\Session::has('success') )--}}
{{--    <div class="alert alert-success">--}}
{{--        {{ \Illuminate\Support\Facades\Session::get('success') }}--}}
{{--    </div>--}}
{{--@endif--}}

{{--@if( Illuminate\Support\Facades\Session::has('fail') )--}}
{{--    <div class="alert alert-danger">--}}
{{--        {{Session::get('fail')}}--}}
{{--    </div>--}}
{{--@endif--}}


{{--@if( $status = session('status') )--}}
{{--    <div class="alert alert-success">--}}
{{--        {{ $status }}--}}
{{--        {{ session()->flash('status') }}--}}
{{--    </div>--}}
{{--@endif--}}


{{--<div>--}}
{{--    @if ($errors->any())--}}
{{--        <div class="alert alert-danger">--}}
{{--            <ul>--}}
{{--                @foreach ($errors->all() as $error)--}}
{{--                    <li>{{ $error }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--        <br />--}}
{{--    @endif--}}
{{--</div>--}}


