<!doctype html>
<?php
//INDEX ADMIN
include ('./lib/php/liste_include.php');
$db = Connexion::getInstance($dsn, $user, $pass);
session_start();
$styles = array();
$i2 = 0;
foreach (glob('./lib/css/*.css') as $css) {
    $styles[$i2] = $css;
    $i2++;
}
$scripts = array();
$i = 0;
foreach (glob('./lib/css/bootstrap/js/*.js') as $js) {
    $fichierJs[$i] = $js;
    $i++;
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>TShop - Online || Admin</title>
        <link rel="stylesheet" type="text/css" href="./lib/css/bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="./lib/css/p_style.css"/>
        <?php
        foreach ($styles as $css) {
            ?><link rel="stylesheet" type="text/css" href="<?php print $css; ?>"/>
            <?php
        };
        ?>
        <?php
        foreach ($fichierJs as $js) {
            ?><script type="text/javascript" src="<?php print $js; ?>"></script>
            <?php
        }
        ?>
<!-- jQuery library-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="./lib/js/fonctionsJqueryAdmin.js"></script> 
    </head>
    <body>
        <section>              
            <header id="header">
                <nav class="nav navbar-nav navbar-right bg-danger"> 

                    <?php
                    if (isset($_SESSION['admin'])) {
                        ?><a href="./lib/php/disconnect.php" class="bDec">Déconnexion</a>
                        <?php
                    }
                    ?>
                </nav>
          
            </header>
        </section>
            <p><br><br><br><br><br></p>
            <div class="container">
                <?php if (!isset($_SESSION['admin'])) {
                    ?>
                    <section id="login_form">
                        <?php
                        require './pages/authentification.php';
                        ?> </section><?php
                } else {
                    ?>
                    <section>
                        <ul>

                            <?php
                            if (file_exists('./lib/php/menu.php')) {
                                include ('./lib/php/menu.php');
                            }
                            ?>
                    </ul>
                    </section>

                    <section>
                        <div class="jumbotron">
                            <?php
                            if (!isset($_SESSION['page'])) {
                                $_SESSION['page'] = "accueil";
                            }
                            if (isset($_GET['page'])) {
                                $_SESSION['page'] = $_GET['page'];
                            }
                            $chemin = './pages/' . $_SESSION['page'] . '.php';
                            if (file_exists($chemin)) {

                                include ($chemin);
                            }
                            ?>                      
                        </div>

                    </section>
                    <?php
                }
                ?>
            </div>
            <div class="modal-footer navbar navbar-default navbar-fixed-bottom">
            <?php
            require './lib/php/footer.php';
            ?>
             </div>   
    </body>
</html>
