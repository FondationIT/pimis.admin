$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

///////////////////////////////////////////////////////////////////////
                            /////////////////////
                    /////////////////////////////////////




                            //  SCRIPT MISSION  //




           /////////////////////////////////////////////
                      ///////////////////////
//////////////////////////////////////////////////////////////////////



var pr = $('#allPartMSPlus').val();
    pr =JSON.parse(pr)

var count = 1;
$('#partMSAdd').on('click', function(e){
    e.preventDefault();
    count = count + 1;
    var aBPlus ="";

    aBPlus +='<div class="form-row form-row-all" id="form-rowMS'+count+'"><div class="col-md-3 mb-10"></div><div class="col-md-6 mb-10"><select class="form-control fournPartMs" id="agMS'+count+'" required></select></div>'

    aBPlus += '<div class="col-md-1 mb-10"><label for=""></label><a href="#" name="remove" data-row="form-rowMS'+count+'" class="removePartMS text-red-600"><i class="icon-close txt-danger"></i></a></div><div class="col-md-2 mb-10"></div></div>'

    partPv = '<option value=""  ></option>';
    $.each(pr, function(i, item) {

        item1= item.firstname;
        item2= item.lastname;
        partPv += '<option value='+item.id+'>'+item1+' '+item2+'.</option>';
        //$('#fournP1').html(fournP);
    });

    $('#autrePartMS').append(aBPlus);
    $('#agMS'+count).html(partPv);


    $('.removePartMS').on('click', function(e){

        e.preventDefault();
        var delete_row = $(this).data("row");
        $('#' + delete_row).remove();
    });

});








///////////////////////////////////////////////////////////////////////

           //   VALIDATION FORMULAIRE MISSION  //

//////////////////////////////////////////////////////////////////////




var comm1Form = document.getElementById('registerMs');
comm1Form.onsubmit = function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  e.preventDefault();
   var agMs = [];
   var trMs = $('#trMs').val()
   var destMs = $('#destMs').val()
   var objectifMs = $('#objectifMs').val()
   var dateDMs = $('#dateDMs').val()
   var dateFMs = $('#dateFMs').val()
   var typeMs = $('#typeMs').val()
   var dureMs = $('#dureMs').val()
   var moyenMs = $('#moyenMs').val()
   var itMs = $('#itMs').val()

   $('.fournPartMs').each(function(){
    agMs.push($(this).val());
   });


   $.ajax({
    type: 'POST',
    contentType: 'application/json',
    url: "/msReg",
    dataType: 'json',

    data: JSON.stringify(missFormToJSON(agMs,trMs,destMs,objectifMs,dateDMs,dateFMs,typeMs,dureMs,moyenMs,itMs)),
    beforeSend: function() {
        $('#btnMs').hide();
        $('#prldMs').show();
    },
    success: function(data, textStatus, jqXHR){

            $('#prldMs').hide();
            $('#btnMs').show();
            $('.close').click()

            Livewire.emit('trUpdated')
            Livewire.emit('missionUpdated')

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
        $('#prldMs').hide();
        $('#btnMs').show();
        $('#messageErrMs').html(data)
    }
});

 }








function missFormToJSON(agMs,trMs,destMs,objectifMs,dateDMs,dateFMs,typeMs,dureMs,moyenMs,itMs) {
    return {
      "agMs":agMs,
      "trMs": trMs,
      "destMs": destMs,
      "objectifMs":objectifMs,
      "dateFMs": dateFMs,
      "dateDMs": dateDMs,
      "typeMs":typeMs,
      "dureMs": dureMs,
      "moyenMs": moyenMs,
      "itMs": itMs
    };
  }



