@if (Auth::guest())
    <nav class="navbar has-shadow">
        <div class="container">
            <div class="navbar-brand">
                <a href="{{ url('/home') }}" class="navbar-item">{{ config('app.name') }}</a>

                <div class="navbar-burger burger" data-target="navMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="navbar-menu" id="navMenu">
                <div class="navbar-start"></div>

                <div class="navbar-end">

                    <a class="navbar-item " href="{{ route('login') }}">Login</a>
                    <a class="navbar-item " href="{{ route('register') }}">Register</a>
                    <a class="navbar-item" href="{{url('/about')}}">About</a>
                    <div class="navbar-item has-dropdown is-hoverable">
                        @auth
                            <a class="navbar-link" href="#">{{ Auth::user()->name }}</a>
                        @endauth

                        <div class="navbar-dropdown">
                            <a class="navbar-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@else
    <nav class="navbar has-shadow">
        <div class="container">
            <div class="navbar-brand">
                <a href="{{ url('/home') }}" class="navbar-item">{{ config('app.name') }}</a>

                <div class="navbar-burger burger" data-target="navMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="navbar-menu" id="navMenu">
                <div class="navbar-start">
                    <a class="navbar-item" href="{{url('/about')}}">About</a>
                    @if(Auth::user()->role=='User')
                    @endif
                    @if(Auth::user()->role =='Admin' || Auth::user()->role == 'Uitleendienst')
                        <a class="navbar-item" href="{{route('inventory')}}">Inventory Management</a>
                        <a class="navbar-item" href="{{route('loan')}}">Loan System</a>
                    @endif
                    @if(Auth::user()->role=='Admin')
                        <a class="navbar-item" href="{{route('admin')}}">Admin Panel</a>
                    @endif
                </div>
                <div class="navbar-end">
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link" href="#">{{ Auth::user()->name }}</a>

                        <div class="navbar-dropdown">
                            <a class="navbar-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endif
