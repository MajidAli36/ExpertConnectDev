<div class="profile-menu">
	<h2>Settings</h2>
	<ul class="myaccount-menu">
		<li class="{{ Request::is('profile')?'active':''}}"><a class="{{ Request::is('profile')?'active':''}}" href="{{url('profile') }}"><span></span>My Profile</a></li>
		<li class="{{ Request::is('update-password')?'active':''}}"><a class="{{ Request::is('update-password')?'active':''}}" href="{{url('update-password')}}"><span></span>Email and password</a></li>
		<li class="{{ Request::is('phone-verification')?'active':''}}"><a class="{{ Request::is('phone-verification')?'active':''}}" href="{{url('phone-verification')}}"><span></span>Phone verification</a></li>
		<li class="{{ Request::is('cancel-subscription')?'active':''}}"><a class="{{ Request::is('cancel-subscription')?'active':''}}"  href="{{url('cancel-subscription') }}"><span></span>Account</a></li>
		<li class="{{ Request::is('appointments')?'active':''}}"><a class="{{ Request::is('appointments')?'active':''}}"  href="{{url('appointments') }}"><span></span>Appointment</a></li>
	</ul>
	<ul class="myaccount-menu myaccount-menu-mob">
		<li class="{{ Request::is('profile')?'active':''}}"><a class="{{ Request::is('profile')?'active':''}}"  data-href="{{url('profile') }}"><span></span>My Profile</a></li>
		<li class="{{ Request::is('update-password')?'active':''}}"><a class="{{ Request::is('update-password')?'active':''}}"  data-href="{{url('update-password')}}"><span></span>Email and password</a></li>
		<li class="{{ Request::is('phone-verification')?'active':''}}"><a class="{{ Request::is('phone-verification')?'active':''}}"  data-href="{{url('phone-verification')}}"><span></span>Phone verification</a></li>
		<li class="{{ Request::is('cancel-subscription')?'active':''}}"><a class="{{ Request::is('cancel-subscription')?'active':''}}"  data-href="{{url('cancel-subscription') }}"><span></span>Account</a></li>
		<li class="{{ Request::is('appointments')?'active':''}}"><a class="{{ Request::is('appointments')?'active':''}}"  data-href="{{url('appointments') }}"><span></span>Appointment</a></li>
	</ul>
	<a href="javascript:void(0)" class="view-btn EditButton">Edit Pofile</a>
</div>