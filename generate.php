<?php 
include './conn.php';
require_once('tcpdf.php');

if (isset($_GET['generate'])) {
	$InvoiceNo=$_GET['InvoiceNo'];
	$select="SELECT * FROM orders WHERE invoice_no= '$InvoiceNo' ";
	$stmt=$con->prepare($select);
    $stmt->execute();
    $result=$stmt->get_result();

	while($row=$result->fetch_assoc()){
               $name= $row['name'];
               $phone= $row['phone'];
               $address= $row['address'];
               $products= $row['products'];
                $amount= $row['amount'];
                 $date= $row['order_date'];
                 $pmode= $row['pmode'];
                 $InvoiceNo= $row['invoice_no'];
                 $status= $row['delivery_status'];


}	
}
/**
 * 
 */
class PDF extends TCPDF
{
	public function Header(){
       $imageFile= K_PATH_IMAGES.'liquoricon.png';
       $this->Image($imageFile, 40,10,30,'','PNG','','T', false,300,'',false, false, 0,false,false,false);
       $this->Ln(5); //font name size
       $this->SetFont('helvetica','B',14);
       $this->Cell(189,5,'QUEST LIQUOR STORE',0,1,'C'); 
         $this->SetFont('helvetica','',8);
         $this->Cell(189,3,'Roysambu, Pavillion Road',0,1,'C'); 
         $this->Cell(189,3,'10500, Nairobi',0,1,'C');
           $this->Cell(189,3,'Phone: +254 702648480',0,1,'C');
            $this->Cell(189,3,'Email- questliquorstoreke@gmail.com',0,1,'C');
            $this->SetFont('helvetica','B',14);
             $this->Ln(2);
            $this->Cell(189,3,'REPORT SALES ORDER',0,1,'C');
}

	}
    
 
// create new PDF document
$pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('QUEST LIQUOR STORE');
$pdf->SetTitle('SALES ORDER');
$pdf->SetSubject('');
$pdf->SetKeywords('');
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}


// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

$pdf->Ln(18);
$pdf->SetFont('times','B',12);
$pdf->Cell(189,3,'Report as on :- '.$date,0,1,'C');
$pdf->Ln(5);

$pdf->SetFont('times','B',12);
$pdf->Cell(130,3,'To :- '.$name,0,0);
$pdf->Cell(59,5,'Invoice No: '.$InvoiceNo,0,2);
$pdf->Ln(5);


$pdf->Cell(130,5,'Mobile No: '.$phone,0,0);
$pdf->Cell(59,5,'Payment Method: '.$pmode,0,2);
$pdf->Ln(5);


$pdf->Cell(130,5,'Delivery Address: '.$address,0,0);
$pdf->Cell(59,5,'Delivery Status: '.$status,0,2);
$pdf->Ln(8);
$pdf->SetFont('times','B',12);
$pdf->Cell(189,5,'The Following Products were Purchased:',0,2);
$pdf->Ln(8);
$pdf->setFillColor(224, 235, 255);
$pdf->Cell(130,5,'Products',1,0,'C',1);
$pdf->Cell(50,5,'Total Amount',1,0,'C',1);
$pdf->Ln(5.5);
$pdf->Cell(130,4,$products,1,0,'C');
$pdf->Cell(50,4,$amount,1,0,'C');



// Close and output PDF document
$pdf->Output('example_001.pdf', 'I');


 ?>