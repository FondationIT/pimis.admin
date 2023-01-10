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

        REGISTER CATEGORIE

******************************/


$('#registerCategorie').on('submit', function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     e.preventDefault();
     $(this).add('was-validated');
    var x = $('#registerCategorie').serializeArray();
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

   registerCategorie(formData)
})
function registerCategorie(data){
    $.ajax({
        type: 'POST',
        contentType: 'application/json',
        url: "/categorieReg",
        dataType: 'json',

        data: JSON.stringify(data),
        beforeSend: function() {
            $('#btnCat').hide();
            $('#prldCat').show();
        },
        success: function(data, textStatus, jqXHR){

                $('#prldCat').hide();
                $('#btnCat').show();
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
            $('#prldCat').hide();
            $('#btnCat').show();
            $('#messageErrCat').html(messageErr(data))
        }
    });
}



/* ***************************

        REGISTER PRODUCT

******************************/


$('#registerProduct').on('submit', function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     e.preventDefault();
     $(this).add('was-validated');
    var x = $('#registerProduct').serializeArray();
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

   registerProduct(formData)
})
function registerProduct(data){
    $.ajax({
        type: 'POST',
        contentType: 'application/json',
        url: "/productReg",
        dataType: 'json',

        data: JSON.stringify(data),
        beforeSend: function() {
            $('#btnProd').hide();
            $('#prldProd').show();
        },
        success: function(data, textStatus, jqXHR){

                $('#prldProd').hide();
                $('#btnProd').show();
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
            $('#prldProd').hide();
            $('#btnProd').show();
            $('#messageErrProd').html(messageErr(data))
        }
    });
}
