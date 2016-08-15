$(document).ready(function () {

    $("#login").focus();
    $("#annuler").click(function () {
        window.location.href = "../utilisateur/index.php";
    });

    $('input#submit_login').on('click', function (event) {
        login = $("#login").val();
        password = $("#password").val();
        if (($.trim(login) != '') && ($.trim(password != ''))) {

            var data_form = $('form#form_auth').serialize();
            alert(data_form);
            $.ajax({
                type: 'POST',
                data: "login=" + login + "&password=" + password, // si pas sérialisé
                url: './lib/php/ajax/AjaxSeConnecter.php',
                success: function (data_du_php)
                {
                    if (data_du_php.ret == 1)
                    {
                        $('#login_form').remove();
                        window.location.href = "./index.php";
                    }
                    else
                    {
                         $('#message').html("Identifiants incorrectes !");
                    }
                },
                error: function ()
                {

                }
            });
        }
        else {
            $('#message').html("Veuillez compléter le formulaire");
        }
        return false;
    });
});