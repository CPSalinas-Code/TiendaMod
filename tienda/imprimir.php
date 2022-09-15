<?php
require('./fpdf/fpdf.php');
include "php/conection.php";

session_start();
$pdf=new FPDF();
$pdf->SetFont('Times','',14);
$pdf->SetTextColor(3, 3, 3);
$pdf->AddPage();
$total=0;
$pdf->SetXY(20,20);
$pdf->Cell(160,40, $pdf->Image('store/logo.jpg', $pdf->GetX(),$pdf->GetY()));
//$pdf->Image('/store/logo.png',10,8,120);

//$pdf->Cell(160,40,"Cliente: ".$_SESSION['clientefac'],1,true);  
$pdf->SetXY(20,80);
$pdf->Cell(160,10,"Cliente: ".$_SESSION['clientefac'],1,true);
$pdf->SetXY(20,90);
$pdf->Cell(160,10,"Correo Electronico: ".$_SESSION['correofac'],1,true);
$pdf->SetXY(20, 100);
$pdf->SetFillColor(208, 211, 212 );
$pdf->Cell(80,10,"Cantidad",1,0,"L",true);
$pdf->Cell(30,10,"Producto",1,0,"L",true);
$pdf->Cell(20,10,"P.Unit",1,0,"L",true);
$pdf->Cell(30,10,"Total",1,1,"L",true);


                            
foreach ($_SESSION["cart"] as $c){
        $p = $con->query("select * from product where id=$c[product_id]");
        $r = $p->fetch_object();
        $pdf->SetX(20);
        $pdf->Cell(80,10,$r->name,1,0,"L");
        $pdf->Cell(30,10,$c["q"],1,0,"C");
        $pdf->Cell(20,10,number_format($r->price,2),1,0,"C");
        $pdf->Cell(30,10,number_format($c["q"]*($r->price),2),1,1,"R");
        $r->price;
        $total = $r->price*$c["q"] + $total;
}
$pdf->SetX(100);
$pdf->Cell(50,10,"Total:",1,0,"C");
$pdf->Cell(30,10,number_format($total),1,1,"R");

$doc = $pdf->Output('', 'S');
// haciendo referencia a la clase phpmailer



//DESDE AQUI VALE PITO COMO EL PAUL !!!!
require_once('phpmailer/class.phpmailer.php');
require_once('phpmailer/class.smtp.php');

$mail = new PHPMailer();

$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com';
$mail->Username = 'paobel0206@gmail.com';
$mail->Password = 'rjenwcirxpdnvziz';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

//From email address and name
$mail->From = "paobel0206@gmail.com";
$mail->FromName = "El Cajas";
$mail->AddReplyTo('paobel0206@gmail.com', 'Reply address');
$mail->AddAddress('emily.artegar@gmail.com', 'Cliente'); //Aqui va la direccion del cliente !!!!!!!!!!!!!!!

$mail->Subject = "Factura";
$mail->Body = "Factura de comora";
$mail->AltBody = "This is the plain text version of the email content";

$mail->AddStringAttachment($doc, 'file.pdf', 'base64', 'application/pdf');// attachment
if(!$mail->send()) 
{
    echo "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
    echo "Message has been sent successfully";
}
