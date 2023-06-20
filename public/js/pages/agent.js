prod = $('#allProdPlus').val()
art = $('#allArtPlus').val()
art = JSON.parse(art)
prod = JSON.parse(prod)


function afficheEBChoix(texte,id){
    
    $('#unite-'+id).html('');
    $('#prodE'+id).html('');

    if(texte != ''){
        texte = JSON.parse(texte)
    }

    ar = art.bad

    var arr = ar.filter(function(v) {
        return v.product == texte.item.id;

     })
    
    prodE1 = '<option value=""  ></option>';
    $.each(arr, function(i, item) {
       item1= texte.item.name+' '+item.marque+' '+item.model;
       prodE1 += '<option value=\'{"item":'+JSON.stringify(item)+'}\'>'+item1+'</option>';

   });
   $('#prodE'+id).html(prodE1);
    
}

function afficheEB1Choix(texte,id){
    texte = JSON.parse(texte)
    $('#unite-'+id).html('');
    if(texte){
        $('#unite-'+id).html(texte.item.unite);
    }
}


function afficheCatChoix(id){


    $('.uniteC').html('')
    $('.prodEB').val('')
    $('#prodEB1').val('')
    $('.QteEB').val('')
    $('.descEB').val('')
    $('.form-row-all').remove();
    pr = prod.bad

    var prr = pr.filter(function(v) {
        return v.categorie == id;

     });
     prodEB = '<option value=""  ></option>';
     $.each(prr, function(i, item) {
        item1= item.name;
        prodEB += '<option value=\'{"item":'+JSON.stringify(item)+'}\'>'+item1+'</option>';

    });
    $('#prodEB1').html(prodEB);
}



var count = 1;
$('#eBAdd').on('click', function(e){
    e.preventDefault();
    count = count + 1;
    var aBPlus ="";
    aBPlus += '<div class="form-row form-row-all" id="form-row'+count+'"><div class="col-md-3 mb-10"><select class="form-control select2 prodEB" name="product"  onchange="afficheEBChoix(this.value,'+count+')" id="prodEB'+count+'" required></select><div class="invalid-feedback">Selectionner un produit</div></div>'
    
    aBPlus += '<div class="col-md-5 mb-10"><select class="form-control descEB" name="description" id="prodE'+count+'"  onchange="afficheEB1Choix(this.value,'+count+')" required></select><div class="invalid-feedback">Selectionner un produit</div></div>'


    aBPlus +='<div class="col-md-3 mb-10"><div class="input-group"><input type="number" class="form-control QteEB" name="username"  aria-describedby="inputGroupPrepend" required><div class="input-group-prepend"><span class="input-group-text uniteC" id="unite-'+count+'"></span></div><div class="invalid-feedback">Le nom d\'utilisateur est obligatoire</div></div></div>'

    aBPlus += '<div class="col-md-1 mb-10"><label for=""></label><a href="#" name="remove" data-row="form-row'+count+'" class="removeEB text-red-600"><i class="icon-close txt-danger"></i></a></div></div>'


    $('#autreEB').append(aBPlus);
    $('#prodEB'+count).html(prodEB);
    


    $('.removeEB').on('click', function(e){

        e.preventDefault();
        var delete_row = $(this).data("row");
        $('#' + delete_row).remove();
    });

});





///////////////////////////////////////////////////////////////////////

           //   VALIDATION FORMULAIRE ETAT DE BESOIN  //

//////////////////////////////////////////////////////////////////////



