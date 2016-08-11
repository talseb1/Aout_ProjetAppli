    <!-- barre de navigation + bootstrap -->
    <div class="navbar-wrapper">
        

            <nav class="navbar navbar-default navbar-fixed-top">
                
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>    
                        </button>
                        <a class="navbar-brand bg-danger" href="index.php?page=accueil"><i class="glyphicon glyphicon-fire text-danger"></i>TSHOP Online</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class=""><a href="index.php?page=accueil">Accueil</a></li>
                            <li class=""><a href="index.php?page=jeux">Jeux</a></li>
                            <li><a href="index.php?page=support">Contactez nous !</a></li>
                        </ul>
                        
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="index.php?page=addcompte">S'enregistrer</a></li>
                                                       
                            <li>
                                <form class="navbar-form" role="search">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Recherche" name="q" maxlength="10">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                        </div>
                                    </div>
                                </form
                            </li>
                        </ul>
                    </div>
                
            </nav>

        </div>

<?php
if (isset($_POST['submit_login'])) {
    $mg = new SeConnecter($db);
    $retour = $mg->estAdmin($_POST['login'], $_POST['password']);
    if ($retour == 1) {
        $_SESSION['admin'] = 1;
        $message = "Authentifié!";
        header('Location: http://localhost/ProjetWebFinal2/admin/index.php');
    } else {
        $message = $retour;
        $message = "Données non connues de notre systeme. Pour nous contacter passé par le formulaire contact en cliquant sur 'Annuler'";
    }
}
?>