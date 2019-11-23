jQuery(document).ready(function($) {

    $(".reply-btn").click(function() {
        $(this).parent().next(".text-field").slideToggle();
    });

    $(".view-detail").click(function(e) {
        e.preventDefault();
        var thiselem = this;
        var drop_data = $(thiselem).parent().next(".drop-data");

        $(drop_data).find('.details').hide();
        $(drop_data).find('.Innerloader').show();
        $(drop_data).find(".expert-section").hide();
        if(!$(drop_data).find('.details').hasClass('haveData'))
            $(drop_data).stop(true, true).slideDown();

        try{
            var appointmentreplydata  = {
                _token:$('#csrf_token').val(),
                appointment_id : $(thiselem).attr('appointmentId')
            };
            startAjax('POST',"/appointmentDetails",appointmentreplydata,function(data){
                if(showconversation(drop_data,data)){
                    $(drop_data).find('.details').show();
                    $(drop_data).find(".expert-section").show();
                    $(drop_data).find('.Innerloader').hide();
                    $(drop_data).find('.details').addClass('haveData');
                    $(thiselem).parent().find('.view-detail span').html('Refresh');
                    $(thiselem).parent().find('.hidebutton').show();
                }else{
                    $(drop_data).stop(true, true).slideDown();
                    var messagediv = $(drop_data).parents('.drop-data').find('.formUploadError');
                    messagediv.html(data.message);
                    $(messagediv).show();
                }
            },'noLoader');
        }catch(e){
            $(drop_data).stop(true, true).slideDown();
        }

    });

    $(".celendar-switch input").click(function() {
		if($(this).is(":checked")) { 
			$(this).parents("li").addClass("active");
		} else{
			$(this).parents("li").removeClass("active");
		}
	});

});


function showconversation(element,data){
    if(data && data.success == true && data.data && data.data.appointment_details){
        $(element).find('.convers-text').html(data.data.appointment_details.question);
        if(data.data.appointment_details.video_user){
            $(element).find('.videobox').show();
            $(element).find('.videobox .video-btn').attr('data-src',data.data.appointment_details.video_user);
        }

        if(data.data.appointment_details.expertAnswer){
            $(element).find('.expert-section .convers-text ').html(data.data.appointment_details.expertAnswer);
            $(element).find('.expert-section').show();
            $(element).find('.action-btn').remove();
        }else{
            $(element).find('.expert-section').hide();
        }

        if(data.data.appointment_details.expertVideoAnswer){
            $(element).find('.expert-section .videobox').show();
            $(element).find('.expert-section .videobox .video-btn').attr('data-src',data.data.appointment_details.expertVideoAnswer);
        }
    }
    return data.success;
}



jQuery(document).on('click','.expertreplybtn',function(e){
    e.preventDefault();
    var form = $(this).parents('.details').find('#reply_form')[0];
    var messagediv = $(form).parents('.drop-data').find('.formUploadError');
    $(messagediv).hide();

    startMultipartAjax('POST','/appointmentReply',new FormData(form),function(data){
        $(messagediv).show();
        if(data.success){
            messagediv.removeClass('error');
            $(form).parents('.details').find('.action-btn').remove();
            $(form).remove();
            messagediv.html(data.message);
        }else{
            messagediv.html(data.message);
            messagediv.addClass('error');
        }
    });
});
jQuery('.video-btn').click(function(){
    var videoSrc = $(this).attr('data-src');
    $('body').append('<div class="slider-iframe"><iframe allowfullscreen autoplay src='+ videoSrc +'?autoplay=1 allowfullscreen></iframe><div class="video-close">X</div></div>').css('overflow', 'hidden');
});
jQuery('.hidebutton').click(function(e){
    var thiselem = this;
    var drop_data = $(thiselem).parent().next(".drop-data");
    $(drop_data).hide();
    $(drop_data).find('.details').removeClass('haveData');
    
    $(this).parent().find('.view-detail span').html('View Details');
    $(this).parent().find('.hidebutton').hide();
});

jQuery(document).on('click','.video-close',function(){
    jQuery(".slider-iframe").remove();
    $('body').css('overflow', 'auto');
});