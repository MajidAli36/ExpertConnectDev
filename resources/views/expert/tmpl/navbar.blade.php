@if(isset($expert_profile))
    <?php $profile_details = $expert_profile->profile_details;?>
    @if(!empty($profile_details))
      <section class="nav_section nav_section2">
      <div class="container">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
          <!-- Brand -->
          <a class="navbar-brand" href=""><img src="/homepage/images/logo.png" alt="#"></a>

          <!-- Toggler/collapsibe Button -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <div id="nav-icon1" class="navbar-toggler-icon">
            <span></span>
            <span></span>
            <span></span>
          </div>
          </button>
          <div class="search_box">
            <a href="#" class="nav-search" data-toggle="modal" data-target="#myModal"><img src="/homepage/images/search_icon.png" alt="#"></a>
            <input type="text" autofocus="" name="search">
          </div>

          <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item  {{ Request::is('subscription')?'active':''}}">
          <a class="nav-link " href="/subscription">Reschedule Appointment</a>
        </li>
        <li class="nav-item {{ Request::is('dashboard')?'active':''}}">
          <a class="nav-link " href="{{url('/manage-calendar')}}">Manage Calender</a>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle nav-link" data-toggle="dropdown">
              {{$profile_details->name}}
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="/expert/profile">My Account</a>
              <a class="dropdown-item" href="/expert/update-password">Change Password</a>
              <a class="dropdown-item" href="/logout">Logout</a>
            </div>
          </div>
        </li>
      </ul>
          </div>
        </nav>
      </div>
    </section>
    @endif
@endif
