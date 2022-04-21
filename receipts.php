<?php

session_start();
require_once 'dbh.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins&display=swap">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>Receipts</title>
</head>
<body>

    <!--header or navbar-->

    <nav class="navbar">
        <a href="index.html">
            <h4>
            <span class="letterE">E</span>asy <span class="letterI">I</span>nvoice
            </h4>
        </a>
        <a href="invoice.php"><button>Add Sale Invoice</button></a>
        <div class="profile">
            <!--<span class="fa fa-search"></span>-->
            <?php
            
            $sql = "SELECT * FROM users WHERE usersId = '$_SESSION[userId]';";
            $imgresult = mysqli_query($conn, $sql);
            $image = mysqli_fetch_assoc($imgresult);

            
            ?>

            <img src="uploads/<?php echo $image['usersImage'];?>" alt="" class="profile-image">
            <p class="profile-name"><?php 
			
			if(isset($_SESSION['userId']) && isset($_SESSION['username'])){
				echo $_SESSION['username'];
			}
			else{
				echo '<script>alert("Login Failed!");</script>';
				header('location: login.php');
			}

			?></p>
        </div>
    </nav>

    <!--sidebar-->

    <input type="checkbox" id="toggle">
    <label for="toggle" class="side-toggle">
        <span class="fa fa-bars"></span>
    </label>

    <div class="sidebar">
        <a href="index.php"><div class="sidebar-menu">
            <span class="fa fa-home"></span>
                <p>Dashboard</p>
        </div></a>
        <a href="compinfo.php"><div class="sidebar-menu">
            <span class="fa fa-building"></span>
                <p>Company</p>
        </div></a>
        <a href="inventory.php"><div class="sidebar-menu">
            <span class="fa fa-archive"></span>
                <p>Inventory</p>
        </div></a>
        <a href="customer.php"><div class="sidebar-menu">
            <span class="fa fa-group"></span>
                <p>Customers</p>
        </div></a>
        <a href="receipts.php"><div class="sidebar-menu active-link">
            <span class="fa fa-clipboard"></span>
                <p>Saved Invoice</p>
        </div></a>
        <a href="mop.php"><div class="sidebar-menu">
            <span class="fa fa-credit-card"></span>
                <p>Mode of Payment</p>
        </div></a>
        <!--<br><br>
        <br><br>
        <br><br>-->
        <!--break-->

        <!--<a href="#"><div class="sidebar-menu">
            <span class="fa fa-gear"></span>
                <p>Settings</p>
        </div></a>-->
        <a href="utility.php"><div class="sidebar-menu">
            <span class="fa fa-briefcase"></span>
                <p>Utilities</p>
        </div></a>
        <a href="feedback.php"><div class="sidebar-menu">
            <span class="fa fa-question-circle"></span>
                <p>Help & Support</p>
        </div></a>
        <a href="logout-init.php"><div class="sidebar-menu">
            <span class="fa fa-sign-out"></span>
                <p>Logout</p>
        </div></a>
    </div>

    <!--main dashboard-->

    <main>
        <div class="receipt-container">
                <div class="card detail">
                    <div class="detail-header">
                        <h2>Saved Invoice</h2>
                        <!--<a href="invoice.php"><button>Add Item</button></a>-->
                    </div>
                    <?php
			
                    $sql = "SELECT * FROM receipt WHERE sellerId = '$_SESSION[userId]' ORDER BY invoiceNo DESC;";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    /*$date = date('m/d/y');
                    $newdate = new DateTime($date);
                    $dateresult = $newdate->format('Y-m-d');*/

                    $now = date('Y-m-d');


                    if($resultCheck > 0){
                        
                        

                    ?>

                    <table>
                        <tr>
                            <th>Invoice Number</th>
                            <th>Customer Name</th>
                            <th>Date</th>
                            <th>Price</th>
                            <th>Forgot</th>
                            <th>View</th>
                            <th>Delete</th>
                            
                        </tr>
                        <?php while ($row = mysqli_fetch_assoc($result)){
                            
                            $customerId = $row['customerId'];
                            $custsql =  "SELECT * FROM customers WHERE customerId = '$customerId';";
                            $custresult = mysqli_query($conn, $custsql);
                            $custCheck = mysqli_num_rows($custresult);
                            $customer = mysqli_fetch_assoc($custresult);
                            

                            if($custCheck > 0){

                            



                            ?>

                            
                        <tr>
                            <td><?php echo $row['numInvoice'];?></td>
                            <td><?php echo $customer['customerName'];?></td>
                            <td><?php echo $row['saleDate'];?></td>
                            <td><?php echo $row['sale'];?></td>
                            <td><?php   $days1 = $row['saleDate'];
                                        /*$finaldays = strtotime($now) - strtotime($days1);
                                        echo round($finaldays, (60 * 60 * 24));*/
                                        //date('Y-m-d', $finaldays);
                                        
                                        $intsaledate = strtotime($days1);
                                        $intnow = strtotime($now);
                                        $diff = $intnow - $intsaledate;
                                        $dateDiff = round($diff / 86400);


                                        echo $dateDiff; ?></td>
                            <td style="width: 5%;"><a href="pdf/invoice_<?php echo $row['numInvoice'];?><?php echo $row['customerId'];?><?php echo $row['sellerId']?><?php echo $row['saleDate'];?>.pdf" class="editbutton">PDF</a></td>
                            <td style="width: 5%;"><a href="receipt-delete.php?id=<?php echo $row['invoiceNo'];?>" onclick="return confirm('Warning! Are you sure you want to delete this invoice of <?php echo $customer['customerName'];?>?')" class="editbutton">Delete</a></td>
                        </tr>
                        <?php }
                        }?>
                    </table>
                    <?php }?>
                </div>
        </div>
    </main>
</body>
</html>