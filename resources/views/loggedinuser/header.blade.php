<div class="top">
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
					<li class="{{ Request::is('dashboard')?'active':''}}"><a href="{{ url('dashboard') }}">Dashboard</a></li>
					<li class="{{ Request::is('experts')?'active':''}}"><a href="{{ url('experts') }}">Browse Experts</a></li>
					<li class="{{ Request::is('videolibrary')?'active':''}}"><a href="{{ url('videolibrary') }}">video Library</a></li>
					<!-- <li>
						<div class="search-box"><input type="text" placeholder="Search..."></div>
						<span class="search-icon"></span>
					</li> -->
					@if(Helpers::isSubscribed() == false)
						<li class="nav-item}">
							<a class="nav-link " href="{{ url('subscription') }}">Subscribe</a>
						</li>
					@endif

				</ul>
				<div class="my-account">
					@if(Helpers::validateSession(false) == true)
					<a href="">
						{{ Helpers::getUserProfile()->data->user_details->name }} {{ Helpers::getUserProfile()->data->user_details->lastname}}
					</a>
					<img src="{{ !empty(Helpers::getUserProfile()->data->user_details->profile_picture_url)?Helpers::getUserProfile()->data->user_details->profile_picture_url:'/img/profile.jpg' }}" alt="">
					<span class="userProfileOptions"></span>
					<ul>
						<li><a href="{{ url('profile') }}">My Account</a></li>
						<li><a href="{{ url('update-password') }}">Change Password</a></li>
						<li>
							<a href="{{ url('logout') }}">Logout</a>
						</li>
					</ul>
					@else
						<a href="{{ url('/login') }}"> Login/Register </a>
					@endif
				</div>
			</nav>
		</div>
	</header>
</div>
