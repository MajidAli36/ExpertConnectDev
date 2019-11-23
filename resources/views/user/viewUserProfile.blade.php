@extends('user.userProfileLayout')
@section('userProfileContent')

<!-- <?php //exit(json_encode($states));?> -->
<div class="wrapper ">
	<div class="content">
		<div class="inner profile-edit">
			<div class="profile-data">
				
				@include('user.userProfileMenu')

				@if (isset($userProfile->user_details))
				<div class="profile-content content-view profileWrap">
					<h3>My Profile</h3>
					<div class="profile-info">
							<div class="profile-img">
								@if(!empty($userProfile->user_details->profile_picture_url))
									<img src="<?php echo $userProfile->user_details->profile_picture_url;?>" alt="">
								@else
									<img src= "img/profile.jpg">
								@endif
							</div>
						<div class="profile-name">
						
							<strong class="userName">
								{{isset($userProfile->user_details->name)?$userProfile->user_details->name." ".$userProfile->user_details->lastname:''}}
							</strong>
						
							<span class="userPartialAddress"> 
								@if (isset($userProfile->user_details->state) && isset($userProfile->user_details->country))
									{{ $userProfile->user_details->state->name ." , ". $userProfile->user_details->country->name }}
								@endif
							</span>
						</div>
					</div>
					<div class="fields gender" <?php if (empty($userProfile->user_details->gender))echo "style='display:none;'" ?> >
						<div class="<?php echo strtolower($userProfile->user_details->gender)?>" >
							<!-- For change class to female -->
							<label>Gender</label>
							<span class="userGender">
									{{ isset($userProfile->user_details->gender)?$userProfile->user_details->gender:''}}
							</span>
						</div>
					</div>
					
					<div class="fields" <?php if (empty($userProfile->user_details->about))echo "style='display:none;'" ?>>
						<label>About me</label>
						<p class="aboutMe">{{isset($userProfile->user_details->about)?$userProfile->user_details->about:''}}</p>
					</div>
					<h4>Private details <span>Only visible for you</span></h4>
					
					<div class="fields" <?php if (empty($userProfile->user_details->address))echo "style='display:none;'" ?> >
						<label>Full location</label>
						<p class="fillAddress">
							@if(!empty($userProfile->user_details->address))
								{{$userProfile->user_details->address}}, {{$userProfile->user_details->city->name}}, {{$userProfile->user_details->state->name}}, {{$userProfile->user_details->country->name}} 
							@endif
						</p>
					</div>
					
					
					<div class="fields" <?php if (empty($userProfile->user_details->dob))echo "style='display:none;'" ?>>
						<label>Birthday</label>
						<p class="dateOfBirth">
						@if (!empty($userProfile->user_details->dob))
							<?php $date_of_birth=date_create($userProfile->user_details->dob);?>
							<?php echo date_format($date_of_birth,"F d, Y");?>
						@endif
						</p>
					</div>
					
					<!-- <button class="">Save</button> -->
				</div>
				
						<div class="profile-content content-view editProfileWrap" style="display:none">

						<h3>My Profile</h3>

						<div class="alert showErrorMessage" style="display:none;">
							<strong>Success!</strong> Indicates a successful or positive action.
						</div>

						<div class="profile-info">
							<div class="profile-img">
								@if(!empty($userProfile->user_details->profile_picture_url))
									<img src="<?php echo $userProfile->user_details->profile_picture_url;?>" alt="">
								@else
									<img src="img/profile.jpg">
								@endif
								<input style="display:none;" type="file" name="profile_avatar" id="profile_avatar" accept="image/gif, image/jpeg, image/png">
							</div>
							<div class="profile-name">
								<strong class="userName">
									@if (isset($userProfile->user_details->name))
										<?php echo $userProfile->user_details->name . " ". $userProfile->user_details->lastname;?>
									@endif</strong>
								<span class="userPartialAddress">
                                                                    {{ isset($userProfile->user_details->address)?$userProfile->user_details->address:''}}
									
								</span>
							</div>
							<button class="change-profile-img" onClick="$('#profile_avatar').trigger('click');">Change Profile</button>
						</div>
						<div class="fields">
							<label>First Name</label>
							<input type="text" id="name" value="{{isset($userProfile->user_details->name)?$userProfile->user_details->name:''}}" name="userName" placeholder="John Smith">
						</div>

						<div class="fields">
							<label>Last Name</label>
							<input type="text" id="lastname" value="{{isset($userProfile->user_details->lastname)?$userProfile->user_details->lastname:''}}"  name="userName" placeholder="John Smith">
						</div>

						<div class="fields fields-edit gender">
						<label>Gender</label>
						<div class="female">
							<input id="gender" <?php if(strtolower($userProfile->user_details->gender) == "female")echo 'checked';?> type="radio" name="userGender" value="Female">
							<label for="gender-female"><span class="checkmark"></span>Female</label>
						</div>
						<div class="male">
							<input id="gender" type="radio" <?php if(strtolower($userProfile->user_details->gender) == "male")echo 'checked';?> name="userGender" value="Male">
							<label for="gender-male"><span class="checkmark"></span>Male</label>
						</div>
						</div>
						<div class="fields">
						<label>About me</label>
						<textarea name="aboutMe" id="about" cols="30" rows="10">{{isset($userProfile->user_details->about)?$userProfile->user_details->about:''}}</textarea>
						</div>
						<h4>Private details <span>Only visible for you</span></h4>
						
						<div class="fields">
							<label>Street</label>
							<input type="text" id="address"  value="{{isset($userProfile->user_details->address)?$userProfile->user_details->address:''}}"  placeholder="" name="street">
						</div>

						<div class="fields">
							<label>Country</label>
							<div class="fields-item country">
								<div class="select-box">
									<select name="country" id="country"  >
										<option disabled selected>Please Select a Country</option>
											<?php foreach($country as $country_det){?>
												<option <?php if(isset($userProfile->user_details->country) && $country_det->id == $userProfile->user_details->country->id){echo "selected";}?> value="<?php echo $country_det->id?>"><?php echo $country_det->name;?></option>
											<?php }?>
									</select>
								</div>
							</div>
						</div>
						
						<div class="fields" <?php if(count($states)==0){echo 'style="display:none;"';} ?>>
							<label>State</label>
							<div class="fields-item state">
								<div class="select-box">
									<select name="state" id="state"  >
										<?php
											foreach($states as $state){?>
												<option value="{{ $state->id}}" <?php ($state->id == $userProfile->user_details->state->id)?"selected":'' ?> >{{$state->name}}</option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
						
						<div class="fields" <?php if(count($cities) == 0){echo 'style="display:none;"';} ?> >
							<label>City</label>
							<div class="fields-item city">
								<div class="select-box">
									<select name="city" id="city"  >
									<?php foreach($cities as $city){?>
												<option value="{{ $city->id}}" <?php ($city->id == $userProfile->user_details->city->id)?"selected":'' ?> >{{$city->name}}</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<!-- <div class="fields-item zipcode">
								<input type="text" placeholder="33139" <?php if(!empty($userProfile->user_details->zipcode))echo 'value="'.$userProfile->user_details->sipcode.'"';?> name="zipCode">
							</div> -->
						</div>


						<div class="fields birthday">
						<label>Birthday</label>
						<?php
							$date_of_birth=date_create($userProfile->user_details->dob);
							$b_date = date_format($date_of_birth,"d");
							$b_month = date_format($date_of_birth,"m");
							$b_year = date_format($date_of_birth,"Y");
						?>
						<div class="fields-item year">
							<div class="select-box">
							<?php
								$from_year = 1980;
								$curr_year = date("Y");
							?>
								<select id="birthdayYear" name="birthdayYear">
									<option disabled selected>YY</option>
									<?php while($from_year <= $curr_year){?>
										<option <?php if($from_year == $b_year)echo "selected";?> value="<?php echo $from_year;?>"><?php echo $from_year;?></option>
									<?php 
										$from_year++ ;
									}?>
								</select>
							</div>
						</div>
						<div class="fields-item month">
							<div class="select-box">
								<select id="birthdayMonth" name="birthdayMonth">
									<option disabled selected>MM</option>
									<?php $month_names = array("January","February","March","April","May","June","July","August","September","October","November","December");?>
									<?php foreach($month_names as $key => $month){?>
										<option <?php if($key + 1 == $b_month)echo "selected";?> value="<?php echo $key+1;?>"><?php echo $month;?></option>
									`<?php }?>
								</select>
							</div>
						</div>
						<div class="fields-item day">
							<div class="select-box">
								<select id="birthdayDate" name="birthdayDate">
									<option disabled selected>DD</option>
									<?php for($date = 1;$date<=31;$date++){?>
										<option <?php if($date == $b_date)echo "selected";?> value="<?php echo $date;?>"><?php echo $date;?></option>
									`<?php }?>
								</select>
							</div>
						</div>
						</div>
						<button class="saveButton">Save</button>
						<button class="backButton">Cancel</button>
				 </div>
			</div>
			@endif
		</div>
	</div>
</div>





<script src="{{ asset('js/custom/edit-profile.js')}}" type="text/javascript"></script>
<script>
	    $(document).on('change','#country',function(){
			var method = "POST";
			var url = "get-state";
			var data = {country_id:$('#country').val(),_token : '<?php echo csrf_token() ?>'};
			startAjax(method,url,data,handelStateResponse);
		});

		$(document).on('change','#state',function(){
			var method = "POST";
			var url = "get-city";
			var data = {state_id:$('#state').val(),_token : '<?php echo csrf_token() ?>'};
			startAjax(method,url,data,handelCityResponse);
		});

		$(document).on('click','.saveButton',function(){
			var method = "POST";
			var url = "update-profile";
			var formData = new FormData();

			var data = {};
			var fieldsArray = ['name','lastname','about','country','state','city','address'];
			var bitrhday = $('#birthdayYear').val() +"-"+ $('#birthdayMonth').val() +"-"+ $('#birthdayDate').val();
			
			
			formData.append("dob",bitrhday);
			
			fieldsArray.forEach(function(value){
				if($('#'+value).val() != ""){
					data[value] = $('#'+value).val();
					formData.append(value, $('#'+value).val());
				}
			})

			formData.append("gender",$("input[name='userGender']:checked"). val());
			data.gender = $("input[name='userGender']:checked"). val();

			if($('#profile_avatar').val() != "")
				formData.append('image', $('#profile_avatar')[0].files[0]);
			formData.append('_token','<?php echo csrf_token() ?>');

			startAjaxFileUpload(url,formData,function(resp){
				var month = $('#birthdayMonth').val();
				data.dob = $('#birthdayMonth option[value="'+month+'"]').html()+", "+$('#birthdayDate').val()+" "+$('#birthdayYear').val();
				handelProfileResponse(resp,data)
			});
		});

		$(document).on('click','.uploadImage',function(){
			var formData = new FormData();
			formData.append('user_avatar', $('#user_avatar')[0].files[0]);
			var data = formData;
			startAjaxFileUpload("upload-avatar", data, getAvatarUploadResponse);
		})
</script>
@endsection
