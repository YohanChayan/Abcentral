<style>

.bg-custom-2{
    background-image: linear-gradient(15deg, #e9edf0 0%, #c3e1f7 100%);
}

li{
    font-size: 1.3em;
}

</style>


<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm bg-custom-2">
    <div class="container">
        @if(Auth::check())
            <a class="navbar-brand" href="{{ url('/dashboard') }}">
                <img src="{{asset('/img/logo.png')}}" alt="logoUDG" style="min-height: 50px; padding-top: 0px; height: 60px;">
            </a>
        @else
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{asset('/img/logo.png')}}" alt="logoUDG" style="min-height: 50px; padding-top: 0px; height: 60px;">
            </a>
        @endif

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                @if(Auth::check() && (Auth::user()->role == 'normal'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('libros.create') }}">Capturar libro</a>
                    </li>
                @endif

                @if(Auth::check() && (Auth::user()->role == 'normal'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logs') }}">Historial de acciones</a>
                    </li>

                @endif

            </ul>

            @if(Auth::check() && (Auth::user()->role == 'normal'))
                @if($lastNum_adquisicion ?? '')
                <ul class="navbar-nav me-center">
                  <li class="nav-item">
                    <a class="nav-link" href="#">Ultimo libro capturado: <strong> {{$lastNum_adquisicion ?? ''}} </strong></a>
                  </li>
                </ul>
                @endif
            @endif

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Cerrar sesión') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
