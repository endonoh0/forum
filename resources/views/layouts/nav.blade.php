<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <!-- Collapsed Hamburger -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <!-- Browse drop-down -->
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Browse <span class="caret"></span></a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <!-- All threads -->
                    <div><a class="dropdown-item" href="/threads">All Threads</a></div>
                    @if (auth()->check())
                        <!-- Divider -->
                        <div class="dropdown-divider"></div>
                        <!-- My threads -->
                        <div><a class="dropdown-item" href="/threads?by={{ auth()->user()->name }}">My Threads</a></div>
                    @endif
                        <!-- Popular threads -->
                    <div><a class="dropdown-item" href="/threads?popular=1">Popular Threads</a></div>
                        <!-- Unanswered threads -->
                    <div><a class="dropdown-item" href="/threads?unanswered=1">Unanswered Threads</a></div>
                  </div>
                </li>
                <!-- Link to create a thread -->
                <li class="nav-item active">
                    <a class="nav-link" href="/threads/create">New Thread</a>
                </li>

                <!-- Channels drop-down -->
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Channels <span class="caret"></span></a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($channels as $channel)
                            <div>
                                <a class="dropdown-item" href="/threads/{{ $channel->slug }}">{{ $channel->name }}</a>
                            </div>
                            <div class="dropdown-divider"></div>
                        @endforeach
                  </div>
                </li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <!-- Username drop down -->
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <!-- Link to my profile -->
                            <div><a class="dropdown-item" href="{{ route('profile', Auth::user()) }}">My Profile</a></div>
                            <!-- Logout -->
                            <div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
