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


    aBPlus +='<div class="col-md-3 mb-10"><div class="input-group"><input type="number" class="form-control" class="QteEB" name="username"  aria-describedby="inputGroupPrepend" required><div class="input-group-prepend"><span class="input-group-text" id="unite-'+count+'"></span></div><div class="invalid-feedback">Le nom d\'utilisateur est obligatoire</div></div></div>'

    aBPlus += '<div class="col-md-5 mb-10"><textarea class="form-control" name="description" id="prodE'+count+'" class="descEB"></textarea></div>'

    aBPlus += '<div class="col-md-1 mb-10"><label for=""></label><button type="button" name="remove" data-row="form-row'+count+'" class="button btn btn-danger removeEB">-</button></div></div>'


    $('#autreEB').append(aBPlus);
    $('#prodEB'+count).html(prodEB);


    $('.removeEB').on('click', function(e){

        e.preventDefault();
        var delete_row = $(this).data("row");
        $('#' + delete_row).remove();
    });




});
