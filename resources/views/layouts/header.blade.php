<div class="top" id="home">
    <header>
        <div class="content">
            <div class="logo">
                <a href="{{ url('/') }}"><img src="{{ url('/homepage/images/logo.png') }}" alt="Logo" /></a>
            </div>
            <div class="mobIcon">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </div>
            <nav>
                <ul>
                    <ul>
                    <li class="{{ Request::is('/')?'active':''}}"><a href="{{url('/')}}">Home</a></li>
                    <li class="{{ Request::is('experts')?'active':''}}"><a href="{{url('experts')}}">Browse Experts</a></li>
                    <li class="{{ Request::is('videolibrary')?'active':''}}"><a href="{{url('videolibrary')}}">video Library</a></li>
                    <li class=""><a href="{{url('/')}}#about">About</a></li>
                    @if(Helpers::isSubscribed() == false)
                      <li class="nav-item">
                        <a class="nav-link " href="{{ url('subscription') }}">Subscribe</a>
                      </li>
                    @endif

                    @guest
                    <li><a class="login" style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;margin-right: -10%;" href="{{ url('login') }}">Login</a>
                        {{-- <a style='cursor:cursor;color:#fff;padding-right: 3%;' href="#">/</a> --}}
                        <a class="login" style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;padding-left: 0px;" href="{{ url('register') }}">/&nbsp;&nbsp;Sign Up</a></li>
                    @else
                    <li>
                         <a href="{{ redirect('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                   <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;" >
                        <input type="hidden" name="_token" value='{{csrf_token()}}' />
                         <a> <input type="submit" id="clickLogout" value="logout" /></a>
                         </form>

{{--                          <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_token() }}
                                        </form> --}}


                    </li>
                    @endguest
                </ul>
            </nav>
        </div>
    </header>
</div>
