$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function messageErr(data){
    message = '<div class="alert alert-danger alert-wth-icon alert-dismissible fade show" role="alert" aria-hidden="true">'
    message += '<span class="alert-icon-wrap"><i class="zmdi zmdi-bug"></i></span>'
    message += data
    message += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
    message += '<span aria-hidden="true">&times;</span></button></div>'

    return message
}

//setInterval(notification, 3000);
//setInterval(message, 3000);



/* ***************************

        REGISTER AGENT

******************************/


$('#registerAgent').on('submit', function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     e.preventDefault();
     $(this).add('was-validated');
    var x = $('#registerAgent').serializeArray();
    var formData = {};

    $.each(x, function(i, field){
        if(field.value.trim() != ""){
            if(formData[field.name] != undefined){
                var val = formData[field.name];
                if(!Array.isArray(val)){
                     arr = [val];
                }
                arr.push(field.value.trim());
                formData[field.name] = arr;
            }else{
              formData[field.name] = field.value;
            }
        }
    });

    //console.log(formData)

   registerAgent(formData)
})
function registerAgent(data){
    $.ajax({
        type: 'POST',
        contentType: 'application/json',
        url: "/agentReg",
        dataType: 'json',

        data: JSON.stringify(data),
        beforeSend: function() {
            $('#btnAg').hide();
            $('#prldAg').show();
        },
        success: function(data, textStatus, jqXHR){

                $('#prldAg').hide();
                $('#btnAg').show();
                $('.close').click()
                location.reload();

                $.toast().reset('all');
                $.toast({
                    text: '<i class="jq-toast-icon ti-location-pin"></i><p>Enregistrement bien effectué</p>',
                    position: 'top-center',
                    loaderBg:'#7a5449',
                    class: 'jq-has-icon jq-toast-success',
                    hideAfter: 3500,
                    stack: 6,
                    showHideTransition: 'fade'
                    });


        },
        error: function(jqXHR, textStatus, data){
            $('#prldAg').hide();
            $('#btnAg').show();
            $('#messageErr').html(messageErr(data))
        }
    });
}





/* ***************************

        REGISTER USER

******************************/


$('#registerUser').on('submit', function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     e.preventDefault();
     $(this).add('was-validated');
    var x = $('#registerUser').serializeArray();
    var formData = {};

    $.each(x, function(i, field){
        if(field.value.trim() != ""){
            if(formData[field.name] != undefined){
                var val = formData[field.name];
                if(!Array.isArray(val)){
                     arr = [val];
                }
                arr.push(field.value.trim());
                formData[field.name] = arr;
            }else{
              formData[field.name] = field.value;
            }
        }
    });

    //console.log(formData)

   registerUser(formData)
})
function registerUser(data){
    $.ajax({
        type: 'POST',
        contentType: 'application/json',
        url: "/userReg",
        dataType: 'json',

        data: JSON.stringify(data),
        beforeSend: function() {
            $('#btnUs').hide();
            $('#prldUs').show();
        },
        success: function(data, textStatus, jqXHR){

                $('#prldUs').hide();
                $('#btnUs').show();
                $('.close').click()
                location.reload();

                $.toast().reset('all');
                $.toast({
                    text: '<i class="jq-toast-icon ti-location-pin"></i><p>Enregistrement bien effectué</p>',
                    position: 'top-center',
                    loaderBg:'#7a5449',
                    class: 'jq-has-icon jq-toast-success',
                    hideAfter: 3500,
                    stack: 6,
                    showHideTransition: 'fade'
                    });


        },
        error: function(jqXHR, textStatus, data){
            $('#prldUs').hide();
            $('#btnUs').show();
            $('#messageErrUs').html(messageErr(data))
        }
    });
}


