<!-- Left Side Of Navbar -->
<ul class="navbar-nav mr-auto">

</ul>

<!-- Right Side Of Navbar -->
<ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a class="nav-link nav-link" href="{{ route('product.index') }}">Products</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link" href="{{ route('product.category.index') }}">Product Categories</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link" href="{{ route('product.photo.index') }}">Product Photos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link" href="{{ route('order.index') }}">Orders</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link" href="{{ route('cart.index') }}">Cart (virtual)</a>
    </li>

{{--    @if ( Auth::user() && Auth::user()->hasRole('admin') )--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link nav-link" href="{{ route('users.index') }}">Users</a>--}}
{{--        </li>--}}
{{--    @endif--}}

<!-- Authentication Links -->
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif

    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
</ul>
