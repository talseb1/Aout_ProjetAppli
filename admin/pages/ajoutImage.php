<?php
$uploadLocation = "./images/games/";
//Unix, Linux way
//$uploadLocation = "\tmp";

?>  
<h2 class="text-muted text-center">Ajouter une image <i class="text-danger glyphicon glyphicon-picture"></i></h2>

<div  id="global">
    <div id="gauche"class="left">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="fileForm" id="fileForm" enctype="multipart/form-data">
          <legend>Upload d'image</legend>
        <table>
          <tr><td><input name="upfile" type="file" size="36"></td></tr>
          <tr><td>&nbsp;</td></tr>
          <tr><td><input class="btn-success center-block" type="submit" name="submitBtn" value="Envoyé"></td></tr>
        </table></center>  
      </form>
<?php    
    if (isset($_POST['submitBtn'])){

?>
      <div class="text-info text-uppercase" id="caption">Etat :</div>
      <div id="icon2">&nbsp;</div>
      <div class="text-success"id="result">
        <table>
<?php

$target_path = $uploadLocation . basename( $_FILES['upfile']['name']);
$basename="./images/games/".basename( $_FILES['upfile']['name']);
$flag=0;
if(move_uploaded_file($_FILES['upfile']['tmp_name'], $target_path)) {
    echo "Le fichier : ".  basename( $_FILES['upfile']['name']).
    " à été enregistré! <br>" ;
    $flag=1;

} else{
    $flag=0;
    echo "Un erreur est survenue, veuillez rééssayer!";
    
    
}

?>
        </table>
 </div>
     </div>
    <?php if($flag==1){
      ?>  <div id="droite"class="img-thumbnail"><?php
 
     echo "<p>Aperçu : ";
     ?><br><img  id="check-img" align="top"class="img-thumbnail" src="<?php print $basename;?>" alt="vignette" /></p></div><?php 
    }
    ?>
<?php            
    }
?>
    
    
    </div>


