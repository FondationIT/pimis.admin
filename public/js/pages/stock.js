function allFournPlus(prodd){


    //prod = JSON.stringify($(this).data("row"))

    var pr = $('#allFournPlus' + prodd).val();
    pr =JSON.parse(pr)
    pr = pr.bad
    fournP = '<option value=""  ></option>';
    $.each(pr, function(i, item) {

        item1= item.name;
        fournP += '<option value='+item.id+'>'+item1+'</option>';
        //$('#fournP1').html(fournP);
    });

}

var count = 1;
$('#profAdd').on('click', function(e){
    e.preventDefault();
    count = count + 1;
    var aBPlus ="";
    aBPlus += '<div class="form-row form-row-all" id="form-rowP'+count+'"><div class="col-md-1 mb-10"></div><div class="col-md-5 mb-10"><label for="fournisseur">Fournisseur</label><select class="form-control fournProf" id="fournP'+count+'" name="fournisseur" required></select><div class="invalid-feedback">Selectionner un fournisseur</div></div>'


    aBPlus +='<div class="col-md-5 mb-10"><label for="reference">Reference proforma</label><input type="text" class="form-control refProf" name="reference" id="refP'+count+'" aria-describedby="inputGroupPrepend" required><div class="invalid-feedback">La reference proforma est obligatoire</div></div>'


    aBPlus += '<div class="col-md-1 mb-10"><label for=""></label><a href="#" name="remove" data-row="form-rowP'+count+'" class="removeProf text-red-600"><i class="icon-close txt-danger"></i></a></div></div>'


    $('#autreProf').append(aBPlus);
    $('#fournP'+count).html(fournP);


    $('.removeProf').on('click', function(e){

        e.preventDefault();
        var delete_row = $(this).data("row");
        $('#' + delete_row).remove();
    });

});




///////////////////////////////////////////////////////////////////////

           //   VALIDATION FORMULAIRE PROFRMA  //

//////////////////////////////////////////////////////////////////////




var commForm = document.getElementById('registerProforma');
commForm.onsubmit = function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  e.preventDefault();
   var fournisseur = [];
   var reference = [];
   var da = $('#daProf').val()

   $('.fournProf').each(function(){
    fournisseur.push($(this).val());
   });
   $('.refProf').each(function(){
    reference.push($(this).val());
   });


   $.ajax({
    type: 'POST',
    contentType: 'application/json',
    url: "/proformaReg",
    dataType: 'json',

    data: JSON.stringify(proformaFormToJSON(fournisseur,reference,da)),
    beforeSend: function() {
        $('#btnProforma').hide();
        $('#prldProforma').show();
    },
    success: function(data, textStatus, jqXHR){

            $('#prldProforma').hide();
            $('#btnProforma').show();
            $('.close').click()

            Livewire.emit('demAchUpdated')

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
        $('#prldProforma').hide();
        $('#btnProforma').show();
        $('#messageErrProforma').html(messageErr(data))
    }
});

 }

//
 function proformaFormToJSON(fournisseur,reference,da) {
   return {
     "fournisseur":fournisseur,
     "reference": reference,
     "da": da
   };
 }

 $("#btnPrintBr").click(function () {
    $("#printBr").print();
});





///////////////////////////////////////////////////////////////////////
                            /////////////////////
                    /////////////////////////////////////




                            //  SCRIPT PV ANALYSE  //




           /////////////////////////////////////////////
                      ///////////////////////
//////////////////////////////////////////////////////////////////////



var pr = $('#allPartPVPlus').val();
    pr =JSON.parse(pr)

var count = 1;
$('#partPVAdd').on('click', function(e){
    e.preventDefault();
    count = count + 1;
    var aBPlus ="";

    aBPlus +='<div class="form-row form-row-all" id="form-rowPV'+count+'"><div class="col-md-3 mb-10"></div><div class="col-md-6 mb-10"><select class="form-control fournPartPV" id="agPv'+count+'" required></select></div>'

    aBPlus += '<div class="col-md-1 mb-10"><label for=""></label><a href="#" name="remove" data-row="form-rowPV'+count+'" class="removePartPV text-red-600"><i class="icon-close txt-danger"></i></a></div><div class="col-md-2 mb-10"></div></div>'

    partPv = '<option value=""  ></option>';
    $.each(pr, function(i, item) {

        item1= item.firstname;
        item2= item.lastname;
        partPv += '<option value='+item.id+'>'+item1+' '+item2+'.</option>';
        //$('#fournP1').html(fournP);
    });

    $('#autrePartPV').append(aBPlus);
    $('#agPv'+count).html(partPv);


    $('.removePartPV').on('click', function(e){

        e.preventDefault();
        var delete_row = $(this).data("row");
        $('#' + delete_row).remove();
    });

});








///////////////////////////////////////////////////////////////////////

           //   VALIDATION FORMULAIRE PV  //

//////////////////////////////////////////////////////////////////////




var comm1Form = document.getElementById('registerPv');

comm1Form.onsubmit = function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  e.preventDefault();
   var agPv = [];
   var prixPv = [];
   var profPv = [];
   var prodPv = [];
   var daPv = $('#daPv').val()
   var typePv = $('#typePv').val()
   var titrePv = $('#titrePv').val()
   var datePv = $('#datePv').val()
   var obsPv = $('#obsPv').val()
   var justPv = $('#justPv').val()

   $('.fournPartPV').each(function(){
    agPv.push($(this).val());
   });
   $('.prixPv').each(function(){
    prixPv.push($(this).val());
   });
   $('.profPv').each(function(){
    profPv.push($(this).val());
   });
   $('.prodPv').each(function(){
    prodPv.push($(this).val());
   });


   $.ajax({
    type: 'POST',
    contentType: 'application/json',
    url: "/pvReg",
    dataType: 'json',

    data: JSON.stringify(pvFormToJSON(daPv,typePv,titrePv,datePv,obsPv,justPv,agPv,prixPv,profPv,prodPv)),
    beforeSend: function() {
        $('#btnPv').hide();
        $('#prldPv').show();
    },
    success: function(data, textStatus, jqXHR){

            $('#prldPv').hide();
            $('#btnPv').show();
            $('.close').click()

            Livewire.emit('demAchUpdated')

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
        $('#prldPv').hide();
        $('#btnPv').show();
        $('#messageErrPv').html(messageErr(data))
    }
});

 }








function pvFormToJSON(daPv,typePv,titrePv,datePv,obsPv,justPv,agPv,prixPv,profPv,prodPv) {
    return {
      "titrePv":titrePv,
      "daPv": daPv,
      "typePv":typePv,
      "datePv":datePv,
      "obsPv": obsPv,
      "justPv": justPv,
      "agPv":agPv,
      "prixPv": prixPv,
      "profPv": profPv,
      "prodPv": prodPv
    };
  }

















///////////////////////////////////////////////////////////////////////
                            /////////////////////
                    /////////////////////////////////////




                            //  SCRIPT PV ATTRIBITION  //




           /////////////////////////////////////////////
                      ///////////////////////
//////////////////////////////////////////////////////////////////////



var pr = $('#allPartPVPlus2').val();
    pr =JSON.parse(pr)

var count = 1;
$('#partPVAdd2').on('click', function(e){
    e.preventDefault();
    count = count + 1;
    var aBPlus ="";

    aBPlus +='<div class="form-row form-row-all" id="form-rowPV2'+count+'"><div class="col-md-3 mb-10"></div><div class="col-md-6 mb-10"><select class="form-control fournPartPV" id="agPv2'+count+'" required></select></div>'

    aBPlus += '<div class="col-md-1 mb-10"><label for=""></label><a href="#" name="remove" data-row="form-rowPV2'+count+'" class="removePartPV2 text-red-600"><i class="icon-close txt-danger"></i></a></div><div class="col-md-2 mb-10"></div></div>'

    partPv = '<option value=""  ></option>';
    $.each(pr, function(i, item) {

        item1= item.firstname;
        item2= item.lastname;
        partPv += '<option value='+item.id+'>'+item1+' '+item2+'.</option>';
        //$('#fournP1').html(fournP);
    });

    $('#autrePartPV2').append(aBPlus);
    $('#agPv2'+count).html(partPv);


    $('.removePartPV2').on('click', function(e){

        e.preventDefault();
        var delete_row = $(this).data("row");
        $('#' + delete_row).remove();
    });

});








///////////////////////////////////////////////////////////////////////

           //   VALIDATION FORMULAIRE PV ATTRIBUTION //

//////////////////////////////////////////////////////////////////////




var comm13Form = document.getElementById('registerPvAttr');
comm13Form.onsubmit = function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  e.preventDefault();
   var agPv = [];
   var fournPv = [];
   var prodPv = [];
   var daPv = $('#daPv2').val()
   var typePv = $('#typePv2').val()
   var titrePv = $('#titrePv2').val()
   var obsPv = $('#obsPv2').val()
   var justPv = $('#justPv2').val()

   $('.fournPartPV2').each(function(){
    agPv.push($(this).val());
   });
   $('.fournPv2').each(function(){
    fournPv.push($(this).val());
   });
   $('.prodPv2').each(function(){
    prodPv.push($(this).val());
   });


   $.ajax({
    type: 'POST',
    contentType: 'application/json',
    url: "/pvAttrReg",
    dataType: 'json',

    data: JSON.stringify(pv2FormToJSON(daPv,typePv,titrePv,fournPv,obsPv,justPv,agPv,prodPv)),
    beforeSend: function() {
        $('#btnPv2').hide();
        $('#prldPv2').show();
    },
    success: function(data, textStatus, jqXHR){

            $('#prldPv2').hide();
            $('#btnPv2').show();
            $('.close').click()

            Livewire.emit('demAchUpdated')

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
        $('#prldPv2').hide();
        $('#btnPv2').show();
        $('#messageErrPv2').html(messageErr(data))
    }
});

 }








function pv2FormToJSON(daPv,typePv,titrePv,fournPv,obsPv,justPv,agPv,prodPv) {
    return {
      "titrePv":titrePv,
      "fournPv": fournPv,
      "daPv": daPv,
      "typePv":typePv,
      "obsPv": obsPv,
      "justPv": justPv,
      "agPv":agPv,
      "prodPv": prodPv
    };
  }











  ///////////////////////////////////////////////////////////////////////
                            /////////////////////
                    /////////////////////////////////////




                            //  SCRIPT BR  //




           /////////////////////////////////////////////
                      ///////////////////////
//////////////////////////////////////////////////////////////////////














///////////////////////////////////////////////////////////////////////

           //   VALIDATION FORMULAIRE BR  //

//////////////////////////////////////////////////////////////////////




var comm2Form = document.getElementById('registerBr');
comm2Form.onsubmit = function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  e.preventDefault();
   var qte = [];
   var observation = [];
   var prod = [];

   var bc = $('#bcBr').val()
   var projet = $('#projetBr').val()
   var fournisseur = $('#fournisseurBr').val()
   var personne = $('#personneBr').val()
   var lieu = $('#lieuBr').val()
   var bordereau = $('#bordereauBr').val()
   var etat = $('#etatBr').val()
   var comment = $('#commentBr').val()

   $('.qteBr').each(function(){
    qte.push($(this).val());
   });
   $('.observationBr').each(function(){
    observation.push($(this).val());
   });
   $('.prodBr').each(function(){
    prod.push($(this).val());
   });


   $.ajax({
    type: 'POST',
    contentType: 'application/json',
    url: "/brReg",
    dataType: 'json',

    data: JSON.stringify(brFormToJSON(bc,projet,fournisseur,personne,lieu,bordereau,etat,prod,qte,observation,comment)),
    beforeSend: function() {
        $('#btnBr').hide();
        $('#prldBr').show();
    },
    success: function(data, textStatus, jqXHR){

            $('#prldBr').hide();
            $('#btnBr').show();
            $('.close').click()
            $('.form-control').val('')

            Livewire.emit('demAchUpdated')
            Livewire.emit('brUpdated')
            Livewire.emit('bcUpdated')

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
        $('#prldBr').hide();
        $('#btnBr').show();
        $('#messageErrBr').html(messageErr(data))
    }
});

 }








function brFormToJSON(bc,projet,fournisseur,personne,lieu,bordereau,etat,prod,qte,observation,comment) {
    return {
      "bc":bc,
      "projet": projet,
      "fournisseur": fournisseur,
      "personne": personne,
      "lieu": lieu,
      "bordereau": bordereau,
      "etat": etat,
      "prod": prod,
      "qte": qte,
      "observation": observation,
      "comment": comment
    };
  }
