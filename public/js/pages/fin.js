///////////////////////////////////////////////////////////////////////

           //   APPROBATION ETAT DE BESOIN(BON DE REQUISITION)  //

//////////////////////////////////////////////////////////////////////






function afficheAppChoix(id){
    
    ligne = $('#allLigne').val()
    ligne = JSON.parse(ligne)

    ar = ligne.bad
    
    var arr = ar.filter(function(v) {
        return v.parent == id;

    })
    line2 = '<option value=""  ></option>';
    $.each(arr, function(i, item) {
        line2 += '<option value="'+item.code+'">'+item.libele+' '+item.code+'</option>';

    });
    $('#line2').html(line2);
    
}

function afficheApp1Choix(id){

    ligne = $('#allLigne').val()
    ligne = JSON.parse(ligne)

    ar = ligne.bad
    
    var arr = ar.filter(function(v) {
        return v.parent == id;

    })
    line3 = '<option value=""  ></option>';
    $.each(arr, function(i, item) {
        line3 += '<option value="'+item.code+'">'+item.libele+' '+item.code+'</option>';

    });
    $('#line3').html(line3);
}

function afficheApp2Choix(id){

    ligne = $('#allLigne').val()
    ligne = JSON.parse(ligne)

    ar = ligne.bad
    
    var arr = ar.filter(function(v) {
        return v.parent == id;

    })
    line4 = '<option value=""  ></option>';
    $.each(arr, function(i, item) {
        line4 += '<option value="'+item.code+'">'+item.libele+' '+item.code+'</option>';

    });
    $('#line4').html(line4);
}

var commForm5 = document.getElementById('apprEtBes');
commForm5.onsubmit = function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  e.preventDefault();

   var line = $('#line4').val()
   var eb = $('#idEbLigne').val()


   $.ajax({
    type: 'POST',
    contentType: 'application/json',
    url: "/etBesApp",
    dataType: 'json',

    data: JSON.stringify({"ligne":line,"id":eb}),
    beforeSend: function() {
        $('#btnAppEtBes').hide();
        $('#prldAppEtBes').show();
    },
    success: function(data, textStatus, jqXHR){

            $('#btnAppEtBes').hide();
            $('#prldAppEtBes').show();
            $('.close').click()

            Livewire.emit('ebUpdated')
            Livewire.emit('bonReqUpdated')

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
        $('#prldAppEtBes').hide();
        $('#btnAppEtBes').show();
        $('messageErrLigne').html(messageErr(data))
    }
});

 }



