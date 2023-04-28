function afficheEBChoix(texte,id){
    texte = JSON.parse(texte)
    $('#unite-'+id).html('');
    if(texte){
        $('#unite-'+id).html(texte.item.unite);
    }
}

prod = $('#allProdPlus').val()
prod = JSON.parse(prod)

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
        item1= item.designation;
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


    aBPlus +='<div class="col-md-3 mb-10"><div class="input-group"><input type="number" class="form-control QteEB" name="username"  aria-describedby="inputGroupPrepend" required><div class="input-group-prepend"><span class="input-group-text uniteC" id="unite-'+count+'"></span></div><div class="invalid-feedback">Le nom d\'utilisateur est obligatoire</div></div></div>'

    aBPlus += '<div class="col-md-5 mb-10"><textarea class="form-control descEB" name="description" id="prodE'+count+'"></textarea></div>'

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
    item = JSON.parse($(this).val())
    produit.push(item.item.id);
   });
   $('.QteEB').each(function(){
    qte.push($(this).val());
   });
   $('.descEB').each(function(){
    descr.push($(this).val());
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

