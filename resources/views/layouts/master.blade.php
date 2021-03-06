<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <!-- Font Awesome icons -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">

          <!-- Collapsed Hamburger -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <!-- Branding Image -->
          <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
          </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <!-- Left Side Of Navbar -->
          <ul class="nav navbar-nav">
            &nbsp;
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @guest
              <li><a href="{{ route('login') }}">Login</a></li>
              <li><a href="{{ route('register') }}">Register</a></li>
            @else
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                  {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                  <li>
                    <a href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                      Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                  </li>
                  <li>
                    <a id="profile-link" href="{{ route('user.profile', Auth::user()->name) }}">Profile</a>
                  </li>
                  <li>
                    <a id="upload-link" href="{{ route('upload.upload') }}">Upload a picture</a>
                  </li>
                </ul>
              </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          @auth
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="search-form">
                  <search-autocomplete></search-autocomplete>
                </div>
                <div class="search-results"></div>
              </div>
            </div>
          @endauth
          <div class="panel panel-default">
            <div class="panel-body">
              @if (session('status'))
                <div class="alert alert-success">
                  @foreach (session('status') as $status)
                    <p>{{ $status }}</p>
                  @endforeach
                </div>
              @endif
              @if (session('error'))
                <div class="alert alert-danger">
                  @foreach (session('error') as $error)
                    {{ $error }}
                  @endforeach
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>

    @yield('content')
  </div>

  <!-- Scripts -->
  @section('footerscripts')
    <script src="{{ asset('js/app.js') }}"></script>
  @show
</body>
</html>
