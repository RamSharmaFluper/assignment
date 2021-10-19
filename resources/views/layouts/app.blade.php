<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <!-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> -->
                @if(Auth::user())
                <a class="navbar-brand" href="{{ url('home') }}">
                    Companies
                </a>
                <a class="navbar-brand" href="{{ url('employees') }}">
                    Employee
                </a>
                @endif
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    @php $locale = session()->get('locale'); @endphp

                    <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Language <span class="caret"></span>
                            </a>
                            @switch($locale)
                                @case('fr')
                                <img src="{{asset('img/fr.png')}}" width="30px" height="20x"> French
                                @break
                                @case('es')
                                <img src="{{asset('img/jp.png')}}" width="30px" height="20x"> Spain
                                @break
                                @case('jp')
                                <img src="{{asset('img/jp.png')}}" width="30px" height="20x"> Japanese
                                @break
                                @default
                                <img src="{{asset('img/us.png')}}" width="30px" height="20x"> English
                            @endswitch
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="lang/en"><img src="{{asset('img/us.png')}}" width="30px" height="20x"> English</a>
                                <a class="dropdown-item" href="lang/fr"><img src="{{asset('img/fr.png')}}" width="30px" height="20x"> French</a>
                                <a class="dropdown-item" href="lang/es"><img src="{{asset('img/es.png')}}" width="30px" height="20x"> Spanish</a>
                                <a class="dropdown-item" href="lang/jp"><img src="{{asset('img/jp.png')}}" width="30px" height="20x"> Japanese</a>
                            </div>

                            <!-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="#" onclick="setlocale('en')"  class="dropdown-item">English</a>
                            <a href="#" onclick="setlocale('es')"  class="dropdown-item">Spanish</a>
                               
                            </div> -->
                        </li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li> -->
                            <!-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif -->
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

  function setlocale(lang){
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        type:'POST',
        url:'/setlocale',
        data: {
            "lang": lang,
            "_token": token,
        },
        success:function(data) {
            alert("sucess");
            localStorage.setItem("lang", lang);
          //location.reload();
        }
    });
  }
</script>
