<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{ url('homepage/fonts/font-awesome.min.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ url('homepage/css/slick.css')}}"/>
	<link rel="stylesheet" type="text/css" href="{{ url('homepage/css/slick-theme.css')}}"/>
	<!-- <link rel="stylesheet" type="text/css" href="{{ url('homepage/css/datepicker.css')}}"> -->
	<link rel="stylesheet" type="text/css" href="{{ url('homepage/css/bootstrap-datepicker.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ url('homepage/css/style.css')}}">
    <link rel="icon" href="{{ url('/img/favicon.ico') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ url('/img/favicon.png') }}" type="image/png" />
    <!-- Start of expertconnect Zendesk Widget script -->
    <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=9bf94185-1aa3-4b3c-b514-2f1686f4df39"> </script>
    <!-- End of expertconnect Zendesk Widget script -->	
	<title>Expert Connect</title>
<!-- Google Tag Manager --> <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-T6MQWFH');</script> <!-- End Google Tag Manager --></head>
<body class="video-call">
	@include('common.navbar_style_1')
	<header class="header" style="background-image:url({{ url(isset($curentRequest['expertProfile']->data->profile_details->image)?$curentRequest['expertProfile']->data->profile_details->image:'') }});">
		<div class="container">
			<div class="row">
				<div class="col-12">
				<h2>Book a video call with {{ $curentRequest['expertProfile']->data->profile_details->name }}</h2>
					@if(isset($curentRequest['expertProfile']->data->profile_details))
						<p><b>${{ number_format($curentRequest['expertProfile']->data->profile_details->price,2) }} </b> for 10 min</p>
					@endif
				</div>
			</div>
		</div>
	</header>
	<section class="booking_section">
		<div class="container">
			<div class="row">
				<div class="col-12">
				
					<h4>{{ $curentRequest['userProfile']->data->user_details->name }},</h4>
					<p>You are just a two steps away from connecting with your favourite expert.</p>
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
					<ul class="step list-inline">
						<li class="list-inline-item active">
							<a href="#">
								<span><img src="{{ url('homepage/images/ball_icon.png') }}" alt="#"></span><br>
								FIll in the details
							</a>
						</li>
						<li class="list-inline-item">
							<a href="#">
								<span><img src="{{ url('homepage/images/ball_icon.png') }}" alt="#"></span><br>
								ADD card
							</a>
						</li>
						<li class="list-inline-item">
							<a href="#">
								<span><img src="{{ url('homepage/images/ball_icon.png') }}" alt="#"></span><br>
								review & PAy
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<form method="POST" action="{{ url('add-payment-details/'.$expert_id) }}" enctype='multipart/form-data' autocomplete="off">
					<div class="row">
						<div class="col-12 col-sm-6">

							<!-- <div class="input_form">
								<label>select date</label>
								<img src="{{ url('homepage/images/calendar_icon.png') }}" alt="#" class="calendar">
								<textarea name="appointmentDate" data-toggle="datepicker" placeholder="MM-DD-YYYY" class="date datePickerDiv" required></textarea>
								<div data-toggle="datepicker"></div>
							</div> -->

							<div class="input_form">
								<label>select date</label>
								<img src="{{ url('homepage/images/calendar_icon.png') }}" alt="#" class="calendar">
								<input type="text" name="appointmentDate" data-provide="datepicker" class="form-control" id="js-date" style="border-radius: 0;">
            				</div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="input_form">
								<label>Select Time</label>
								<div class="dropdown timeAvailablity">
								  <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<input type="text" class="time1" name="time1" value="" required> <img src="{{ url('homepage/images/clock_icon.png')}}" alt="#" class="clock"> 
										<input type="hidden" name="timeID" value="" >
           
								  </button>
								  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								  		<a class="dropdown-item title" href="#">Available Time Slots</a>
								  		<div class="timeAvailablityWrap">
											<!-- DATA WILL LOAD HERE THREW JS-->
											<a class="dropdown-item"><span class="time2">No Slot Available</span></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="input_form">
								<label>post your question <br><span>(You can ask multiple questions)</span></label>
								<textarea name="question" placeholder="Describe your question here..."></textarea>
							</div>
						</div>
						<div class="col-12 col-sm-8">
							<div class="input_form">
								<label>Record your message or question for review<br> <span>You can record a 2-4 minute video  (Optional)</span></label>
							</div>
						</div>

						<div class="col-12 col-sm-4">

							<div class="input_form uploader selectVideoWrap">
									<label class="upload button">
								  	<input  type="file" name="videURLS" id="myFile" multiple size="50" />
								    UPLOAD FILE
								  </label>
							</div>

							<div class="input_form uploaded showVideoWrap">
									<div class="upload_video">
										<p><img src="{{ url('homepage/images/play_iconsm.png')}}" alt="#" class="play"></p> 
										<p class="upload_file" id="demo">play_iconsm.png<br></p>
										<a class="resetImage"><img src="{{ url('homepage/images/check_icon.png')}}" alt="#" class="close"></a>
									</div>
							</div>

						</div>

							<input type="hidden" value= "<?php echo csrf_token() ?>" name="_token">
              <input type="hidden" name="_method" value="post">
							<div class="col-12 text-center">
								<a href="javascript:void(0)"><button class="btn_submit btn_yellow" type="submit"><span>Next</span></button></a>
							</div>
					</div>
				</form>
			</div>
		</div>
	</section>

	@include('common.footer_style_1')

<script src="{{ asset('js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/custom/common.js')}}" type="text/javascript"></script>
<script>

		// hide upload button and show image or video
		$(document).on('change','.selectVideoWrap #myFile',function(){
			if($(this).get(0).files.length > 0){
				$(this).parents('.input_form').hide();
				$('.showVideoWrap').show();
			}
		})
	//reset image
		$(document).on('click','.showVideoWrap .resetImage',function(){
				$('.selectVideoWrap').show();
				$('.showVideoWrap').hide();
				$('.selectVideoWrap #myFile').val("");
		});

	//set slot whatever selected
		$(document).on('click','.timeSlot',function(){
			$('input[name="time1"]').val($(this).find('.time2').html());
			$('input[name="timeID"]').val($(this).attr('slotid'));
		})

	// $(document).on('change','.datePickerDiv',function(){
	// 	// var url = "localhost:8080/ExpertConnect/v2/GetExpertUnAvialabilityV2?expert_id=1&user_id=1&date=2018-07-01";
	// 	var url = "/getExpertAvailablity";
	// 	var method = "POST";
	// 	var data = {
	// 			expert_id:"{{ $expert_id }}",
	// 			date:$(this).val(),
	// 			_token : '<?php echo csrf_token() ?>'};
		
	// 	var slotsText = 	'<a class="dropdown-item">';
	// 		slotsText += 	'<span class="time2">Please Wait..</span>';
	// 		slotsText += 	'</a>';
	// 	$('.timeAvailablity .timeAvailablityWrap').html(slotsText);
	// 	startAjax(method,url,data,function(data){
	// 		fetchSchedule(data,'.upperAddress');
	// 	});
	// })

	$(document).on('change','#js-date',function(){
		// var url = "localhost:8080/ExpertConnect/v2/GetExpertUnAvialabilityV2?expert_id=1&user_id=1&date=2018-07-01";
		var c_date = $(this).val();
		c_date = c_date.split("/").join("-");
		var url = "/getExpertAvailablity";
		var method = "POST";
		var data = {
				expert_id:"{{ $expert_id }}",
				date:c_date,
				_token : '<?php echo csrf_token() ?>'};
	    
		var slotsText = 	'<a class="dropdown-item">';
			slotsText += 	'<span class="time2">Please Wait..</span>';
			slotsText += 	'</a>';
		$('.timeAvailablity .timeAvailablityWrap').html(slotsText);
		startAjax(method,url,data,function(data){
			fetchSchedule(data,'.upperAddress');
		});
	})

		
	function fetchSchedule(response){
			$('.time1').val('');
			if(response){
					if(response.success){
						var data = response.data;
							data = data.timeAvailable;
						if(data){
							var slotsText = "";
							var display_slot = "";
							var display = 0;
							var countet = 0
							$('.timeAvailablity .timeAvailablityWrap').html(slotsText);
							data.forEach(function(value,key){
								if(value.type == 0){
									display_slot = value.display_value;
									display = 0;
								}else{
									countet++;
									var row = '	<a class="dropdown-item timeSlot" slotid="'+ value.id +'">';
							if(display == 0){row += '<span class="divider">'+ display_slot +' </span>';}
											 row += '<span class="time2">'+ value.display_value +' </span>\
												   <img src="{{ url('homepage/images/check_icon.png')}}" alt="{{ url('homepage/images/check_icon.png')}}">\
												</a>';
									slotsText += row;
									display = 1;
								}
								
							});
							if(countet == 0){
								slotsText = 	'<a class="dropdown-item">';
								slotsText += 	'<span class="time2">No Slot Available</span>';
								slotsText += 	'</a>';
							}
							$('.timeAvailablity .timeAvailablityWrap').html(slotsText);
						}else{
							var slotsText = '<a class="dropdown-item "><span class="time2"> No Slot Available </span>';
							$('.timeAvailablity .timeAvailablityWrap').html(slotsText);
						}
					}else{
						showMessage('ERROR',response.message);
					}
			}
	}
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{url('homepage/js/slick.min.js')}}"></script>
<!-- <script src="{{url('homepage/js/datepicker.js')}}"></script> -->
<script src="{{url('homepage/js/bootstrap-datepicker.js')}}"></script>

<script type="text/javascript">
	$('[data-toggle="datepicker"]').datepicker({
		format: 'mm-dd-yyyy'
	})
	// $(document).ready(function() {
   	// 	 $('#js-date').datepicker();
	// });

</script>


<script type="text/javascript">
	$('.booking_section .dropdown .dropdown-menu a').removeAttr('href');
</script>
<script src="{{url('homepage/js/video-call-fill.js')}}"></script>
</body>
</html>