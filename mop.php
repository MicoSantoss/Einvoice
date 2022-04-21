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
    
    <title>Mode of Payment</title>
</head>
<body>

    <!--header or navbar-->

    <nav class="navbar">
        <a href="index.php">
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
        <a href="receipts.php"><div class="sidebar-menu">
            <span class="fa fa-clipboard"></span>
                <p>Saved Invoice</p>
        </div></a>
        <a href="mop.php"><div class="sidebar-menu active-link">
            <span class="fa fa-credit-card"></span>
                <p>Mode of Payment</p>
        </div></a>

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
            <form action="mop-init.php" method="post" enctype="multipart/form-data">        
                <div style="grid-area: detail;
                            overflow-x: auto;
                            background-color: #fff;
                            padding: 1rem;
                            border-radius: 10px;
                            margin-right: 533px;" class="card detail">
                    <div class="detail-header">
                        <h2>Mode of Payment</h2>
                    </div>
                    <div class="mopform">
                        <div class="input box1">
                            <span class="details">Gcash QR code</span><br><br>
                            <?php
                            
                            $qrsql = "SELECT * FROM users WHERE usersId='$_SESSION[userId]' AND qrcode IS NOT NULL;";
                            $qrresult = mysqli_query($conn, $qrsql);
                            $qrCheck = mysqli_num_rows($qrresult);
                            $qr = mysqli_fetch_assoc($qrresult);

                            if($qrCheck > 0){
                                ?>
                                
                                <img style="width: 210px;
                                            height: 305px;
                                            object-fit: cover;
                                            margin-left: 170px;" src="qrcodes/<?php echo $qr['qrcode'];?>" id="img3" alt="">
                                
                                <?php 
                            }
                            
                            ?>
                            <input style="display: none;" type="file" id="file" name="qrcode" accept="image/*">
                            <input style="background-color: #4CAF50;
                                        border: none;
                                        border-radius: 5px;
                                        color: white;
                                        padding: 9px 77px;
                                        text-align: center;
                                        text-decoration: none;
                                        display: flex;
                                        font-size: 16px;
                                        margin: 18px 2px;
                                        cursor: pointer;
                                        width: 30%;
                                        justify-content: center;" type="button" value="Upload QR Code" onclick="document.getElementById('file').click();">

                            <input style="
                                        background-color: #89b76e;
                                        border: none;
                                        border-radius: 5px;
                                        color: white;
                                        padding: 11px 109px;
                                        padding-left: 43px;
                                        text-align: center;
                                        text-decoration: none;
                                        display: inline-block;
                                        font-size: 16px;
                                        margin: -4px 3px;
                                        cursor: pointer;
                                        width: 30%;" type="submit" name="submit" value="Update">
                        </div>
                        <!--<div class="input box2">
                            <span class="details">Business Email</span>
                            <input type="email" name="businessEmail" placeholder="Enter Email Address" value="<?php echo $image['usersEmail'];?>">
                        </div>
                        <div class="input box3">
                            <span class="details">Address</span>
                            <input type="text" name="businessAdd" placeholder="Enter Address" value="<?php echo $image['usersAdd'];?>">
                        </div>
                        <div class="input box4">
                            <span class="details">Description</span>
                            <input type="text" name="businessDesc" placeholder="Enter Description" value="<?php echo $image['usersDesc'];?>">
                        </div>
                        <div class="input box5">
                            <span class="details">Business Logo</span><br>
                            <input type="file" id="file" name="profileImage" accept="image/*">
                            <input class="editbutton" type="submit" name="submit" value="Upload">-->
                            <!--<label for="file">Choose an image...</label>-->
                        <!--</div>-->
                        <!--<input style="
                                        background-color: #89b76e;
                                        border: none;
                                        border-radius: 5px;
                                        color: white;
                                        padding: 5px 11px;
                                        text-align: center;
                                        text-decoration: none;
                                        display: inline-block;
                                        font-size: 16px;
                                        margin: 295px -152px;
                                        margin-top: 377px;
                                        margin-bottom: 18px;
                                        cursor: pointer;
                                        width: 30%;" type="submit" name="submit" value="Update">-->
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>
</html>