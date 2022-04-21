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
    
    <title>Add Customer</title>
</head>
<body>

    <!--header or navbar-->

    <nav class="navbar">
        <a href="index.php">
            <h4>
            <span class="letterE">E</span>asy <span class="letterI">I</span>nvoice
            </h4>
        </a>
        <!--<a href="#"><button>Add Sale Invoice</button></a>-->
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
        <a href="customer.php"><div class="sidebar-menu active-link">
            <span class="fa fa-group"></span>
                <p>Customers</p>
        </div></a>
        <a href="receipts.php"><div class="sidebar-menu">
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
        <div class="compinfo-container">
            <!--top cards-->
            <!--
            <div class="card total1">
                <div class="info">
                    <div class="info-detail">
                        <h3>Revenue</h3>
                        <p>lorem ipisum</p>
                        <h2>1,872,222 <span>PHP</span></h2>
                    </div>
                    <div class="info-image">
                        <i class="fa fa-money"></i>
                    </div>
                </div>
            </div>
            <div class="card total2">
                <div class="info">
                    <div class="info-detail">
                        <h3>Customers</h3>
                        <p>lorem ipisum</p>
                        <h2>1,872,222 <span>PHP</span></h2>
                    </div>
                    <div class="info-image">
                        <i class="fa fa-group"></i>
                    </div>
                </div>
            </div>
            <div class="card total3">
                <div class="info">
                    <div class="info-detail">
                        <h3>invoices</h3>
                        <p>lorem ipisum</p>
                        <h2>1,872,222 <span>PHP</span></h2>
                    </div>
                    <div class="info-image">
                        <i class="fa fa-handshake-o"></i>
                    </div>
                </div>
            </div>
            <div class="card total4">
                <div class="info">
                    <div class="info-detail">
                        <h3>Inventory</h3>
                        <p>lorem ipisum</p>
                        <h2>1,872,222 <span>PHP</span></h2>
                    </div>
                    <div class="info-image">
                        <i class="fa fa-archive"></i>
                    </div>
                </div>
            </div>
            -->
            <!--bottom cards-->
            <form action="customer-add-init.php" method="post">
                <div class="card detail">
                    <div class="detail-header">
                        <h2>Add customer</h2>
                    </div>
                    <div class="compform">
                        <div class="input box1">
                            <span class="details">Customer Name</span>
                            <input type="text" name="customerName" placeholder="Enter Name">
                        </div>
                        <div class="input box3">
                            <span class="details">Customer Address</span>
                            <input type="text" name="customerAdd" placeholder="Enter Address">
                        </div>
                        <div class="input box4">
                            <span class="details">Contact Number</span>
                            <input type="text" name="customerNo" placeholder="Enter Number">
                        </div>
                        <div class="input box5">
                            <span class="details">Status</span>
                            <select type="text" name="customerStatus">
                                <option value="New">New</option>
                                <option value="Loyal">Loyal</option>
                            </select>
                            <!--<input type="text" name="customerStatus" placeholder="Enter Status" value="New" readonly>-->
                            <!--<input type="text" name="customerStatus" placeholder="Enter Status">-->
                        </div>
                        <input style="width: 30%;" type="submit" name="submit" value="Add" class="editbutton">
                    </div>
                </div>
            </form>

            <?php 
            if (isset($_GET['error'])){
                if ($_GET['error'] == "invalidnumber"){
                    echo '<script>alert("Input correct Contact Information!");</script>';
                }
                if ($_GET['error'] == "emptyinput"){
                    echo '<script>alert("Input correct Information!");</script>';
                }
            }
            
            ?>
            
        </div>
    </main>
</body>
</html>