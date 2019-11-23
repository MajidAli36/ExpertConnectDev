@extends('expert.tmpl.layout')
@push('styles')
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet" type="text/css" >
	<link href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet" type="text/css" >
	<style>
			label.celendar-switch.processing	span {
				background-color: red !important;
			}
	</style>
@endpush

@section('content')
@include('expert.sections.expert_header')
<section class="manage-celendar">
		<div class="container">
			<div class="row">
				<div class="col-6">
					<div class="calendar-div">
						<div data-toggle="datepicker"></div>
					</div>
				</div>
				<div class="col-6">
					<div class="slot-div">
						<h2></h2>
						
						<div class="slot-content">	
							<?php 
							$appointmentDetails = $calender->data->appointmentDetails;
							$timeSlots = $calender->data->timeSlots;
							$timeSlotCount = count($timeSlots);
							$i = 0;
							while($i<$timeSlotCount):?>
									<div class="slot-item">
										<h3>{{$timeSlots[$i]->display_value}}</h3>
										<ul>
											<?php
											while(isset($timeSlots[++$i]) && $timeSlots[$i]->type == 1){?>
											<li>
												<span>{{ $timeSlots[$i]->display_value}}</span>
												<label class="celendar-switch">
													<input type="checkbox" slotval="{{ $timeSlots[$i]->id}}" value="{{ $timeSlots[$i]->id}}">
													<span></span>
												</label>
											</li>
											<?php }?>

										</ul>
									</div>
							<?php endwhile;?>

							</div>
						<!-- <div class="save-btn">
							<button><span>Save</span></button>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection


@push('scripts')
<script src="{{ asset('js/jquery-ui.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/custom/common.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/custom-appointment.js') }}"></script>
<script>

	var appointmentDetails = <?php echo json_encode($appointmentDetails);?>;
	var newDate = '{{ $appointmentDetails[0]->date }}';
	var setCalendarDate = '{{ $appointmentDetails[0]->date }}';
	newDate = newDate + 'T12:00:00Z';
	var todatDateObj = new Date(newDate);
	var nextForteenDateObj = '{{ $appointmentDetails[14]->date }}';
	nextForteenDateObj = nextForteenDateObj + 'T12:00:00Z';
	var FinalForteenDate = new Date(nextForteenDateObj);
	var dd = todatDateObj.getDate();
    var mm = todatDateObj.getMonth()+1; //January is 0!
    var yyyy = todatDateObj.getFullYear();

	var dd1 = FinalForteenDate.getDate();
    var mm1 = FinalForteenDate.getMonth()+1; //January is 0!
    var yyyy1 = FinalForteenDate.getFullYear();

	var selectedDateObject = todatDateObj;
	var one_day = 1000*60*60*24;
	var slots_list = [];
	
	var slot_index = 0;
	showCurrentDayAppointments();
	$('.slot-div h2').html(getString(todatDateObj));

  jQuery(document).ready(function($){
	
    $('#manage-appointment').customResponsiveTab();
    $('[data-toggle="datepicker"]').datepicker({
    	inline: true,
			dateFormat: "yy-mm-dd",
		   minDate: new Date(yyyy, mm - 1, dd),
            maxDate: new Date(yyyy1, mm1 - 1, dd1),

			onSelect: function(dateText) {
				var newDateText = dateText;
				newDateText = newDateText + 'T12:00:00Z';
				selectedDateObject = new Date(newDateText);
				$('.slot-div h2').html(getString(selectedDateObject));
				slot_index = Math.abs(Math.round((selectedDateObject - todatDateObj)/one_day));
				showCurrentDayAppointments();
		},
    });
	$('[data-toggle="datepicker"]').datepicker("setDate", setCalendarDate);

    $(".slot-content").mCustomScrollbar();
		$(document).off('click').on('click','.celendar-switch span',function(e){
			e.preventDefault();
			var selected_span = this;
			var selected_label = $(this).parent('label');
			if(!$(selected_label).hasClass('processing')){
				var selected_input = selected_label.find('input');
				var time_id = selected_input.val();
				if($(selected_input).attr('checked') == "checked"){
					var checked = false;
				}else{
					var checked = true;
				}
				$(selected_label).addClass('processing');
				postExpertAvailability(getTimeFormat(selectedDateObject),time_id,checked,function(data){
					if(data.success ==true){
						$(selected_input).attr('checked', checked);
						if(checked){
							slots_list[slot_index][time_id] = true;
						}else{
							slots_list[slot_index][time_id] = false;
						}
					}
					$(selected_label).removeClass('processing');
				});
			}
		})
  });

	function getString(date_obj){
		var week_array = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
		var month_array = ['January','February','March','April','May','June','July','August','September','October','November','December'];
		var year = date_obj.getFullYear();
		var month = month_array[date_obj.getMonth()];
		var date = date_obj.getDate();
		var week_day = week_array[date_obj.getDay()];
		return week_day+", "+ month+" "+date+", "+year;
	}
	function getTimeFormat(date_obj){
		var date 	= 	date_obj.getDate();
		var month = 	date_obj.getMonth() + 1;
		var year 	= 	date_obj.getFullYear();
		if(parseInt(month)<10){
			month = "0"+month;
		}
		if(parseInt(date)<10){
			date = "0"+date;
		}
		return year+"-"+month+"-"+date;
	}

	function showCurrentDayAppointments(data){
		$('input[slotval]').attr('checked', false);
		var appointmentDetails_curr = appointmentDetails[slot_index];
		if(!slots_list[slot_index]){
			slots_list[slot_index] = {};
			appointmentDetails_curr.slots.forEach(function(value, index){
				slots_list[slot_index][value.time_id] = true;
			})
		}
		for(val in slots_list[slot_index]){
			if(slots_list[slot_index][val]){
				$('input[slotval="'+val+'"]').attr('checked', true);
			}
		}
	}
	function postExpertAvailability(appointmentDate,time_id,is_available,callback){
		var request = {appointmentDate:appointmentDate,time_id:time_id,is_available:is_available,_token : '<?php echo csrf_token() ?>'};
		startAjax('POST',"{{url('/update-appointment')}}",request,callback)
	}

	$( ".dropdown-toggle" ).click(function() {
        if ($(".dropdown").hasClass("show")) {
  		        $(".dropdown").removeClass('show');
            	$(".dropdown-menu").removeClass('show');
	    }
        else
		{
				$(".dropdown").addClass('show');
            	$(".dropdown-menu").addClass('show');
		}

    });
</script>
@endpush