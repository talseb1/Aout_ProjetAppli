<?php
if (isset($_POST['submit_login'])) {
    $mg = new SeConnecter($db);
    $retour = $mg->estAdmin($_POST['login'], $_POST['password']);
    if ($retour == 1) {
        $_SESSION['admin'] = 1;
        $message = "Authentifié!";
        header('Location: http://localhost/Aout_ProjetAppli/admin/index.php');
    } else {
        $message = $retour;
        $message = "Identifiants incorrectes !";
    }
}
?>
<div class="jumbotron">
<section id="message"><?php if (isset($message)) print $message; ?></section>
<fieldset id="fieldset_login">
    <legend class="txtAuth">Authentifiez-vous sur la session administrateur :</legend>
    <form class="form-signin" action="<?php print $_SERVER['PHP_SELF']; ?>" method='post' id="form_auth">
        <table class='tabAuth'>
            <tr>
                <td>Login &nbsp;</td>
                <td><input type="text" id="login" name="login" required autofocus/></td>
            </tr>
            <tr>
                <td colspan="2" class='bAth'>&nbsp; </td>

            </tr>
            <tr>
                <td id="auth">Password &nbsp;</td>
                <td><input type="password" id="password" name="password" required/></td>
            </tr>
            <tr>
                <td colspan="2" class='bAth'>&nbsp; </td>

            </tr>
            <tr>
                <td colspan="2" class='bAth'>
                    <button type="submit" name="submit_login" class="btn btn-default btn-success">Login <span class="glyphicon glyphicon-ok"></span></button>
                    <button type="reset" id="annuler" class="btn btn-default btn-danger">Annuler<span class="glyphicon glyphicon-ok"></span></button>
                </td>	
            </tr>
        </table>	
    </form>
</fieldset>

</div>



