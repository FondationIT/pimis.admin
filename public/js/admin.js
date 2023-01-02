$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//setInterval(notification, 3000);
//setInterval(message, 3000);



/* ***************************

        REGISTER
        
******************************/
$('#registerId').on('submit', function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault()
    register()
})
function register(){
    $.ajax({
        type: 'POST',
        contentType: 'application/json',
        url: "/register",
        dataType: 'json',
        
        data: JSON.stringify({"name": $('#name').val(), "phone": $('#phone').val(), "email": $('#email').val(), "parrain": $('#parrain').val(), "password": $('#password').val() }),
        beforeSend: function() {
            $('.preloader-it').show();
        },
        success: function(data, textStatus, jqXHR){
            
            if(data.data){
            
              var outputmess = '<div>'+data.data[0].data+'</div>'
              output.html(outputmess)
              $('.close').click()
              $('.preloader-it').hide();
              $.toast({
                    text: "Utilisateur emregistré",
                    showHideTransition: 'slide',
                    icon: 'success',
                    position: 'top-center'
                })
            } 
              
        },
        error: function(jqXHR, textStatus, data){
            $('.preloader-it').hide();
            $.toast({
                text: jqXHR.responseJSON.message,
                showHideTransition: 'slide',
                icon: 'danger',
                position: 'top-center'
            })
        }
    });
}




/* ***************************

        NOTIFICATIONS
        
******************************/

function notification(){
    $.ajax({
        type: 'POST',
        contentType: 'application/json',
        url: "/notification",
        dataType: 'json',
        
        data: "",
        success: function(data, textStatus, jqXHR){

            if(data.count>0){
               var countnot = '<span class="badge-primary pulse" style="font-size: 10px;padding: 3px;border-radius: 50%;">'+data.count+'</span>'
              var outputnot ="";
              $.each(data.data, function(i, item) {
                  

               outputnot += '<a href="javascript:void(0);" class="dropdown-item"><div class="media">'
                 outputnot += '<div class="media-img-wrap"><div class="avatar avatar-sm"><span class="avatar-text avatar-text-success rounded-circle"><span class="initial-wrap"><span>NL</span></span></span></div></div>'

                         outputnot +=   '<div class="media-body"><div><div class="notifications-text"><span class="text-dark text-capitalize">'+item.data+'</span> est abonné à sayunilabotte.com</div><div class="notifications-time">'+moment(item.updated_at).fromNow(true)+'</div></div></div></div></a>'
                    outputnot += '<div class="dropdown-divider"></div>'
                })
                $('#countnot').html(countnot)
                $('#outputnot').html(outputnot)
               } 
            

           
        },
        error: function(jqXHR, textStatus, data){



        }
    });
}




/* ***************************

        MESSAGES

******************************/

function message(){
    $.ajax({
        type: 'POST',
        contentType: 'application/json',
        url: "/message",
        dataType: 'json',
        
        data: "",
        success: function(data, textStatus, jqXHR){

            if(data.count>0){
              var countmess = '<span class="badge-primary pulse" style="font-size: 10px;padding: 3px;border-radius: 50%;">'+data.count+'</span>'
              var outputmess ="";
              $.each(data.data, function(i, item) {
                  

               outputmess += '<a href="javascript:void(0);" class="dropdown-item"><div class="media">'
                 outputmess += '<div class="media-img-wrap"><div class="avatar avatar-sm"><span class="avatar-text avatar-text-success rounded-circle"><span class="initial-wrap"><span>NL</span></span></span></div></div>'

                         outputmess +=   '<div class="media-body"><div><div class="notifications-text"><span class="text-dark text-capitalize">'+item.name+'</span><br>'+item.data+'</div><div class="notifications-time">'+moment(item.updated_at).fromNow(true)+'</div></div></div></div></a>'
                    outputmess += '<div class="dropdown-divider"></div>'
                })
                $('#countmess').html(countmess)
                $('#outputmess').html(outputmess)
               } 
            

           
        },
        error: function(jqXHR, textStatus, data){



        }
    });
}

var alert = $('.alert-msg'); // alert div for show alert message
var preload12 = '<div class="preloader-it"><div class="loader-pendulums"></div></div>'



$('#form-presentation').on('submit', function(e) {

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  
    e.preventDefault()
    content = tinymce.get('data-presentation').getContent();
    //console.log(content)

    var data1 = JSON.stringify({"data": content });
    var output = $('#aff-presentation')
    presentation('/presentation',data1,output)
    
})




$('#form-vision').on('submit', function(e) {

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  
    e.preventDefault()
    content = tinymce.get('data-vision').getContent();
    //console.log(content)

    var data1 = JSON.stringify({"data": content });
    var output = $('#aff-vision')
    presentation('/vision',data1,output)
    
})





$('#form-historique').on('submit', function(e) {

  console.log("etape 1")
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  console.log("etape 2")
    e.preventDefault()
    content = tinymce.get('data-historique').getContent();
    //console.log(content)
console.log("etape 3")
    var data1 = JSON.stringify({"data": content });
    var output = $('#aff-historique')
    presentation('/historique',data1,output)
    console.log("etape 4")
})





/* ***************************

        PRESENTATION

******************************/

function presentation(url,data1,output){
    $.ajax({
        type: 'POST',
        contentType: 'application/json',
        url: url,
        dataType: 'json',
        
        data: data1,
        beforeSend: function() {
            $('.preloader-it').show();
        },
        success: function(data, textStatus, jqXHR){
            
            if(data.data){
            
              var outputmess = '<div>'+data.data[0].data+'</div>'
              output.html(outputmess)
              $('.close').click()
              $('.preloader-it').hide();
              $.toast({
                    text: "La modification a été bien effectuée",
                    showHideTransition: 'slide',
                    icon: 'success',
                    position: 'top-center'
                })
            } 
              
        },
        error: function(jqXHR, textStatus, data){
            $('.preloader-it').hide();
        }
    });
}



