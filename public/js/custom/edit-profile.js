$(document).ready(function(){
    $(document).on('click','.EditButton',function(){
        $('.profileWrap').hide();
        $('.editProfileWrap').show();
        $('.EditButton').hide();
    });
    
    $(document).on('click','.editProfileWrap .backButton',function(){
        $('.profileWrap').show();
        $('.editProfileWrap').hide();
        $('.EditButton').show();
    });
    $(document).on('change','#profile_avatar',function(){
        readURL(this,'.editProfileWrap .profile-img img');
    })
})




function handelStateResponse(response){
    if(response){
        $('#state option').remove();
        if(response.data.state_details.length > 0){
            response.data.state_details.forEach(function(value,key){
                $('#state').append("<option value='"+value.id+"'>"+value.name+"</option>");
            })
            $('#state').trigger('change');
            $('#state').parents('.fields').show();
        }else{
            $('#state').trigger('change');
            $('#state').parents('.fields').hide();
            $('#city').parents('.fields').hide();
        }
    }
}

function handelCityResponse(response){
    if(response){
        $('#city option').remove();
        if(response.data.city_details.length > 0){
            response.data.city_details.forEach(function(value,key){
                $('#city').append("<option value='"+value.id+"'>"+value.name+"</option>");
            })
            $('#city').parents('.fields').show();
        }else{
            $('#city').parents('.fields').hide();
        }
    }
}

function handelProfileResponse(response,data){
    if(response && response.success){

        var country = $('#country option[value="'+data.country+'"]').html();
        var state = $('#state option[value="'+data.state+'"]').html();
        var city =  $('#state option[value="'+data.city+'"]').html();


        $('.profileWrap .userGender').html(data.gender);
        $('.profileWrap .userName').html(data.name+ " "+ data.lastname);
        $('.profileWrap .aboutMe').html(data.about);
        $('.profileWrap .userPartialAddress').html(state+", "+country);
        $('.profileWrap .dateOfBirth').html(data.dob);
        $('.profileWrap .fillAddress').html(data.address+", "+city+", "+state+", "+country);
        $('.profileWrap .profile-img img').attr('src',$('.editProfileWrap .profile-img img').attr('src'));
        $('.my-account img').attr('src',$('.editProfileWrap .profile-img img').attr('src'));

        if(data.address != "")
            $('.profileWrap .fillAddress').parents('.fields').show();
        if(data.about != "")
            $('.profileWrap .aboutMe').parents('.fields').show();
        if(data.dob != "")
            $('.profileWrap .dateOfBirth').parents('.fields').show();

        $('.editProfileWrap').hide();
        $('.profileWrap').show();
        $('.EditButton').show();
    }else {
        showMessage('ERROR','Fail to upload profile')
    }
}


  function readURL(input,selector_img) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(selector_img).attr('src', e.target.result)
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        











