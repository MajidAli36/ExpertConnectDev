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
												<img src="{{ !empty($upcoming_appointments->profile_picture_url) &&$upcoming_appointments->profile_picture_url != 'null'?url($upcoming_appointments->profile_picture_url):url('/img/profile.jpg') }}" alt="">
											</div>
											<div class="text-cont">
												<h3 class="name">
													@if(isset($upcoming_appointments->name))
														{{$upcoming_appointments->name}} 
													@endif

													@if(isset($upcoming_appointments->lastname))
														{{$upcoming_appointments->lastname}}
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
											<a href="{{ url('callExpert/'.$upcoming_appointments->email) }}" class="btn_yellow"target="_blank"><span>Call</span></a>
											
											<a class="btn view-detail" href="javascript:void(0)" appointmentId = "{{$upcoming_appointments->appointment_id}}" ><span>View Detail</span></a>
											<a class="btn hidebutton" style="display:none;" href="javascript:void(0)"><span>Hide</span></a>
											<!-- <button class="btn cancel"><span>Cancel</span></button> -->
										</div>
										<div class="drop-data">
											<div class="details">
												<h3>Conversation</h3>
												<div class="conrs-box user-section conrs-left">
													<div class="profile-img">
														<img src="{{ !empty($upcoming_appointments->profile_picture_url) && $upcoming_appointments->profile_picture_url != 'null'?url($upcoming_appointments->profile_picture_url):url('/img/profile.jpg') }}" alt="">
													</div>
													<div class="convers-text"></div>
													<div class="convers-img videobox"style="display:none;">
														<div class="convers-video">
															<img src="{{asset('img/videobox.jpg')}}" alt="">
															<div class="video-btn"></div>
														</div>
													</div>
                                                    <?php 
                                                    if(!isset($force_remove_reply)){$force_remove_reply = false;}
                                                    if($force_remove_reply == true):?>
                                                        <div class="action-btn">
                                                            <button class="btn reply-btn">Reply</button>
                                                        </div>
                                                    <?php endif;?>


													<div class="text-field">
														<form name="reply_form" id="reply_form" method="POST" action="#" >
															<textarea class="reply_message" name="expert_reply" id="expert_reply" cols="10" rows="5"></textarea>
															<div class="file-upload">
																<input type="file" name="expert_video">
																<input type="hidden" name="appointment_id" value="{{$upcoming_appointments->appointment_id}}">
																<input type="hidden" value= "<?php echo csrf_token() ?>" name="_token">
              													<input type="hidden" name="_method" value="post">
																<button class="btn expertreplybtn" >Submit</button>
															</div>
														</form>
													</div>
												</div>
												<div class="conrs-box expert-section conrs-right" style="display:none">
												<div class="convers-text"></div>
												<div class="profile-img">
													<img src="{{ (!empty($profile_details->web_image))?$profile_details->web_image:url('/img/profile.jpg') }}" alt="">
												</div>
												<div class="convers-img videobox"style="display:none;">
														<div class="convers-video">
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
												<img src="{{ !empty($previous_appointments->profile_picture_url) && $previous_appointments->profile_picture_url != 'null'?url($previous_appointments->profile_picture_url):url('/img/profile.jpg') }}" alt="">
											</div>
											<div class="text-cont">
												<h3 class="name">{{$previous_appointments->name}} {{$previous_appointments->lastname}}</h3>
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
												<div class="conrs-box user-section conrs-left">
													<div class="profile-img">
														<img src="{{ !empty($previous_appointments->profile_picture_url) && $previous_appointments->profile_picture_url != 'null'?url($previous_appointments->profile_picture_url):url('/img/profile.jpg') }}" alt="">
													</div>
													<div class="convers-text"></div>
													<div class="convers-img videobox"style="display:none;">
														<div class="convers-video">
															<img src="{{asset('img/videobox.jpg')}}" alt="">
															<div class="video-btn"></div>
														</div>
													</div>

												</div>
												<div class="conrs-box expert-section conrs-right" style="display:none">
												<div class="convers-text"></div>
												<div class="profile-img">
													<img src="{{ (!empty($profile_details->web_image))?$profile_details->web_image:url('/img/profile.jpg') }}" alt="">
												</div>
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