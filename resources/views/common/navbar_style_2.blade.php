<section class="nav_section nav_section2">
    <div class="container">
      <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="{{ url('/') }}"><img src="{{url('homepage/images/logo.png')}}" alt="#"></a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <div id="nav-icon1" class="navbar-toggler-icon">
          <span></span>
          <span></span>
          <span></span>
        </div>
        </button>
        <div class="search_box">
          <a href="#" class="nav-search" data-toggle="modal" data-target="#myModal"><img src="{{url('homepage/images/search_icon.png')}}" alt="#"></a>
          <input type="text" autofocus="" name="search">
        </div>

        <!-- Navbar links -->
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
                <a class="nav-link" href="{{ url('experts') }}">Experts</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('videolibrary') }}">video library</a>
              </li>
              @if(Helpers::isSubscribed() == false)
                <li class="nav-item">
                  <a class="nav-link " href="{{ url('subscription') }}">Subscribe</a>
                </li>
              @endif
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/') }}#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/') }}#contact">contact</a>
            </li>
            <li class="nav-item">
              <div class="dropdown">
                @if(Helpers::validateSession(false) == true)
                  <button type="button" class="btn btn-primary dropdown-toggle nav-link" data-toggle="dropdown">
                    {{ Helpers::getUserProfile()->data->user_details->name }}
                    {{ Helpers::getUserProfile()->data->user_details->lastname}}
                  </button>
                @else
                  <a href="{{ url('login') }}">
                    <button type="button" class="btn btn-primary nav-link">
                      login / sign up
                    </button>
                  </a>
                @endif
                @if(Helpers::validateSession(false) == true)
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ url('profile') }}">My Account</a>
                    <a class="dropdown-item" href="{{ url('update-password') }}">Change Password</a>
                    <a class="dropdown-item" href="{{ url('logout') }}">Logout</a>
                  </div>
                @endif
          </div>
            </li>
            <!-- <li class="nav-item search_mob">
              <a class="nav-link nav-search" data-toggle="modal" data-target="#myModal"><img src="{{url('homepage/images/search_icon.png')}}" alt="#"></a>
            </li> -->
          </ul>
        </div>
      </nav>
    </div>
  </section>
