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

    aBPlus +='<div class="form-row form-row-all" id="form-rowMS'+count+'"><div class="col-md-3 mb-10"></div><div class="col-md-6 mb-10"><select class="form-control fournPartMs select2ms" id="agMS'+count+'" required></select></div>'

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
    $('.select2ms').select2()

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



















  ///////////////////////////////////////////////////////////////////////
                            /////////////////////
                    /////////////////////////////////////




                            //  SCRIPT CONTRAT  //




           /////////////////////////////////////////////
                      ///////////////////////
//////////////////////////////////////////////////////////////////////




var prCtr = $('#allProjetCtrPlus').val();
prCtr =JSON.parse(prCtr)

var count = 1;
var p1 = 100;
$('#partCtr1').val(p1);
$('#ctrAdd').hide();
$('#ctrAdd').on('click', function(e){
e.preventDefault();
count = count + 1;
var aBPlus ="";



aBPlus +='<div class="form-row form-row-all" id="form-rowCtr'+count+'"><div class="col-md-5 mb-10"><select class="form-control projetCtr" id="projetCtr'+count+'" required></select></div>'

aBPlus +='<div class="col-md-4 mb-10"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend"><i>%</i></span></div><input type="number" step="1" min="1" max="'+p1+'" class="form-control partCtr" onchange="showMe(this)" required></div></div>'

aBPlus += '<div class="col-md-1 mb-10"><label for=""></label><a href="#" name="remove" data-row="form-rowCtr'+count+'" class="removeCtr text-red-600"><i class="icon-close txt-danger"></i></a></div><div class="col-md-2 mb-10"></div></div>'

partCtr = '<option value=""  ></option>';
$.each(prCtr, function(i, item) {

    item1= item.name;
    partCtr += '<option value='+item.id+'>'+item1+'.</option>';
    //$('#fournP1').html(fournP);
});

$('#autreCTR').append(aBPlus);
$('#projetCtr'+count).html(partCtr);


$('.removeCtr').on('click', function(e){

    e.preventDefault();
    var delete_row = $(this).data("row");
    $('#' + delete_row).remove();
});

$('.removeCtr').on('click', function(e){

    e.preventDefault();
    var delete_row = $(this).data("row");
    $('#' + delete_row).remove();
});

});



function showPart(e) {

    if(e.value == ''){

        $('#projetCtr1').html('')

    }else{

        var prCtr22 = $('#allProjetsCtrPlus').val();
        prCtr22 =JSON.parse(prCtr22)
        var prCtr1 = prCtr22.filter(function(v) {
            return v.id == e.value;
    
         })

        $('#projetCtr1').html('<option value="'+e.value+'">'+prCtr1[0].name+'</option>')

        if(e.value == 3){

            $('#ctrAdd').show();
    
        }else{
    
            $('#ctrAdd').hide();
        }
    }
}


function showMe(e) {
    p1 = p1-e.value;
    $('#partCtr1').val(parseFloat(p1));
}








///////////////////////////////////////////////////////////////////////

       //   VALIDATION FORMULAIRE CONTRAT  //

//////////////////////////////////////////////////////////////////////




var ctrForm = document.getElementById('registerCtr');
ctrForm.onsubmit = function(e) {
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
e.preventDefault();
var projet = [];
var part = [];
var agent = $('#agentCtr').val()
var type = $('#typeCtr').val()
var salaire = $('#salaireCtr').val()
var debut = $('#debutCtr').val()
var fin = $('#finCtr').val()
var prots = $('#projet1Ctr').val()
var description = $('#descriptionCtr').val()

$('.projetCtr').each(function(){
    projet.push($(this).val());
});
$('.partCtr').each(function(){
    part.push($(this).val());
});


$.ajax({
type: 'POST',
contentType: 'application/json',
url: "/ctrReg",
dataType: 'json',

data: JSON.stringify(ctrFormToJSON(agent,type,salaire,debut,fin,description,projet,part,prots)),
beforeSend: function() {
    $('#btnCTR').hide();
    $('#prldCTR').show();
},
success: function(data, textStatus, jqXHR){

        $('#prldCTR').hide();
        $('#btnCTR').show();
        $('.close').click()

        Livewire.emit('contratUpdated')

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
    $('#prldCTR').hide();
    $('#btnCTR').show();
    $.toast({
        text: '<i class="jq-toast-icon ti-location-pin"></i><p>'+data+'</p>',
        position: 'top-center',
        loaderBg:'#7a5449',
        class: 'jq-has-icon jq-toast-danger',
        hideAfter: 3500,
        stack: 6,
        showHideTransition: 'fade'
        });
}
});

}








function ctrFormToJSON(agent,type,salaire,debut,fin,description,projet,part,prots) {
return {
  "agent":agent,
  "type": type,
  "salaire": salaire,
  "debut": debut,
  "fin": fin,
  "description": description,
  "projet": projet,
  "part": part,
  "prots": prots
};
}




  ///////////////////////////////////////////////////////////////////////
                            /////////////////////
                    /////////////////////////////////////




                            //  SCRIPT JOURS PRESTES  //




           /////////////////////////////////////////////
                      ///////////////////////
//////////////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////////////////

       //   VALIDATION FORMULAIRE JOURS PRESTES  //

//////////////////////////////////////////////////////////////////////




var ctrForm = document.getElementById('registerJp');
ctrForm.onsubmit = function(e) {
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
e.preventDefault();
var agent = [];
var jour = [];
var pymt = $('#pymtJP').val()

$('.agentJP').each(function(){
    agent.push($(this).val());
});
$('.jourJP').each(function(){
    jour.push($(this).val());
});


$.ajax({
type: 'POST',
contentType: 'application/json',
url: "/jpReg",
dataType: 'json',

data: JSON.stringify(jpFormToJSON(agent,jour,pymt)),
beforeSend: function() {
    $('#btnJP').hide();
    $('#prldJP').show();
},
success: function(data, textStatus, jqXHR){

        $('#prldJP').hide();
        $('#btnJP').show();
        $('.close').click()

        //Livewire.emit('trUpdated')
        Livewire.emit('contratUpdated')

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
    $('#prldJP').hide();
    $('#btnJP').show();
    $.toast({
        text: '<i class="jq-toast-icon ti-location-pin"></i><p>'+data+'</p>',
        position: 'top-center',
        loaderBg:'#7a5449',
        class: 'jq-has-icon jq-toast-danger',
        hideAfter: 3500,
        stack: 6,
        showHideTransition: 'fade'
        });
}
});

}








function jpFormToJSON(agent,jour,pymt) {
return {
  "agent":agent,
  "jour": jour,
  "pymt": pymt,
};
}