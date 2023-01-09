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


/* ***************************

        REGISTER BAILLEUR

******************************/


$('#registerBailleur').on('submit', function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     e.preventDefault();
     $(this).add('was-validated');
    var x = $('#registerBailleur').serializeArray();
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

   registerBailleur(formData)
})
function registerBailleur(data){
    $.ajax({
        type: 'POST',
        contentType: 'application/json',
        url: "/bailleurReg",
        dataType: 'json',

        data: JSON.stringify(data),
        beforeSend: function() {
            $('#btnBail').hide();
            $('#prldBail').show();
        },
        success: function(data, textStatus, jqXHR){

                $('#prldBail').hide();
                $('#btnBail').show();
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
            $('#prldBail').hide();
            $('#btnBail').show();
            $('#messageErrBailleur').html(messageErr(data))
        }
    });
}


/* ***************************

        REGISTER PROJET

******************************/


$('#registerProjet').on('submit', function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     e.preventDefault();
     $(this).add('was-validated');
    var x = $('#registerProjet').serializeArray();
    contexte = tinymce.get('contexteProjet').getContent();
    var formData = {contexte:contexte};

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

   registerProjet(formData)
})
function registerProjet(data){
    $.ajax({
        type: 'POST',
        contentType: 'application/json',
        url: "/projetReg",
        dataType: 'json',

        data: JSON.stringify(data),
        beforeSend: function() {
            $('#btnPjt').hide();
            $('#prldPjt').show();
        },
        success: function(data, textStatus, jqXHR){

                $('#prldPjt').hide();
                $('#btnPjt').show();
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
            $('#prldPjt').hide();
            $('#btnPjt').show();
            $('#messageErrProjet').html(messageErr(data))
        }
    });
}


