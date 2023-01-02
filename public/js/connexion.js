$(document).ready(function(){

//******************* CONNEXION UTILISATEUR *************************//


	$('#userconnect').on('click', function(e){
        e.preventDefault();
        if($('#username').val()!='' && $('#userpass').val() !=''){

        	$.ajax({
                type: 'POST',
                contentType: 'application/json',
                url: "controler/connexion",
                dataType: 'json',
                
                data: formToJSON(),
                success: function(data, textStatus, jqXHR){
                    if(data.useData){
                          }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert('Erreur du systeme: ' + textStatus);
                    alert('Erreur du systeme: ' + textStatus);
                }
            });

            function formToJSON(){

	            return JSON.stringify({
	            "username": $('#nom').val(),
	            "userpass": $('#prenom').val()
	            
	            });
	        }

        }
    });

//******************* INSCRIPTION UTILISATEUR *************************//    

    $('#userregister').on('click', function(e){
        e.preventDefault();
        if($('#name').val()!='' && $('#mail').val() !='' && $('#pass1').val() !='' && $('#pass2').val() !=''){

        	if($('#pass1').val() == $('#pass2').val()){

	        	$.ajax({
	                type: 'POST',
	                contentType: 'application/json',
	                url: "controler/inscription.php",
	                dataType: 'json',
	                
	                data: formToJSON(),
	                success: function(data, textStatus, jqXHR){
	                    if(data.useData){
	                          }
	                },
	                error: function(jqXHR, textStatus, errorThrown){
	                    alert('Erreur du systeme: ' + textStatus);
	                    alert('Erreur du systeme: ' + textStatus);
	                }
	            });

	            function formToJSON(){

		            return {
		            "name": $('#name').val(),
		            "mail": $('#mail').val(),
		            "pass": $('#pass2').val()
		            
		            };
		        }
		    }else{

		    }

		    }else{

        }
    });

})