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
    aBPlus += '<div class="form-row form-row-all" id="form-rowP'+count+'"><div class="col-md-5 mb-10"><label for="fournisseur">Fournisseur</label><select class="form-control fournProf" id="fournP'+count+'" name="fournisseur" required></select><div class="invalid-feedback">Selectionner un fournisseur</div></div>'


    aBPlus +='<div class="col-md-6 mb-10"><label for="reference">Reference proforma</label><input type="text" class="form-control refProf" name="reference" id="refP'+count+'" aria-describedby="inputGroupPrepend" required><div class="invalid-feedback">La reference proforma est obligatoire</div></div>'


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

            Livewire.emit('proformaUpdated')

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


