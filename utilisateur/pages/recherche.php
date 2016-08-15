<h2 class="jumbotron text-muted"> Rechercher un jeu <i class="glyphicon glyphicon-search"></i></h2>
<div class="jumbotron">
    <?php
    if (isset($_GET['submitcatalogue'])) {
        extract($_GET, EXTR_OVERWRITE);
        if (trim($id_client) != '') {
            $mg2 = new achatManager($db);
            $retour = $mg2->getAchat($_GET);
            if ($retour == 1) {
                $texte = "<span class='text-info'>Votre demande a bien été enregistrée</span>";
                echo $text;
            }
            if (isset($_SESSION['form'])) {
                unset($_SESSION['form']);
            } else {
                $texte = "Complétez tous les champs.";
                if (trim($id_client) != '') {
                    $_SESSION['form']['id_client'] = $id_client;
                }
                echo $text;
            }
        }
    }

    if (isset($cat)) {
        ?>
        <form id="formachat" action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
            <table>
                <tr>
                    <td>Votre ID : </td>
                    <td>
                        <?php if (isset($_SESSION['form']['id_client'])) { ?>
                            <input type="text" name="id_client" id="id_client" value="<?php print $_SESSION['form']['id_client']; ?>"/>
                            <?php
                        } else {
                            ?>
                            <input type="text" name="id_client" id="id_client" placeholder="Votre identifiant" required/>
                            <?php
                        }
                        ?>
                        <div id="error"></div>
                    </td>
                </tr>
                <tr><td>Image</td><td>Titre</td><td>Prix</td><td>Nombre de joueurs</td><td>Genre</td><td>Developpeurs</td><td>Plateforme</td><td>Commander</td></tr>
                <?php
                for ($i = 0; $i < count($cat); $i++) {
                    $titre = $cat[$i]->titre;
                    $img="../admin/images/games/".$titre.".jpg";
                    $prix = $cat[$i]->prix;
                    $nj = $cat[$i]->nj;
                    $cat2 = $cat[$i]->cat;
                    $dev = $cat[$i]->dev;
                    $pl = $cat[$i]->pl;
                    $idj = $cat[$i]->idjeux;
                    $nom = "achat";
                    $id = "cc";
                    $ty = "radio";
                    print "<tr><td><img  id='check-img' src='{$image}' alt='{$titre}' /></td><td>{$titre}</td><td>{$prix}</td><td>{$nj}</td><td>{$cat2}</td><td>{$dev}</td><td>{$pl}</td><td><input type={$ty} name={$nom} id={$id} value={$idj}/></td></tr>";
                }
                ?>
                <tr> 
                    <td colspan="2">
                        <input type="submit" name="submitcatalogue" id="submitcatalogue" value="Acheter"/>
                    </td>
                </tr>

            </table>
        </form>
    <?php } ?>

    <?php if (!isset($cat)) { ?>
        <form id="form_rech" action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
            <fieldset id="recherche">
                <legend class="txtMauv txtGras">Rechercher par: </legend>
                <table>
                    <tr>
                        <td>Titre: </td>
                        <td><?php if (isset($_SESSION['form']['titre'])) { ?>
                                <input type="text" name="titre" id="titre" value="<?php print $_SESSION['form']['titre']; ?>"/>
                                <?php
                            } else {
                                ?>
                                <input type="text" name="titre" id="titre" placeholder="Titre"/>
                                <?php
                            }
                            ?>
                            <div id="error"></div>
                        </td>
                    </tr>

                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit_recherche" class="btn btn-default btn-success" id="submit_recherche" value="Recherche" />
                            &nbsp;&nbsp;&nbsp;
                            <input type="reset" id="reset" class="btn btn-danger" value="Annuler" />
                        </td>
                    </tr>

                </table>
            </fieldset>
        </form>
    </div>
<?php } ?>
<section id="resultat" class="text-success"><?php if (isset($q)) print $q; ?></section>



<?php
if (isset($_POST['submit_recherche'])) {
    extract($_GET, EXTR_OVERWRITE);
    $r = new rechmanager($db);
    if (trim($titre) != '') {

        $cat = $r->getjeuxt($titre);
    } else
        alert('champs vide');
}
?>