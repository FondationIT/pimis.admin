function afficheEBChoix(texte,id){
    texte = JSON.parse(texte)
    $('#unite-'+id).html('');
    if(texte){
        $('#unite-'+id).html(texte.unite);
    }
}
prodEB = '<option value=""  ></option>';
prod = $('#allProdPlus').val()
prod = JSON.parse(prod)
$.each(prod, function(i, item) {
    item1= item.designation;








    prodEB += '<option value='+JSON.stringify(item).split()+'  >'+item1+'</option>';

});
$('#prodEB1').html(prodEB);

var count = 1;
$('#eBAdd').on('click', function(e){
    e.preventDefault();
    count = count + 1;
    var aBPlus ="";
    aBPlus += '<div class="form-row" id="form-row'+count+'"><div class="col-md-3 mb-10"><select class="form-control select2 prodEB" name="product"  onchange="afficheEBChoix(this.value,'+count+')" id="prodEB'+count+'" required></select><div class="invalid-feedback">Selectionner un produit</div></div>'


    aBPlus +='<div class="col-md-3 mb-10"><div class="input-group"><input type="number" class="form-control QteEB" name="username"  aria-describedby="inputGroupPrepend" required><div class="input-group-prepend"><span class="input-group-text" id="unite-'+count+'"></span></div><div class="invalid-feedback">Le nom d\'utilisateur est obligatoire</div></div></div>'

    aBPlus += '<div class="col-md-5 mb-10"><textarea class="form-control descEB" name="description" id="prodE'+count+'"></textarea></div>'

    aBPlus += '<div class="col-md-1 mb-10"><label for=""></label><button type="button" name="remove" data-row="form-row'+count+'" class="button btn btn-danger removeEB">-</button></div></div>'


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

   $('.prodEB').each(function(){
    produit.push(JSON.parse($(this).val()).id);
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

    data: JSON.stringify(etatBesFormToJSON(produit,qte,descr,agent,projet,comment)),
    beforeSend: function() {
        $('#btnEtBes').hide();
        $('#prldEtBes').show();
    },
    success: function(data, textStatus, jqXHR){

            $('#prldEtBes').hide();
            $('#btnEtBes').show();
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
        $('#prldEtBes').hide();
        $('#btnEtBes').show();
        $('#messageErrEtBes').html(messageErr(data))
    }
});

 }

//
 function etatBesFormToJSON(produit,qte,descr,agent,projet,comment) {
   return {
     "product":produit,
     "quantite": qte,
     "description": descr,
     "agent": agent,
     "projet": projet,
     "comment": comment
   };
 }

