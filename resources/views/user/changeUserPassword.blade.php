@extends('user.userProfileLayout')
@section('userProfileContent')
<div class="wrapper">
	<div class="content">
		<div class="inner email-and-password">
			<div class="profile-data">
				@include('user.userProfileMenu')
				<div class="profile-content content-view">
					<h3>Email and Password</h3>
					<!-- <div class="fields">
						<label>Email</label>
						<input type="text" placeholder="Tennisplayer@gmail.com">
					</div> -->

					@if (session('success'))
                        <div class="alert alert-success" style="color: #3c763d;background-color: #dff0d8;border-color: #d6e9c6;padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;">
                            {{ session('success') }}
                    	</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" style="color: #d61b1b;background-color: #f2dede;border-color: ##ebccd1;padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;">
                            {{ session('error') }}
                    	</div>
                    @endif
					
					<form method="post" action="">
						<div class="fields">
							<label>Change password</label>
							{{ csrf_field() }}
							<input type="password" required name="password" placeholder="New Password">
						</div>
						<div class="fields">
							<label>Confirm password</label>
							<input type="password" required name="confirm_password" placeholder="Confirm New Password">
						</div>
						<div class="fields">
							<button>Change Password</button>
						</div>
						
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection