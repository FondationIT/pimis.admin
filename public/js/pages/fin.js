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

        $('.closeLigne').click()
        $('#prldAppEtBes').hide();
        $('#btnAppEtBes').show();

            Livewire.emit('formEbApprRef')
            Livewire.emit('printDaRef')


    },
    error: function(jqXHR, textStatus, data){
        $('#prldAppEtBes').hide();
        $('#btnAppEtBes').show();
        $('#messageErrLigne').html(data)
    }
});

 }


 ///////////////////////////////////////////////////////////////////////

           //   NOTE DE DEBIT  //

//////////////////////////////////////////////////////////////////////


var count = 1;
$('#ndAdd').on('click', function(e){ 
    e.preventDefault();
    count = count + 1;
    var aBPlus ="";
    aBPlus += '<div class="form-row form-row-all" id="form-rowND'+count+'"><div class="col-md-5 mb-10"><textarea class="form-control prodND" name="product" required></textarea></div>'

    aBPlus +='<div class="col-md-2 mb-10"><input type="texte" class="form-control uniteND" name="unite" required></div>'

    aBPlus +='<div class="col-md-2 mb-10"><input type="number" step="1" min="1" class="form-control QteND" name="" required></div>'

    aBPlus +='<div class="col-md-2 mb-10"><input type="number" step="1" min="1" class="form-control prixND" name="" required></div>'

    aBPlus += '<div class="col-md-1 mb-10"><label for=""></label><a href="#" name="remove" data-row="form-rowND'+count+'" class="removeND text-red-600"><i class="icon-close txt-danger"></i></a></div></div>'


    $('#autreND').append(aBPlus);
    


    $('.removeND').on('click', function(e){

        e.preventDefault();
        var delete_row = $(this).data("row");
        $('#' + delete_row).remove();
    });

});

///////////////////////////////////////////////////////////////////////

           //   VALIDATION FORMULAIRE NOTE DE DEBIT  //

//////////////////////////////////////////////////////////////////////



var ndForm = document.getElementById('registerND')
ndForm.onsubmit = function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  e.preventDefault();
   var produit = [];
   var qte = [];
   var unite = [];
   var prix = [];
   var agent = $('#agentND').val()
   var projet = $('#projetND').val()

   $('.prodND').each(function(){
    produit.push($(this).val()); 
   });
   $('.QteND').each(function(){
    qte.push($(this).val());
   });
   $('.uniteND').each(function(){
    unite.push($(this).val());
   });
   $('.prixND').each(function(){
    prix.push($(this).val());
   });
   



   $.ajax({
    type: 'POST',
    contentType: 'application/json',
    url: "/ndReg",
    dataType: 'json',

    data: JSON.stringify(ndFormToJSON(produit,qte,unite,prix,agent,projet)),
    beforeSend: function() {
        $('#btnND').hide();
        $('#prldND').show();
    },
    success: function(data, textStatus, jqXHR){

            $('#prldND').hide();
            $('#btnND').show();
            $('.close').click()

            Livewire.emit('dipdated')
            Livewire.emit('ndUpdated')

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
        $('#prldND').hide();
        $('#btnND').show();
        $('#messageErrND').html(data)
    }
});

 }

//
 function ndFormToJSON(produit,qte,unite,prix,agent,projet) {
   return {
     "product":produit,
     "quantite": qte,
     "unite": unite,
     "prix": prix,
     "agent": agent,
     "projet": projet,
   };
 }


