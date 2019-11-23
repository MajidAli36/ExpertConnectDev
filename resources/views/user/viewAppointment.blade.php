@extends('user.userProfileLayout')
@section('userProfileContent')
<link href="{{ asset('css/custom-tab.css') }}" rel="stylesheet" type="text/css" >
<style>
	    .convers-video{border: 3px solid #BDC92B;}
</style>
<link href="{{ asset('css/manage-appointment.css') }}" rel="stylesheet" type="text/css" >


<div class="wrapper ">
	<div class="content">
		<div class="inner profile-edit">
			<div class="profile-data">
				@include('user.userProfileMenu')
				<div class="profile-content content-view profileWrap">
									<section class="booking_section">
										<div class="container">
											<div class="row">
												<div class="col-12">
													<div id="manage-appointment">

															<ul class="tab-list">
															<li>Upcoming Appointments</li>
															<li>Previous Appointments</li>
															</ul>

															<div class="tabs-container">

															<div>
																@if(isset($appointments->data->upcoming_appointments) && count($appointments->data->upcoming_appointments)>0)
																	<!---::START:: -->
																	@foreach($appointments->data->upcoming_appointments as $upcoming_appointments)
																	<div class="item">
																		<div class="left">
																			<div class="img">
																				<img src="{{ !empty($upcoming_appointments->image) &&$upcoming_appointments->image != 'null'?url($upcoming_appointments->image):url('/img/profile.jpg') }}" alt="">
																			</div>
																			<div class="text-cont">
																				<h3 class="name">
																						@if(isset($upcoming_appointments->name))
																							{{$upcoming_appointments->name}}
																						@endif


																					</h3>
																				<?php
																					$date = new DateTime($upcoming_appointments->date);
																				?>
																				<span class="date">{{ $date->format('F d, Y')}}</span>
																				<span class="time">{{$upcoming_appointments->time}}</span>
																			</div>
																		</div>
																		<div class="right">
																			<a class="btn view-detail" href="javascript:void(0)" appointmentId = "{{$upcoming_appointments->appointment_id}}" ><span>View Detail</span></a>
																			<a class="btn hidebutton" style="display:none;" href="javascript:void(0)"><span>Hide</span></a>
																			<!-- <button class="btn cancel"><span>Cancel</span></button> -->
																		</div>
																		<div class="drop-data">
																			<div class="details">
																				<h3>Conversation</h3>


																				<div class="conrs-box user-section conrs-right">
																					<div class="convers-text"></div>
																					<div class="profile-img">
																						<img src="{{ !empty($userProfile->user_details->profile_picture_url) && $userProfile->user_details->profile_picture_url != 'null'?url($userProfile->user_details->profile_picture_url):url('/img/profile.jpg') }}" alt="">
																					</div>
																					<div class="convers-img videobox"style="display:none;">
																						<div class="convers-video  video_box">
																							<img src="{{asset('img/videobox.jpg')}}" alt="">
																							<div class="video-btn"></div>
																						</div>
																					</div>
																				</div>

																				<div class="conrs-box expert-section conrs-left" style="display:none">

																				<div class="profile-img">
																					<img src="{{ !empty($upcoming_appointments->image) && $upcoming_appointments->image != 'null'?url($upcoming_appointments->image):url('/img/profile.jpg') }}" alt="">
																				</div>
																				<div class="convers-text"></div>
																				<div class="convers-img videobox"style="display:none;">
																						<div class="convers-video video_box">
																							<img src="{{asset('img/videobox.jpg')}}" alt="">
																							<div class="video-btn"></div>
																						</div>
																					</div>
																			</div>

																			</div>
																			<div class="formUploadError error" style="display:none;"></div>
																			<div class="Innerloader">
																				<img style="width: 100px;margin: 10px auto;display: inherit;" src="{{ asset('img/loader.gif')}}">
																			</div>



																		</div>
																	</div>
																	<!---::END::- -->
																	@endforeach
																@else
																<div class="item">
																	<p>No Data to Display.</p>
																</div>
																@endif


																	</div>
															<!--- Separation  -->

															<!---::START:: -->
																	<div>
																	@if(isset($appointments->data->previous_appointments) && count($appointments->data->previous_appointments)>0)
																	@foreach($appointments->data->previous_appointments as $previous_appointments)
																	<div class="item">

																		<div class="left">
																			<div class="img">
																				<img src="{{ !empty($previous_appointments->image) && $previous_appointments->image != 'null'?url($previous_appointments->image):url('/img/profile.jpg') }}" alt="">
																			</div>
																			<div class="text-cont">
																				<h3 class="name">
																					@if(isset($previous_appointments->name))
																						{{$previous_appointments->name}}
																					@endif
																				</h3>

																				<?php
																					$date = new DateTime($previous_appointments->date);
																				?>
																				<span class="date">{{ $date->format('F d, Y')}}</span>
																				<span class="time">{{$previous_appointments->time}}</span>
																			</div>
																		</div>

																		<div class="right">
																			<!-- <button class="btn cancel"><span>Remove</span></button> -->
																			<a class="btn view-detail" href="javascript:void(0)" appointmentId = "{{$previous_appointments->appointment_id}}" ><span>View Detail</span></a>
																			<a class="btn hidebutton" style="display:none;" href="javascript:void(0)"><span>Hide</span></a>
																		</div>

																		<div class="drop-data">
																			<div class="details">
																				<h3>Conversation</h3>

																				<div class="conrs-box user-section conrs-right">
																					<div class="convers-text"></div>
																					<div class="profile-img">
																						<img src="{{ !empty($userProfile->user_details->profile_picture_url) && $userProfile->user_details->profile_picture_url != 'null'?url($userProfile->user_details->profile_picture_url):url('/img/profile.jpg') }}" alt="">
																					</div>
																					<div class="convers-img videobox"style="display:none;">
																						<div class="convers-video">
																							<img src="{{asset('img/videobox.jpg')}}" alt="">
																							<div class="video-btn"></div>
																						</div>
																					</div>
																				</div>

																				<div class="conrs-box expert-section conrs-left" style="display:none">
																				<div class="profile-img">
																					<img src="{{ !empty($upcoming_appointments->image) && $upcoming_appointments->image != 'null'?url($upcoming_appointments->image):url('/img/profile.jpg') }}" alt="">
																				</div>
																				<div class="convers-text"></div>

																				<div class="convers-img videobox"style="display:none;">
																						<div class="convers-video">
																							<img src="{{asset('img/videobox.jpg')}}" alt="">
																							<div class="video-btn"></div>
																						</div>
																					</div>
																			</div>
																			</div>
																			<div class="Innerloader">
																				<img style="width: 100px;margin: 10px auto;display: inherit;" src="{{ asset('img/loader.gif')}}">
																			</div>

																		</div>
																	<!---::END::- -->
																	</div>
																	@endforeach
																@else
																<div class="item">
																	<p>Nothing to Display.</p>
																</div>
																@endif
																	</div>
															<!---::END:: -->
															</div>
													</div>
												</div>
											</div>
										</div>
									</section>
									<input type="hidden" id="csrf_token" value="{{csrf_token()}}">
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="{{ asset('js/custom/common.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/custom-appointment.js') }}"></script>
<script>
  jQuery(document).ready(function($){
    $('#manage-appointment').customResponsiveTab();
	$(document).on('submit','#reply_form',function(e){
		e.preventDefault();
		var formData = new FormData(this);
		startAjax('POST',"{{url('/expertreply')}}",formData,function(){
			$('#reply_form').trigger('reset');
		});
	});
  });
</script>

@endsection
