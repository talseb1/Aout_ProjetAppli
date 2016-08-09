/* jquery pour admin */
$(document).ready(function () {
    $("#login").focus();

    $("#login_form").ready(function () {
  
    $('input#submit_login').on('click', function (event) {  
        login = $("#login").val();
        password = $("#password").val();
        if ($.trim(login) != '' && $.trim(password != '')) {
            var data_form = $('form#form_auth').serialize();
            //alert(data_form);
            $.ajax({
                type: 'GET', 
                data: data_form, // si sérialisé
                //data: "login=" + login + "&password=" + password, // si pas sérialisé
                dataType: "json",
                url: './lib/php/ajax/AjaxLogin.php',
                success: function (data) {
                    if (data.retour === 1) {
                        /*$('ul#menu, header').css({
                            'display': 'block',
                            'opacity': '1'
                        });*/                      
                        $('#login_form').remove();
                        window.location.href = "./index.php";
                    
                    }
                    else {
                        //alert('erreur');
                        $('#message').html("Données incorrectes");
                    }
                },
                fail: function () {
                    //alert('Raté');
                }
            });
        }
        else {
            $('#message').html("Remplissez les champs");
        }
        return false;
    });

    });

});

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


