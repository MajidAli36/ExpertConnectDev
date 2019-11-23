@extends('expert.tmpl.layout')
@push('styles')
	<link rel="stylesheet" href="css/dashboard.css" type="text/css" />
@endpush

@section('content')
	@include('expert.sections.expert_header')
	<?php $profile_details = $expert_profile->profile_details;?>
	@include('expert.sections.appointment_section')
@endsection


@push('scripts')
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
@endpush