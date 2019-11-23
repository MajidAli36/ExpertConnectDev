function startAjax(method,url,data,callback,loader_selector = '.loader'){
    $.ajax({
        type: method,
        url: url,
        data: data,
        timeout: 310000,
        beforeSend : function (e) { $(loader_selector).show();  },
        error : function(){  $(loader_selector).hide(); window.reload;},
        success : function(resp){
            try{
                $(loader_selector).hide();
                var response = JSON.parse(resp);
                callback(response);
            }
            catch(e){
                callback(false);
            }
        }
    });
}

function startMultipartAjax(method,url,data,callback,loader_selector = '.loader'){
    $.ajax({
        type: method,
        url: url,
        data: data,
        timeout: 310000,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        cache: false,
        beforeSend : function (e) { $(loader_selector).show();  },
        error : function(){  $(loader_selector).hide(); window.reload;},
        success : function(resp){
            try{
                $(loader_selector).hide();
                var response = JSON.parse(resp);
                callback(response);
            }
            catch(e){
                callback(false);
            }
        }
    });
}

function checkSubscription(token,callback){
	startAjax("POST",'/check-subscription',{subscriptionCheck:"check",_token:token},callback);
}

function showMessage(type,message,selector){
    if(!selector){
        selector =""; 
    }
    if(type=="SUCCESS"){
        $(selector+'.showErrorMessage').addClass('alert-success');
        $(selector+'.showErrorMessage').removeClass('alert-danger');
        $(selector+'.showErrorMessage').html('<strong>Success! </strong>' + message);
    }else {
        $(selector+'.showErrorMessage').removeClass('alert-success');
        $(selector+'.showErrorMessage').addClass('alert-danger');
        $(selector+'.showErrorMessage').html('<strong>Error! </strong>' + message);
    }
    $('.showErrorMessage').show();
}

function startAjaxFileUpload(url, data, reply)
{
    var result = '';
    $.ajax({
        type 		: 'POST',
        async   	: true,
        url 		: url,
        data 		: data,
        processData : false,
        contentType : false,
        beforeSend  : function (e) { $('.loader').show();  }
    }).done(function(data1) {
        try{
            $('.loader').hide();
            var response = JSON.parse(data1);
                reply(response);
        }
        catch(e){
            callback(false);
        }
    }).fail(function(data1) {
        $('.loader').hide();
        return false;
    });
    return result;
}


function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
