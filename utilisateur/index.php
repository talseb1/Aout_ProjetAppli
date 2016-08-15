<!DOCTYPE html>
<?php
include ('./lib/php/Jliste_include.php');
$db = connexion::getInstance($dsn, $user, $pass);
session_start();
$styles = array();
$i2 = 0;
foreach (glob('../admin/lib/css/*.css') as $css) {
    $styles[$i2] = $css;
    $i2++;
}
$scripts = array();
$i = 0;
foreach (glob('../admin/lib/css/bootstrap/js/*.js') as $js) {
    $fichierJs[$i] = $js;
    $i++;
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TShop : Achat de Jeux vidéo</title>
        <link href="../admin/lib/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../admin/lib/css/css/p_style.css" rel="stylesheet">
        <link href="./lib/css/carousel.css" rel="stylesheet">
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
        <script type="text/javascript" src="../admin/lib/js/fonctionsJqueryAdmin.js"></script> 
        <script type="text/javascript" src="../admin/lib/js/fonctionsJquery.js"></script> 
    </head>


    <body>
        <section id="tophead">
            <div class="navbar-default navbar-wrapper  navbar-fixed-top">
                <?php
                if (file_exists('./lib/php/Jmenu.php')) {
                    include ('./lib/php/Jmenu.php');
                }
                ?>
            </div>
        </section>

        <p><br><br><br></p>


        <section>
            <div class="container">
                <?php
                //arrivee sur le site 
                if (!isset($_SESSION['page'])) {
                    $_SESSION['page'] = "accueil";
                }  //choix parmi le menu
                if (isset($_GET['page'])) {
                    $_SESSION['page'] = $_GET['page'];
                }
                $_SESSION['page'] = './pages/' . $_SESSION['page'] . '.php';
                if (file_exists($_SESSION['page'])) {
                    include ($_SESSION['page']);
                } else {
                    $_SESSION['page'] = './pages/deadlink.php';
                    include ($_SESSION['page']);
                }
                ?>
            </div>
        </section>         

        <div class="modal-footer navbar navbar-default navbar-fixed-bottom">
            <?php
            require './lib/php/footer.php';
            ?>
        </div>  


    </body>
</html>
