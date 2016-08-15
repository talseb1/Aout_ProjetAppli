<h2 class="jumbotron text-center text-muted"> Catalogue de jeux <i class="glyphicon glyphicon-book"></i> </h2>
<div class="jumbotron">
<section id="resultat" class="text-success"><?php if(isset($texte)) print $texte; ?></section>
<form id="formachat" action="<?php print $_SERVER['PHP_SELF'];?>" method="get">
<table class="table-striped table-condensed">
     <tr>
         <?php
            $cm=new catManager($db);
            $cat=$cm->getCat($_GET);
         ?>
                <td>Votre ID : </td>
                <td>
                    <?php if(isset($_SESSION['form']['id_client'])) { ?>
                        <input type="text" name="id_client" id="id_client" value="<?php print $_SESSION['form']['id_client'];?>"/>
                    <?php
                    }
                    else {
                        ?>
                        <input type="text" name="id_client" id="id_client" placeholder="Votre identifiant" required/>
                        <?php
                    }
                    ?>
                        <div id="error"></div>
                </td>
            </tr>
            <tr><td >Image</td><td>Titre</td><td>&nbsp;</td><td>Prix</td><td>&nbsp;</td><td>Nbre joueurs</td><td>&nbsp;</td><td>Genre</td><td>&nbsp;</td><td>Developpeurs</td><td>&nbsp;</td><td>Plateforme</td><td>&nbsp;</td><td>Commander</td></tr>
<?php
    for($i=0;$i<count($cat);$i++)
    {
        
        $titre=$cat[$i]->titre;
        $image="../admin/images/games/".$titre.".jpg";
        $prix=$cat[$i]->prix;
        $nj=$cat[$i]->nj;
        $cat2=$cat[$i]->cat;
        $dev=$cat[$i]->dev;
        $pl=$cat[$i]->pl;
        $idj=$cat[$i]->idjeux;
        $nom="achat";
        $id="cc";
        $ty="radio";
        print "<tr><td><img  id='check-img' src='{$image}' alt='{$titre}' /></td><td>{$titre}</td><td>&nbsp;</td><td>{$prix}</td><td>&nbsp;</td><td>{$nj}</td><td>&nbsp;</td><td>{$cat2}</td><td>&nbsp;</td><td>{$dev}</td><td>&nbsp;</td><td>{$pl}</td><td>&nbsp;</td><td><input type={$ty} name={$nom} id={$id} value={$idj}/></td></tr>";
    }
?>

</table>
    <div class="text-center center-block">
        
<input type="submit" name="submitcatalogue" class="btn btn-default btn-success" id="submitcatalogue" value="Acheter"/>                    
<a class="btn btn-default " href="index.php?page=catalogue"> <img src="../admin/images/pdf.png" alt="PDF"/>Telecharger le catalogue</a>
    </div>
    
</form>
</div>

<?php
if(isset($_GET['submitcatalogue'])) {
    extract($_GET,EXTR_OVERWRITE);
    echo 'id_client : + $id_client + achat: + $achat';
      if(trim($id_client)!='')
	  {	  
            $mg2 = new achatManager($db);
            $retour = $mg2->getAchat($_GET);  
            if($retour==1)
            {
                $texte="<span class='text-success'>Votre demande a bien été enregistrée</span>";
            }
			if(isset($_SESSION['form'])) {unset($_SESSION['form']);}
            else
            {
                $texte="Complétez tous les champs.";
                if(trim($id_client)!='') {$_SESSION['form']['id_client']=$id_client;}
                
            }
        }
	}
?>