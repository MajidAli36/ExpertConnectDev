@extends('user.userProfileLayout')
@section('userProfileContent')
<div class="wrapper">
	<div class="content">
		<div class="inner email-and-password">
			<div class="profile-data">
				@include('user.userProfileMenu')
				<div class="profile-content content-view">
					<h3>Manage Subscription</h3>
					<p>to update or cancel subscription. Please contact us using help option available on your screen.</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection