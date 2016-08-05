<?php

if (!isset($_SESSION['admin'])) {
    print "Accès réservé";
    print "<meta http-equiv=\"refresh\": Content=\"2;url = ../index.php\">";
    exit();
}
?>