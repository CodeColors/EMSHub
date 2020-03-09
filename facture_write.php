<?php
require('lib/fpdf.php');

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm
if(!isset($_POST['submit'])){
    header('Location: index.php');
}

$CURDATE = date('d-m-Y');
$total = 0;

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )
$pdf->Image("img/logo.jpg", null,null,50,15, "jpg");
$pdf->Cell(130	,5,'',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130	,5,'Strawberry Avenue',0,0);
$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->Cell(130	,5,'Los Santos',0,0);
$pdf->Cell(25	,5,'Date',0,0);
$pdf->Cell(34	,5,$CURDATE,0,1);//end of line

$pdf->Cell(130	,5,'Phone [911]',0,0);
$pdf->Cell(25	,5,'Facture #',0,0);
$pdf->Cell(34	,5,$_POST['facture'],0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//billing address
$pdf->Cell(100	,5,'Information du patient',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,'Nom du patient : '.$_POST['nom'],0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,'Telephone : '.$_POST['tel'],0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(130	,5,'Intitule',1,0);
$pdf->Cell(25	,5,'Quantite',1,0);
$pdf->Cell(34	,5,'Montant',1,1);//end of line

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter
if(!empty($_POST['ope'])){
    $pdf->Cell(130	,5,'Operation',1,0);
    $pdf->Cell(25	,5,'-',1,0);
    $pdf->Cell(34	,5,'10000',1,1,'R');
    
    $total = $total + 10000;
}
//end of line
if(!empty($_POST['sca'])){
    $pdf->Cell(130	,5,'Scanner',1,0);
    $pdf->Cell(25	,5,'-',1,0);
    $pdf->Cell(34	,5,'2000',1,1,'R');
    
    $total = $total + 2000;
}
if(!empty($_POST['dia'])){
    $pdf->Cell(130	,5,'Diagnostic',1,0);
    $pdf->Cell(25	,5,'-',1,0);
    $pdf->Cell(34	,5,'500',1,1,'R');
    
    $total = $total + 500;
}
if(!empty($_POST['gro'])){
    $pdf->Cell(130	,5,'Soin lourd',1,0);
    $pdf->Cell(25	,5,'-',1,0);
    $pdf->Cell(34	,5,'3000',1,1,'R');
    
    $total = $total + 3000;
}
if(!empty($_POST['pet'])){
    $pdf->Cell(130	,5,'Soin leger',1,0);
    $pdf->Cell(25	,5,'-',1,0);
    $pdf->Cell(34	,5,'1000',1,1,'R');
    
    $total = $total + 1000;
}
if(!empty($_POST['a'])){
    $pdf->Cell(130	,5,'Transport Zone A',1,0);
    $pdf->Cell(25	,5,'-',1,0);
    $pdf->Cell(34	,5,'500',1,1,'R');
    
    $total = $total + 500;
}
if(!empty($_POST['b'])){
    $pdf->Cell(130	,5,'Transport Zone B',1,0);
    $pdf->Cell(25	,5,'-',1,0);
    $pdf->Cell(34	,5,'1000',1,1,'R');
    
    $total = $total + 1000;
}
if(!empty($_POST['c'])){
    $pdf->Cell(130	,5,'Transport Zone C',1,0);
    $pdf->Cell(25	,5,'-',1,0);
    $pdf->Cell(34	,5,'3500',1,1,'R');
    
    $total = $total + 3500;
}
if(!empty($_POST['cha'])){
    $pdf->Cell(130	,5,'Charge Helicoptere',1,0);
    $pdf->Cell(25	,5,'-',1,0);
    $pdf->Cell(34	,5,'3000',1,1,'R');
    
    $total = $total + 3000;
}//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Montant total',0,0);
$pdf->Cell(4	,5,'$',1,0);
$pdf->Cell(30	,5,$total,1,1,'R');//end of line





















$pdf->Output();
?>

<html>
    <head>
        <title>EMS - Facture de <?php echo $_POST['nom']; ?></title>
    </head>
</html>