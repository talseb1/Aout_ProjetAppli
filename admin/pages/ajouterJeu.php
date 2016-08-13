<?php
require './lib/php/verifier_connexion.php';
?>
<h2 class="text-muted text-center">Ajouter un jeu <i class="text-danger glyphicon glyphicon-console"></i></h2>
<section id="resultat" class="text-success"><?php if (isset($texte)) print $texte; ?></section>
<section id="leform">
    <form id="form_ajout_jeu" action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
        <fieldset id="Client">
            <legend>Nouveau jeu : </legend>
            <table class="text-info text">

                <tr>
                    <td>Titre : </td>
                    <td>
                        <?php if (isset($_SESSION['form']['Titre_jeu'])) { ?>
                            <input type="text" name="Titre_jeu" id="Titre_jeu" value="<?php print $_SESSION['form']['nom_client']; ?>"/>
                            <?php
                        } else {
                            ?>
                            <input type="text" name="Titre_jeu" id="Titre_jeu" placeholder="Titre du jeu" required/>
                            <?php
                        }
                        ?> <div id="error"></div>
                    </td>
                </tr>

                <tr>
                    <td>Prix : </td>
                    <td>
                        <?php if (isset($_SESSION['form']['Prix_jeu'])) { ?>
                            <input type="number" step="0.01" min="0" name="Prix_jeu" id="Prix_jeu" value="<?php print $_SESSION['form']['Prix_jeu']; ?>"/>
                            <?php
                        } else {
                            ?>
                            <input type="number" step="0.01" min="0" name="Prix_jeu" id="Prix_jeu" placeholder="Prix du jeu" required/>
                            <?php
                        }
                        ?> <div id="error"></div>
                    </td>
                </tr>

                <tr>
                    <td>Nombre de joueur :  </td>
                    <td><?php if (isset($_SESSION['form']['Joueur_jeu'])) { ?>
                            <input type="number" name="Joueur_jeu" id="Joueur_jeu" value="<?php print $_SESSION['form']['Joueur_jeu']; ?>" />
    <?php
} else {
    ?>
                            <input type="number" name="Joueur_jeu" id="Joueur_jeu" placeholder="Nombre de joueur du jeu" required/>
                            <?php
                        }
                        ?> <div id="error"></div>
                    </td>
                </tr>
                        <?php
                        $aj = new AjoutJeuManager($db);
                        $iddev = $aj->getDevId();
                        $dev = $aj->getDeveloppeur();
                        $idcat = $aj->getCategId();
                        $cat = $aj->getCateg();
                        $idpl = $aj->getPlateformeId();
                        $pl = $aj->getPLateform();
                        ?>
                <tr>
                    <td>D&eacuteveloppeur :  </td>
                    <td><select name="Developpeur_jeu">
<?php
for ($i = 0; $i < count($iddev); $i++) {
    $var = $iddev[$i]->iddev;
    $var2 = $dev[$i]->nomdev;
    print "<option value={$var}>{$var2}</option>";
}
?>
                            <!--rajouter les developpeur de la base de donnee-->
                        </select></td>
                </tr>

                <tr>
                    <td>Cat&eacutegorie : </td>
                    <td><select name="Categorie_jeu">
<?php
for ($i = 0; $i < count($idcat); $i++) {
    $var = $idcat[$i]->idcat;
    $var2 = $cat[$i]->genre;
    echo "<option value={$var}>{$var2}</option>";
}
?>
                            <!--ajouter les Categorie de la base de donnee-->
                        </select></td>									
                </tr>				

                <tr>
                    <td>Plateforme : </td>
                    <td><select name="Plateforme_jeu">
<?php
for ($i = 0; $i < count($idpl); $i++) {
    $var = $idpl[$i]->idplateforme;
    $var2 = $pl[$i]->nomplateforme;
    echo "<option value={$var}>{$var2}</option>";
}
?>
                            <!--ajouter les Plateforme de la base de donnee-->
                        </select></td>									
                </tr>	
                <tr>
                    <td colspan="2" class='bAth'>&nbsp; </td>

                </tr>
                
                <tr>

                    <td colspan="2">
                        <button type="submit" name="submit_jeu" id="submit_jeu" class="btn btn-default btn-success">Ajouter jeu <span class="glyphicon glyphicon-ok"></span></button>
                        <button type="reset" id="reset" class="btn btn-default btn-danger">Annuler<span class="glyphicon glyphicon-trash"></span></button>    

                    </td>
                </tr>
            </table> 
        </fieldset>
    </form>
</section>

<?php
if (isset($_GET['submit_jeu'])) {
    extract($_GET, EXTR_OVERWRITE);
    if (trim($Titre_jeu) != '' && trim($Prix_jeu) != '' && trim($Joueur_jeu) != '') {
        $mg2 = new AjoutJeuManager($db);
        $retour = $mg2->addjeu($_GET);
        if ($retour == 1) {
            echo "<span class='text-success'>Votre jeu a bien été enregistré.<br /></span>";
        } else if ($retour == 2) {
            echo"<span class='text-danger'>Jeu déja existant</span>";
        }
        if (isset($_SESSION['form'])) {
            unset($_SESSION['form']);
        }
    }
}
?>