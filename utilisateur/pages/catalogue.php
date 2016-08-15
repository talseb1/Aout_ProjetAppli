<?php
require './lib/php/fpdf/fpdf.php';
require '../admin/lib/php/db_pg.php';
require '../admin/lib/php/classes/cat.class.php';
require '../admin/lib/php/classes/catManager.class.php';
$buffer = ob_get_clean();

$db = Connexion::getInstance($dsn, $user, $pass);


$mg = new catManager($db);
$data = $mg->getCat();

$pdf = new FPDF('L', 'cm', 'A4');
$pdf->AddPage();


$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetTextColor(255,0, 0);
$pdf->SetFont('Arial', 'B', 15);
$pdf->cell(3, 8, $pdf->Image('../admin/images/bann.png', 0, 0), 0, 0, 'L');
$pdf->Ln();
$pdf->cell(3.5, 1, 'TShop Catalogue - 2016', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Ln();

//entete tableau - ,true sert a mettre la cellule en couleur
$pdf->SetFillColor(0,0,0);
$pdf->cell(2,.7,'Image',1,0,'C',true);
$pdf->cell(5,.7,'Titre',1,0,'C',true);
$pdf->cell(3,.7,'Prix',1,0,'C',true);
$pdf->cell(3,.7,'Nombre de joueurs',1,0,'C',true);
$pdf->cell(3,.7,'Genre',1,0,'C',true);
$pdf->cell(5,.7,'Developpeurs',1,0,'C',true);
$pdf->cell(3,.7,'Plateforme',1,0,'C',true);
$pdf->Ln();

$pdf->SetTextColor(0,0,0);

for($i=0;$i<count($data);$i++) {
        
        $titre=$data[$i]->titre;
        $img="../admin/images/games/".$titre.".jpg";
        $prix=$data[$i]->prix;
        $nj=$data[$i]->nj;
        $cat2=$data[$i]->cat;
        $dev=$data[$i]->dev;
        $pl=$data[$i]->pl;
        
    $pdf->Cell( 2, .7, $pdf->Image($img, $pdf->GetX(), $pdf->GetY(), 2), 0, 0, 'L', false );
    $pdf->cell(5,.7,utf8_decode($titre),1,0,'C');
    $pdf->cell(3,.7,utf8_decode($prix),1,0,'C');

        $pdf->cell(3,.7,utf8_decode($nj),1,0,'C');

        $pdf->cell(3,.7,utf8_decode($cat2),1,0,'C');

        $pdf->cell(5,.7,utf8_decode($dev),1,0,'C');

        $pdf->cell(3,.7,utf8_decode($pl),1,0,'C');

        $pdf->Ln();

    
}


$pdf->Ln();
$pdf->cell(3.5, 1, 'Plus de renseignement sut TShop Online', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Ln();

$pdf->output();
?>