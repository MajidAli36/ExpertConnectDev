<div class="top" id="home">
	<header>
		<div class="content">
			<div class="logo">
				<a href="{{url('/')}}"><img src="{{ asset('img/logo.png')}}" alt="Logo" /></a>
			</div>
			<div class="mobIcon">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</div>
			<nav>
				<ul>
					<li class="{{ Request::is('dashboard')?'active':''}}"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                    <li class="{{ Request::is('experts')?'active':''}}"><a href="{{url('experts')}}">Browse Experts</a></li>
                    <li class="{{ Request::is('videolibrary')?'active':''}}"><a href="{{url('videolibrary')}}">video Library</a></li>
                    @if (!isset($userProfile->user_details))
                    	<li><a  href="{{ url('login') }}">Login</a></li>
                    	<li><a href="{{ url('register') }}">Sign Up</a></li>
                    @endif
					<!-- <li class="menu-search">
						<span class="search-icon"></span>
						<div class="search-box"><input type="text" placeholder="Search..."></div>
					</li> -->
				</ul>
				@if (isset($userProfile->user_details))
					<div class="my-account">
						<a href="">{{isset($userProfile->user_details->name)?$userProfile->user_details->name." ".$userProfile->user_details->lastname:''}}</a>
						@if(!empty($userProfile->user_details->profile_picture_url))
							<img src="<?php echo $userProfile->user_details->profile_picture_url;?>" alt="">
						@else
							<img src= "img/profile.jpg">
						@endif
						<span></span>
						<ul>
							<li><a href="{{ url('profile') }}">My Account</a></li>
							<li><a href="{{ url('update-password') }}">Change Password</a></li>
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
							</li>
						</ul>
					</div>
				@endif
			</nav>
		</div>
	</header>
</div>