var commForm = $('#registerEtBes');
commForm.onsubmit = function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  e.preventDefault();
   var produit = [];
   var qte = [];
   var descr = []
   var agent = $('#agentEB').val()
   var comment = $('#commentEB').val()
   var projet = $('#projetEB').val()
   var categorie = $('#catEB').val()

   $('.prodEB').each(function(){
    var ite = JSON.parse($(this).val())
    console.log($(this).val())
    if(ite != null){
        va = ite.item.id
        produit.push(va);
    }
   });
   $('.descEB').each(function(){
    var ite = JSON.parse($(this).val())
    console.log($(this).val())
    if(ite != null){
        va = ite.item.id
        descr.push(va);
    }
   });
   $('.QteEB').each(function(){
    qte.push($(this).val());
   });
   



   $.ajax({
    type: 'POST',
    contentType: 'application/json',
    url: "/etBesReg",
    dataType: 'json',

    data: JSON.stringify(etatBesFormToJSON(produit,qte,descr,agent,projet,categorie,comment)),
    beforeSend: function() {
        $('#btnEtBes').hide();
        $('#prldEtBes').show();
    },
    success: function(data, textStatus, jqXHR){

            $('#prldEtBes').hide();
            $('#btnEtBes').show();
            $('.close').click()

            Livewire.emit('ebUpdated')

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
        $('#prldEtBes').hide();
        $('#btnEtBes').show();
        $('#messageErrEtBes').html(messageErr(data))
    }
});

 }

//
 function etatBesFormToJSON(produit,qte,descr,agent,projet,categorie,comment) {
   return {
     "product":produit,
     "quantite": qte,
     "description": descr,
     "agent": agent,
     "projet": projet,
     "categorie": categorie,
     "comment": comment
   };
 }

 $("#btnPrintBr").click(function () {
    $("#printBr").print();
});

function imprimer(divName) {

    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    return false;

 }





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


var commForm5 = $('#apprEtBes');
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









 ///////////////////////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////////////////////
 ///////////////////////////////////////////////////////////////////////

                        //  DEMANDE INTERNE  //

///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////

prod2 = $('#allProdPlus2').val()
art2 = $('#allArtPlus2').val()
art2 = JSON.parse(art2)
prod2 = JSON.parse(prod2)


function afficheDIChoix(texte,id){
    texte = JSON.parse(texte)
    $('#uniteDI-'+id).html('');
    if(texte){
        $('#uniteDI-'+id).html(texte.item.unite);
    }
}


function afficheProjectChoix(id){


    $('.uniteDI').html('')
    $('.prodDI').val('')
    $('#prodDI').val('')
    $('.QteDI').val('')
    $('.form-row-all').remove();
    pr = art2.bad

    var prr = pr.filter(function(v) {
        return v.categorie == id;

     });
     prodDI = '<option value=""  ></option>';
     $.each(prr, function(i, item) {
        item1= item.name;
        prodDI += '<option value=\'{"item":'+JSON.stringify(item)+'}\'>'+item1+'</option>';

    });
    $('#prodDI1').html(prodDI);
}


var count = 1;
$('#diAdd').on('click', function(e){
    e.preventDefault();
    count = count + 1;
    var aBPlus ="";
    aBPlus += '<div class="form-row form-row-all" id="form-rowDI'+count+'"><div class="col-md-7 mb-10"><select class="form-control select2 prodDI" name="product"  onchange="afficheDIChoix(this.value,'+count+')" id="prodDI'+count+'" required></select><div class="invalid-feedback">Selectionner un produit</div></div>'


    aBPlus +='<div class="col-md-4 mb-10"><div class="input-group"><input type="number" class="form-control QteDI" name="username"  aria-describedby="inputGroupPrepend" required><div class="input-group-prepend"><span class="input-group-text uniteDI" id="uniteDI-'+count+'"></span></div><div class="invalid-feedback">Le nom d\'utilisateur est obligatoire</div></div></div>'

    aBPlus += '<div class="col-md-1 mb-10"><label for=""></label><a href="#" name="remove" data-row="form-rowDI'+count+'" class="removeDI text-red-600"><i class="icon-close txt-danger"></i></a></div></div>'


    $('#autreDI').append(aBPlus);
    $('#prodDI'+count).html(prodDI);
    


    $('.removeDI').on('click', function(e){

        e.preventDefault();
        var delete_row = $(this).data("row");
        $('#' + delete_row).remove();
    });

});