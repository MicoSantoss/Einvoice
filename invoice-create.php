<?php

session_start();

    if(isset($_POST["submit"])){
    $customerId = $_SESSION['customerId'];
    $customerName = $_POST["customerName"];
    $customerAdd = $_POST["customerAdd"];
    $customerNo = $_POST["customerNo"];
    $customerStatus = $_POST['customerStatus'];
    $sellerId = $_SESSION['userId'];

    require_once 'dbh.php';
    require_once 'inventory-functions.php';

    if(emptyInputProduct($customerName, $customerAdd, $customerNo) !== false){
        header("location: invoice-init.php?error=emptyinput");
        exit();
    }

    //customer sql
    $custsql = "SELECT * FROM customers WHERE customerId='".$customerId."';";
    $custresult = mysqli_query($conn, $custsql);
    $custrow = mysqli_fetch_assoc($custresult);
    $custstatus = $custrow['customerStatus'];


    //inventory sql
    $sql = "SELECT * FROM inventorytemp WHERE sellerId='".$sellerId."';";
    $result = mysqli_query($conn, $sql);

    //usersql

    $usersql = "SELECT * FROM users WHERE usersId='".$sellerId."';";
    $userresult = mysqli_query($conn, $usersql);

    $row = mysqli_fetch_assoc($userresult);
    $username = $row['usersUid'];
    $userAdd = $row['usersAdd'];
    $userDesc = $row['usersDesc'];
    $userEmail = $row['usersEmail'];
    $userQr = $row['qrcode'];



    $rowsql = "SELECT * FROM receipt WHERE sellerId = '$sellerId';";
    $rowresult = mysqli_query($conn, $rowsql);
	$resultCheck = mysqli_num_rows($rowresult);

    $invoiceNo = $resultCheck + 1;


    $date = date('m/d/y H:i:s');
    $newdate = new DateTime($date);
    $dateresult = $newdate->format('Y-m-d');

    $time = date('H:i:s');
    $newtime = new DateTime($time);
    $timeresult = $newtime->format('H:i:s');


    $subtotal = 0.00;


    require_once 'fpdf/fpdf.php';
    $pdf = new FPDF();

	$pdf->AddPage();
	$pdf->SetFont('Arial','',12);

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(255,255,255);
//Cell(width , height , text , border , end line , [align] )
$pdf->Cell(190	,10,'EASY INVOICE',1,1,'C', true);//end of line
//$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->SetTextColor(0);
$pdf->SetFont('Arial','',14);
$pdf->MultiCell(190 ,7,$username.'
Date: '.$dateresult.'
Invoice No: '.$invoiceNo.'
Address: '.$userAdd.'
Email: '.$userEmail,1,0);
//$pdf->Cell(130	,5,$username,0,0);

//$pdf->Cell(59	,5,'',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',14);

//$pdf->Cell(130	,5,$userDesc,0,0);
//$pdf->Cell(59	,5,'',0,1);//end of line

//$pdf->SetFont('Arial','',12);
//$pdf->Cell(130	,5,$userAdd,0,0);
//$pdf->Cell(30	,5,'Date',0,0);
//$pdf->Cell(34	,5,$dateresult,0,1);//end of line

//$pdf->Cell(130	,5,'Email:'.$userEmail,0,0);
//$pdf->Cell(30	,5,'Invoice No:',0,0);
//$pdf->Cell(34	,5,$invoiceNo,0,1);//end of line


$pdf->Cell(95	,10,'Bill to:',1,0);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(95	,10,$customerName,1,1);//end of line

$pdf->SetFont('Arial','',14);
$pdf->Cell(95	,10,'Customer ID:',1,0);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(95	,10,$customerId,1,1);

$pdf->SetFont('Arial','',14);
$pdf->Cell(95	,10,'Customer Contact:',1,0);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(95	,10,$customerNo,1,1);
//$pdf->Cell(34	,5,$customerId,0,1);//end of line

$pdf->SetFont('Arial','B',14);
$pdf->MultiCell(190	,7,'Customer Address:
'.$customerAdd,1,1);


$pdf->SetFont('Arial','',14);
$pdf->Cell(95	,10,'Mode of Payment:',1,0);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(95	,10,$customerStatus,1,1);//end of line

$statusdump = 'Cash on Delivery';

if ($customerStatus != $statusdump){
    $pdf->Cell(190, 40, $pdf->Image('qrcodes/'.$userQr, 82, 110, 45), 1, 1, 'L', false );
}

/*

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,5,'',0,1);//end of line

//billing address
$pdf->Cell(100	,5,'Bill to:',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->SetFont('Arial','B',12);
$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5, $customerName ,0,1);

$pdf->SetFont('Arial','',12);
$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$customerAdd,0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$customerNo,0,0);
$pdf->Cell(130	,5,'Gcash/E-wallet',0,1);

$pdf->Image('qrcodes/'.$userQr, 140, 50, 50);*/

//make a dummy empty cell as a vertical spacer
//$pdf->Cell(189	,10,'',0,1);//end of line
//$pdf->Cell(189	,10,'',0,1);

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(80.5	,7,'Description',1,0);
$pdf->Cell(36.5	,7,'Quantity',1,0, 'C');
$pdf->Cell(36.5	,7,'Price',1,0, 'C');
$pdf->Cell(36.5	,7,'Amount',1,1, 'C');//end of line

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter


while($row = mysqli_fetch_assoc($result)){
    $productId = $row['productId'];
    $productName = $row['productName'];
    $productPrice = $row['productPrice'];
    $initPrice = $row['initPrice'];
    $productQuan = $row['productQuan'];
    settype($temp, 'integer');
    //$subtotal = $productPrice+$temp;
    $subtotal += $productPrice;


    $pdf->Cell(80.5	,7,$productName,1,0);
    $pdf->Cell(36.5	,7,$productQuan,1,0, 'C');
    $pdf->Cell(4	,7,'P',1,0, 'C');
    $pdf->Cell(32.5	,7,$initPrice,1,0, 'C');
    $pdf->Cell(4	,7,'P',1,0, 'C');
    $pdf->Cell(32.5	,7,$productPrice,1,1,'R');//end of line
    $temp = $productPrice;


}


//summary
$pdf->SetFont('Arial','B',12);
$pdf->Cell(153.5	,7,'Subtotal:',1,0,'R');
$pdf->SetFont('Arial','',12);
$pdf->Cell(4	,7,'P',1,0, 'C');
$pdf->Cell(32.5	,7,$subtotal,1,1,'R');//end of line
/*
$pdf->SetFont('Arial','B',12);
$pdf->Cell(153.5	,7,'Discount:',1,0,'R');
$pdf->SetFont('Arial','',12);
$pdf->Cell(36.5	,7,'10%',1,1,'R');//end of line*/

$tax = 0.10;
$due = $subtotal;
/*
$pdf->SetFont('Arial','B',12);
$pdf->Cell(153.5	,7,'Total Due:',1,0,'R');
$pdf->SetFont('Arial','',12);
$pdf->Cell(4	,7,'P',1,0, 'C');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(32.5	,7,$due,1,1,'R');//end of line
*/
$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(190	,10,'EASY INVOICE',1,1,'C', true);

$pdf->Output('pdf/invoice_'.$invoiceNo.''.$customerId.''.$sellerId.''.$dateresult.'.pdf', 'F');
$pdf->Output();


$customerId = $_SESSION['customerId'];

    

    $awitsql = "SELECT * FROM inventorytemp WHERE sellerId='".$sellerId."';";
    $awitresult = mysqli_query($conn, $awitsql);

    while($row = mysqli_fetch_assoc($awitresult)){

        $newproductId = $row['productId'];
        $subtract = $row['productQuan'];

        $invsql = "SELECT * FROM inventory WHERE sellerId='$sellerId' AND productId='$newproductId';";
        $invresult = mysqli_query($conn, $invsql);
        $invrow = mysqli_fetch_assoc($invresult);

        $initQuan = $invrow['productQuan'];
        $initName = $invrow['productName'];
        $initPrice = $invrow['productPrice'];


        $newQuan = $initQuan - $subtract;

        $subsql = "UPDATE inventory SET productName = '".$initName."', productPrice = '".$initPrice."', productQuan = '".$newQuan."' WHERE productId='".$newproductId."';";
        $subresult = mysqli_query($conn, $subsql);

    }




    $sql = "DELETE FROM inventorytemp;";
    $result = mysqli_query($conn, $sql);


    



//insert to database


$invsql = "SELECT * FROM inventory WHERE sellerId='$sellerId' AND productId='$productId';";
$invresult = mysqli_query($conn, $invsql);
$invrow = mysqli_fetch_assoc($invresult);

$initQuan = $invrow['productQuan'];
$initName = $invrow['productName'];
$initPrice = $invrow['productPrice'];
/*
$sql = "UPDATE users SET usersUid = '".$businessName."',  usersEmail = '".$businessEmail."', usersAdd = '".$businessAdd."', usersDesc = '".$businessDesc."', usersImage = '".$new_img_name."' WHERE usersId='".$sellerId."';";
$result = mysqli_query($conn, $sql);*/



$receiptsql = "INSERT INTO receipt (sellerId, customerId, sale, saleDate, numInvoice) VALUES (?, ?, ?, ?, ?);";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $receiptsql)){
    header("location: index.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt, "iidsi", $sellerId, $customerId, $due, $dateresult, $invoiceNo);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
exit();


    
}