
        var x = document.getElementById('chat-body');
        function scrollBottom(element) {
            element.scroll({ top: element.scrollHeight, behavior: "smooth"})
        }
    
        scrollBottom(x);







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



var commForm = document.getElementById('registerEtBes');
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
    //console.log($(this).val())
    if(ite != null){
        va = ite.item.id
        produit.push(va);
    }
   });
   $('.descEB').each(function(){
    var ite = JSON.parse($(this).val())
    //console.log($(this).val())
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
    const mywindow = window.open('','Print Code');
    const headContent = document.head.innerHTML;
    mywindow.document.write('<html><body>');
    mywindow.document.write(headContent);
    mywindow.document.write('<div style="margin:0px auto !important;">');
    mywindow.document.write(printContents);
    mywindow.document.write('</body></html>');

    mywindow.document.close();
    mywindow.focus();
    mywindow.onload = function(){
        mywindow.print();
        mywindow.close();
    }





    //var originalContents = document.body.innerHTML;
    //document.body.innerHTML = printContents;
    

    //window.print();
    //document.body.innerHTML = originalContents;
    //return false;

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
stock2 = $('#allStockPlus2').val()

stock2 = JSON.parse(stock2)
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
    pr = stock2.bad

    var prr = pr.filter(function(v) {
        return v.project == id;

     });
     prodDI = '<option value=""  ></option>';
     $.each(prr, function(i, item) {

        art2 = $('#allArtPlus2').val()
        art2 = JSON.parse(art2)
        art2 = art2.bad

        arr = art2.filter(function(v) {
            return v.id == item.product;
        });

        item1= arr[0].marque+' '+arr[0].model+' '+arr[0].description;
        prodDI += '<option value=\'{"item":'+JSON.stringify(arr[0])+'}\'>'+item1+'</option>';

    });
    $('#prodDI1').html(prodDI);
}


var count = 1;
$('#diAdd').on('click', function(e){ 
    e.preventDefault();
    count = count + 1;
    var aBPlus ="";
    aBPlus += '<div class="form-row form-row-all" id="form-rowDI'+count+'"><div class="col-md-7 mb-10"><select class="form-control select2 prodDI" name="product"  onchange="afficheDIChoix(this.value,'+count+')" id="prodDI'+count+'" required></select><div class="invalid-feedback">Selectionner un produit</div></div>'


    aBPlus +='<div class="col-md-4 mb-10"><div class="input-group"><input type="number" step="1" min="1" class="form-control QteDI" name="username"  aria-describedby="inputGroupPrepend" required><div class="input-group-prepend"><span class="input-group-text uniteDI" id="uniteDI-'+count+'"></span></div><div class="invalid-feedback">Le nom d\'utilisateur est obligatoire</div></div></div>'

    aBPlus += '<div class="col-md-1 mb-10"><label for=""></label><a href="#" name="remove" data-row="form-rowDI'+count+'" class="removeDI text-red-600"><i class="icon-close txt-danger"></i></a></div></div>'


    $('#autreDI').append(aBPlus);
    $('#prodDI'+count).html(prodDI);
    


    $('.removeDI').on('click', function(e){

        e.preventDefault();
        var delete_row = $(this).data("row");
        $('#' + delete_row).remove();
    });

});

///////////////////////////////////////////////////////////////////////

           //   VALIDATION FORMULAIRE DEMANDE INTERNE  //

//////////////////////////////////////////////////////////////////////



var commForm = document.getElementById('registerDI')
commForm.onsubmit = function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  e.preventDefault();
   var produit = [];
   var qte = [];
   var agent = $('#agentDI').val()
   var projet = $('#projetDI').val()

   $('.prodDI').each(function(){
    var ite = JSON.parse($(this).val())
    //console.log($(this).val())
    if(ite != null){
        va = ite.item.id
        produit.push(va);
    }
   });
   $('.QteDI').each(function(){
    qte.push($(this).val());
   });
   



   $.ajax({
    type: 'POST',
    contentType: 'application/json',
    url: "/diReg",
    dataType: 'json',

    data: JSON.stringify(diFormToJSON(produit,qte,agent,projet)),
    beforeSend: function() {
        $('#btnDI').hide();
        $('#prldDI').show();
    },
    success: function(data, textStatus, jqXHR){

            $('#prldDI').hide();
            $('#btnDI').show();
            $('.close').click()

            Livewire.emit('dipdated')
            Livewire.emit('fichStUpdated')

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
        $('#prldDI').hide();
        $('#btnDI').show();
        $('#messageErrDI').html(messageErr(data))
    }
});

 }

//
 function diFormToJSON(produit,qte,agent,projet) {
   return {
     "product":produit,
     "quantite": qte,
     "agent": agent,
     "projet": projet,
   };
 }





 ///////////////////////////////////////////////////////////////////////

           //   TERME DE REFERENCE  //

//////////////////////////////////////////////////////////////////////


var count = 1;
$('#trAdd').on('click', function(e){ 
    e.preventDefault();
    count = count + 1;
    var aBPlus ="";
    aBPlus += '<div class="form-row form-row-all" id="form-rowTR'+count+'"><div class="col-md-5 mb-10"><textarea class="form-control prodND" name="product" required></textarea></div>'

    aBPlus +='<div class="col-md-2 mb-10"><input type="texte" class="form-control uniteTR" name="unite" required></div>'

    aBPlus +='<div class="col-md-2 mb-10"><input type="number" step="1" min="1" class="form-control QteTR" name="" required></div>'

    aBPlus +='<div class="col-md-2 mb-10"><input type="number" step="1" min="1" class="form-control prixTR" name="" required></div>'

    aBPlus += '<div class="col-md-1 mb-10"><label for=""></label><a href="#" name="remove" data-row="form-rowTR'+count+'" class="removeTR text-red-600"><i class="icon-close txt-danger"></i></a></div></div>'


    $('#autreTR').append(aBPlus);
    


    $('.removeTR').on('click', function(e){

        e.preventDefault();
        var delete_row = $(this).data("row");
        $('#' + delete_row).remove();
    });

});

///////////////////////////////////////////////////////////////////////

           //   VALIDATION FORMULAIRE TERME DE REFERENCE  //

//////////////////////////////////////////////////////////////////////



var trForm = document.getElementById('registerTR')
trForm.onsubmit = function(e) {
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
   var agent = $('#agentTR').val()
   var projet = $('#projetTR').val()
   var type = $('#typeTR').val()
   var titre = $('#titreTR').val()

   $('.prodTR').each(function(){
    produit.push($(this).val()); 
   });
   $('.QteTR').each(function(){
    qte.push($(this).val());
   });
   $('.uniteTR').each(function(){
    unite.push($(this).val());
   });
   $('.prixTR').each(function(){
    prix.push($(this).val());
   });
   



   $.ajax({
    type: 'POST',
    contentType: 'application/json',
    url: "/trReg",
    dataType: 'json',

    data: JSON.stringify(trFormToJSON(produit,qte,unite,prix,agent,projet,type,titre)),
    beforeSend: function() {
        $('#btnTR').hide();
        $('#prldTR').show();
    },
    success: function(data, textStatus, jqXHR){

            $('#prldTR').hide();
            $('#btnTR').show();
            $('.close').click()

            Livewire.emit('dipdated')
            Livewire.emit('trUpdated')

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
        $('#prldTR').hide();
        $('#btnTR').show();
        $('#messageErrTR').html(data)
    }
});

 }

//
 function trFormToJSON(produit,qte,unite,prix,agent,projet,type,titre) {
   return {
     "product":produit,
     "quantite": qte,
     "unite": unite,
     "prix": prix,
     "agent": agent,
     "projet": projet,
     "type": type,
     "titre": titre,
   };
 }