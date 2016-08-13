<?php
require './lib/php/verifier_connexion.php'; 
?>
<h2 class="text-muted text-center">Ajouter un développeur <i class="text-danger glyphicon glyphicon-user"></i></h2>

<section id="resultat" class="text-success"><?php if(isset($texte)) print $texte; ?></section>
<!--creer une table contact afin de mettre ces données dans la DB ?-->
<section id="leform">
    <form id="form_ajout_dev" action="<?php print $_SERVER['PHP_SELF'];?>" method="get">
        <fieldset id="Dev">
        <legend>Renseignements sur le développeur : </legend>
        <table class="text-info">
            <tr>
                <td>Nom du développeur : </td>
                <td>
                    <?php if(isset($_SESSION['form']['Nom_dev'])) { ?>
                        <input type="text" name="Nom_dev" id="Nom_dev" value="<?php print $_SESSION['form']['Nom_dev'];?>"/>
                    <?php
                    }
                    else {
                        ?>
                        <input type="text" name="Nom_dev" id="Nom_dev" placeholder="Nom du developpeur" required/>
                        <?php
                    }
                    ?>
                        <div id="error"></div>
                </td>
            </tr>
          
            <tr>
                <td>Pays du développeur : </td>
                <td><?php if(isset($_SESSION['form']['Pays_dev'])) { ?>
                        <input type="text" name="Pays_dev" id="Pays_dev" value="<?php print $_SESSION['form']['Pays_dev'];?>"/>
                    <?php
                    }
                    else {
                        ?>
                        <input type="text" name="Pays_dev" id="Pays_dev" placeholder="Pays du developpeur" required/>
                        <?php
                    }
                    ?>
                        <div id="error"></div>
                </td>
            </tr>
             <tr>
                <td colspan="2" class='bAth'>&nbsp; </td>

            </tr>
                       
            <tr>
                <td colspan="2">
                <button type="submit" name="submit_dev" id="submit_jeu" class="btn btn-default btn-success">Ajouter développeur <span class="glyphicon glyphicon-ok"></span></button>
                <button type="reset" id="reset" class="btn btn-default btn-danger">Annuler<span class="glyphicon glyphicon-trash"></span></button>        
                </td>
            </tr>
        </table>
        </fieldset>
    </form>
</section>



<?php

if(isset($_GET['submit_dev'])) {
    
    extract($_GET,EXTR_OVERWRITE);
    if( trim($Nom_dev)!='' && trim($Pays_dev)!='') {
        $mg2 = new AjoutDevManager($db);
        $retour = $mg2->addDev($_GET);
        if($retour==1){
            echo "<span class='text-success'>Developpeur bien ajouté !<br /></span>";
        }
        else if ($retour==2) {
            echo "<span class='text-danger'>Déja existant</span>";
        }    
        if(isset($_SESSION['form'])) {unset($_SESSION['form']);}                
    }
    
}
?>