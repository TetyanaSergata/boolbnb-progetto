<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
    integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
  @yield('head')
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc="
    crossorigin="anonymous"></script>
  <title></title>
</head>

<body>
  <header>
    <nav>
      <div class="nav-left">
        <a href="{{route('my-home')}}">
          <i class="far fa-compass"></i>
          boolbnb
          {{-- <i class="far fa-compass"></i> --}}
        </a>
      </div>
      <div class="nav-right">
        <ul>
          <li>
            <form class="search-form-desktop" action="{{route('search')}}" method="POST">
              @csrf
              @method('POST')
              <input class="search-bar" type="text" name="city" value="">
              <input type="submit" class="btn btn-primary search-btn" value="Cerca">
            </form>
          </li>
          @if (Route::has('login'))
          @auth
          <li class="user">
            <a class="btn btn-primary" href="#">{{Auth::user()->name}}</a>
            <div class="dropdown">
              <ul>
                <li>
                  <a class="btn btn-primary" href="{{ route('account.index') }}">Account</a>
                </li>
                <li>
                  @if (Auth::check())
                    @php
                        $id = Auth::User()->id;
                    @endphp
                    <a class="btn btn-primary" href="{{route('account.user.edit', $id)}}">Modifica</a>
                  @endif
                </li>
                <li>
                  <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </li>
              </ul>
            </div>
          </li>
          @else
          <li>
            <a class="btn btn-primary" href="#loginModal" style="cursor: pointer" data-toggle="modal">Accedi</a>
          </li>
          @if (Route::has('register'))
          <li>
            <a class="btn btn-primary" href="#registerModal" style="cursor: pointer" data-toggle="modal">Registrati</a>
          </li>
          @endif
          @endauth
          @endif
        </ul>
      </div>
      </div>
    </nav>

    <div class="search-mobile">
      <form class="search-form-mobile" action="{{route('search')}}" method="POST">
        @csrf
        @method('POST')
        <input class="search-bar" type="text" name="city" value="">
        <input type="submit" class="btn btn-primary search-btn" value="Cerca">
      </form>
    </div>

    {{-- hamburger menu per mobile --}}
    <nav class="hamburger-nav" role='navigation'>
      <div id="menuToggle">
        <input type="checkbox" />
        <span></span>
        <span></span>
        <span></span>
        <ul id="menu">
          @if (Route::has('login'))
          @auth
          <li>
            <a class="btn btn-primary" href="{{ route('account.index') }}">Account</a>
          </li>
          <li>
            @if (Auth::check())
              @php
                  $id = Auth::User()->id;
              @endphp
              <a class="btn btn-primary" href="{{route('account.user.edit', $id)}}">Modifica</a>
            @endif
          </li>
          <li>
            <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form-mobile').submit();">
              {{ __('Logout') }}</a>
            <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
          @else
          <li>
            <a class="btn btn-primary" href="#loginModal" style="cursor: pointer" data-toggle="modal">Accedi</a>
          </li>
          <li>
            <a class="btn btn-primary" href="#registerModal" style="cursor: pointer" data-toggle="modal">Registrati</a>
          </li>
          @endauth
          @endif
        </ul>
      </div>
    </nav>
    @include('partials.login')
    @include('partials.register')
    @yield('scripts')
  <script src="{{asset('js/_header.js')}}"></script>
  </header>
