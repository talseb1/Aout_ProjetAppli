<h2 class="jumbotron text-center"> Création d'un compte <i class="text-info glyphicon glyphicon-user"></i> </h2>


<div class="jumbotron text-info">
    <section id="resultat"><?php if (isset($texte)) print $texte; ?></section>
    <section id="leform">
        <form id="form_ccompte" action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
            <fieldset id="Client">
                <legend class="text-info">Renseignements personnel</legend>
                <table id="formCpte">
                    <tr>
                        <td>Votre nom</td>
                        <td>
                            <?php if (isset($_SESSION['form']['nom_cc'])) { ?>
                                <input type="text" name="nom_cc" id="nom_cc" value="<?php print $_SESSION['form']['nom_cc']; ?>"/>
                                <?php
                            } else {
                                ?>
                                <input type="text" name="nom_cc" id="nom_cc" placeholder="Nom" required/>
                                <?php
                            }
                            ?>

                        </td>
                    </tr>
                    <tr>
                        <td>Votre prénom</td>
                        <td>
                            <?php if (isset($_SESSION['form']['pren_cc'])) { ?>
                                <input type="text" name="pren_cc" id="pren_cc" value="<?php print $_SESSION['form']['pren_cc']; ?>"/>
                                <?php
                            } else {
                                ?>
                                <input type="text" name="pren_cc" id="pren_cc" placeholder="Prénom" required/>
                                <?php
                            }
                            ?>

                        </td>
                    </tr>
                    <tr>
                        <td>Votre adresse</td>
                        <td>
                            <?php if (isset($_SESSION['form']['adresse_cc'])) { ?>
                                <input type="text" name="adresse_cc" id="adresse_cc" value="<?php print $_SESSION['form']['adresse_cc']; ?>"/>
                                <?php
                            } else {
                                ?>
                                <input type="text" name="adresse_cc" id="adresse_cc" placeholder="Adresse" required/>
                                <?php
                            }
                            ?>

                        </td>
                    </tr>


                    <tr>
                        <td>Votre ville</td>
                        <td>
                            <?php if (isset($_SESSION['form']['ville_cc'])) { ?>
                                <input type="text" name="ville_cc" id="ville_cc" value="<?php print $_SESSION['form']['ville_cc']; ?>"/>
                                <?php
                            } else {
                                ?>
                                <input type="text" name="ville_cc" id="ville_cc" placeholder="Ville" required/>
                                <?php
                            }
                            ?>

                        </td>
                    </tr>

                    <tr>
                        <td>Code postal</td>
                        <td>
                            <?php if (isset($_SESSION['form']['cp_cc'])) { ?>
                                <input type="text" name="cp_cc" id="cp_cc" value="<?php print $_SESSION['form']['cp_cc']; ?>"/>
                                <?php
                            } else {
                                ?>
                                <input type="text" name="cp_cc" id="cp_cc" placeholder="Code postal" required/>
                                <?php
                            }
                            ?>

                        </td>
                    </tr>

                    <tr>
                        <td>Votre pays</td>
                        <td>
                            <?php if (isset($_SESSION['form']['pays_cc'])) { ?>
                                <input type="text" name="pays_cc" id="pays_cc" value="<?php print $_SESSION['form']['pays_cc']; ?>"/>
                                <?php
                            } else {
                                ?>
                                <input type="text" name="pays_cc" id="pays_cc" placeholder="Pays" required/>
                                <?php
                            }
                            ?>

                        </td>
                    </tr>

                    <tr>
                        <td>Votre téléphone</td>
                        <td>
                            <?php if (isset($_SESSION['form']['num_cc'])) { ?>
                                <input type="tel" name="num_cc" id="num_cc" value="<?php print $_SESSION['form']['num_cc']; ?>"/>
                                <?php
                            } else {
                                ?>
                                <input type="tel" name="num_cc" id="num_cc" placeholder="Numero de téléphone" required/>
                                <?php
                            }
                            ?>

                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit_ccompte" class="btn btn-default btn-success"id="submit_ccompte" value="S'enregistrer" />
                            &nbsp;&nbsp;&nbsp;
                            <input type="reset" id="reset"  class="btn btn-default btn-danger" value="Annuler" />
                        </td>
                    </tr>

                </table>
            </fieldset>
        </form>
    </section>
</div>


<?php
if (isset($_GET['submit_ccompte'])) {
    extract($_GET, EXTR_OVERWRITE);
    if (trim($nom_cc) != '' && trim($pren_cc) != '' && trim($adresse_cc) != '' && trim($ville_cc) != '' && trim($cp_cc) != '' && trim($pays_cc) != '' && trim($num_cc) != '') {
        $mg2 = new creercompteManager($db);
        $retour = $mg2->addClient($_GET);
        if ($retour >= 0) {
            $texte = "<span class='text-danger'>Demande enregistrée.</span>";
            echo $texte;
        }
        if (isset($_SESSION['form'])) {
            unset($_SESSION['form']);
        }
    }
}
?>