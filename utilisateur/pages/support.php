<h2 class="jumbotron text-muted text-center"> Contacter le support <i class="glyphicon glyphicon-eye-open"></i></h2>

<div class="jumbotron">

<section id="resultat"><?php if (isset($texte)) print $texte; ?></section>
<section id="leform">
    <form id="form_contact" action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
        <fieldset id="Client">
            <legend class="text-info">Renseignements</legend>
            <table id="tabContact">
                <tr>
                    <td>Votre sexe</td>
                    <td>Monsieur  <input type="radio" name="type" id="Homme" value="Homme" />                   
                        &nbsp;&nbsp;&nbsp;Madame
                        <input type="radio" name="type" id="Femme" value="Femme"/>                     
                    </td>
                </tr>
                <tr>
                <tr>
                    <td>Votre nom</td>
                    <td>
                        <?php if (isset($_SESSION['form']['nom_client'])) { ?>
                            <input type="text" name="nom_client" id="nom_client" value="<?php print $_SESSION['form']['nom_client']; ?>"/>
                            <?php
                        } else {
                            ?>
                            <input type="text" name="nom_client" id="nom_client" placeholder="Nom" required/>
                            <?php
                        }
                        ?>
         
                    </td>
                </tr>
                <tr>
                    <td>Votre prénom</td>
                    <td>
                        <?php if (isset($_SESSION['form']['pren_client'])) { ?>
                            <input type="text" name="pren_client" id="pren_client" value="<?php print $_SESSION['form']['pren_client']; ?>"/>
                            <?php
                        } else {
                            ?>
                            <input type="text" name="pren_client" id="pren_client" placeholder="Prénom" required/>
                            <?php
                        }
                        ?>
                  
                    </td>
                </tr>
                <tr>
                    <td>Votre commentaire</td>
                    <td>
                        <?php if (isset($_SESSION['form']['comm_client'])) { ?>
                            <textarea name="comm_client" id="comm_client" rows="5" cols="22" value="<?php print $_SESSION['form']['comm_client']; ?>"></textarea>
                            <?php
                        } else {
                            ?>
                            <textarea name="comm_client" id="comm_client" rows="5" cols="22" placeholder="Commentaire" required/> </textarea>
                            <?php
                        }
                        ?>
                   
                    </td>
                </tr>
                <tr>
                    <td>Votre mail</td>
                    <td>
                        <?php if (isset($_SESSION['form']['email'])) { ?>
                            <input type="email" name="email" id="email" value="<?php print $_SESSION['form']['email']; ?>"/>
                            <?php
                        } else {
                            ?>
                            <input type="email" name="email" id="email" placeholder="Email"/>
                            <?php
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit_reserv" class="btn btn-default btn-success" id="submit_reserv" value="Envoyer" />
                        &nbsp;&nbsp;&nbsp;
                        <input type="reset" id="reset" class="btn btn-default btn-danger" value="Remise à zéro du formulaire" />
                    </td>
                </tr>

            </table>
        </fieldset>
    </form>
</section>


<?php
if (isset($_GET['submit_reserv'])) {
    extract($_GET, EXTR_OVERWRITE);
    if (trim($type) != '' && trim($nom_client) != '' && trim($pren_client) != '' && trim($comm_client) != '' && trim($email) != '') {
        $mg2 = new contactManager($db);
        $retour = $mg2->addContact($_GET);
        if ($retour == 1) {
            $texte = "<span class='text-danger'>Demande enregistrée.</span>";
            echo $text;
        }
        if (isset($_SESSION['form'])) {
            unset($_SESSION['form']);
        }
    } 
}
?>