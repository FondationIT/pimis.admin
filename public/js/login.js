//let $ = require('jquery');
//const ipc = require('electron').ipcRenderer;
$('#btn-login').on('click', (e) => {

    e.preventDefault()

        let txtUser=$('#txtUsr').val();
        let txtPwd=$('#txtPwd').val();

        function adminFormToJSON() {
        
            return JSON.stringify({
                "user": txtUser,
                "pass": txtPwd
                });
        }
        if(txtUser!="" && txtPwd!=""){

            $.ajax({
                type: 'POST',
                contentType: 'application/json',
                url: "{{ url('login') }}",
                dataType: 'json',
                
                data: adminFormToJSON(),
                success: function(data, textStatus, jqXHR){
                    if(data.Data){
                         ipc.sendSync('entry-accepted', 'ping')
                        }else{
                           $('#lbl').text('Nom d\'utilisateur ou mot de passe incorecte');
                            $('#lbl').show();
                        }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    $('#lbl').text('Erreur server');
                    $('#lbl').show();
                }
            });
        }
        
      
}) 