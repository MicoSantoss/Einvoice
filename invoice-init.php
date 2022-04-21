<?php

session_start();
require_once 'dbh.php';

if(isset($_GET['id'])){
	$customerId = $_GET['id'];
    $_SESSION['customerId'] = $customerId;
	$sql = "SELECT * FROM customers WHERE customerId='".$customerId."';";
	$result = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($result)){
    	$customerId = $row['customerId'];
    	$customerName = $row['customerName'];
        $customerAdd = $row['customerAdd'];
    	$customerNo = $row['customerNo'];
    	$customerStatus = $row['customerStatus'];
	}
}
else{
	header("location: invoice.php?error=emptyinput");
}
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
    
    <title>BIlling</title>
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
        <a href="customer.php"><div class="sidebar-menu">
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
            <div class="card detail">
            <form action="invoice-create.php" method="post">
                
                    <div class="detail-header">
                        <h2>Bill to:</h2>
                    </div>
                    <div class="compform">
                        <div class="input box1">
                            <span class="details">Customer Name</span>
                            <input type="text" name="customerName" placeholder="Enter Customer Name" value="<?php echo $customerName;?>" readonly>
                        </div>
                        <div class="input box3">
                            <span class="details">Customer Address</span>
                            <input type="text" name="customerAdd" placeholder="Enter Address" value="<?php echo $customerAdd;?>" readonly>
                        </div>
                        <div class="input box4">
                            <span class="details">Contact Number</span>
                            <input type="text" name="customerNo" placeholder="Enter Number" value="<?php echo $customerNo;?>" readonly>
                        </div>
                        <div class="input box5">
                            <!--<span class="details">Status</span>
                            <input type="text" name="customerStatus" placeholder="Enter Status" value="<?php //echo $customerStatus;?>" readonly>-->
                            <span class="details">Mode of Payment</span>
                            <select type="text" name="customerStatus">
                                <option value="Cash on Delivery">Cash on Delivery</option>
                                <option value="Gcash/E-Wallet">Gcash/E-Wallet</option>
                            </select>
                        </div>
                        <!--<div class="input box5">
                            <span class="details">Mode of Payment</span>
                            <input type="text" name="modeofpayment" >
                        </div>-->
                        <!--<input type="submit" name="submit" value="Update" class="editbutton">-->
                        <div class="detail-header">
                            <h3>Products:</h3>
                        </div>
                    </div>

                    <?php 

                    /*if ($customerStatus == 'Bogus'){
                        echo '<script>alert("Warning! This customer has been marked as Bogus");</script>';
                    }*/

                    ?>


                    
                    <table>
                        <?php
                        settype($products, "array");
                        $_SESSION['products'] = $products;
                        $sellerId = $_SESSION['userId'];
                        settype($ctr, "integer");
                        $tempsql="SELECT * FROM inventorytemp WHERE sellerId='$sellerId'";
                        $tempresult = mysqli_query($conn, $tempsql);
                        /*$check = mysqli_num_rows($tempresult);*/
                        $resultCheck = mysqli_num_rows($tempresult);
                        if($resultCheck > 0){?>
                            <tr>
                            <th>ID</th>    
                            <th>Name</th>
                            <!--<th>Available Items</th>-->
                            <th style="width: 20%;">Quantity</th>
                            <th style="width: 20%;">Price</th>
                            <th style="width: 0px;">Delete</th>
                        </tr><?php
                            while ($row = mysqli_fetch_assoc($tempresult)){
                                $products[$ctr] = $row['productId'];
                                ?>
                                <!--<form action="invoice-init-final.php" method="post">-->
                                <tr>
                                <td><?php echo $row['productId']; ?></td>
                                <td><?php echo $row['productName'];?></td>
                                <td><?php echo $row['productQuan'];?></td>
                                <td><?php echo $row['productPrice'];?></td>
                                <!--<td><input type="submit" name="submit" value="OK" class="editbutton"></td>-->
                                <!--<td><a href="invoice-init-final.php?id=<?php //echo $row['productId'];?>" class="editbutton">Select</a></td>-->
                                <!--<td style="width: 100px;"><input style="width: 200px;" type="text" name="quantity" value="<?php //echo $row['productQuan'];?>" readonly></td>-->
                                <td><a href="inventorytemp-delete.php?id=<?php echo $row['productId'];?>" class="editbutton">Delete</a></td>
                                </tr>
                                <!--</form>-->
                        <?php $ctr++; }?>
                    <?php }?>
                    </table>
                    <input type="submit" name="submit" value="Done" <?php if ($resultCheck == '0'){?> disabled <?php } ?> onclick="return confirm('Are you sure?')" class="editbutton">
                    <a href="cleartemp.php" class="editbutton">Clear</a>
                    <br><br>
                    <br> 
            </form>





            
                <form action="" method="post">
                        <div class="search">
                            <span class="details">Search Product</span><br>
                            <input type="text" name="search" placeholder="Search...">
                            <input type="submit" name="submitsearch" value="Search" class="editbutton">
                        </div>
                </form>
           
                
            <?php

            if (isset($_POST["submitsearch"])){
                $searchValue = $_POST["search"];

                require_once 'inventory-functions.php';

                /*if(emptyInputSearch($searchValue) !== false){
                    header("location: inventory-init.php?error=emptyinput");
                    exit();
                }*/

                if(empty($searchValue)){
                    echo '<script>alert("Please Enter Product Name!");</script>';
                    exit();
                }


                $sql="SELECT * FROM inventory WHERE productName LIKE '%$searchValue%' AND sellerId='$sellerId'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result)==0){
                    echo '<script>alert("Result Not Found!");</script>';
                    exit();
                }

                $prodId = array();

                
            ?>
            
            <table>
                <tr>
                    <th>Item ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Available Items</th>
                    <th style="width: 0px;">Quantity</th>
                    <th>Confirm</th>
                </tr>
                <form action="invoice-init-search.php" method="post">
                <?php while ($row = mysqli_fetch_assoc($result)){
                      $prodId[] = $row['productId'];
                      $_SESSION['productId'] = $row['productId'];
                      ?>
                <tr>
                    <td><input style="width: 90%;" type="text" name="productId" value="<?php echo $row['productId'];?>" readonly></td>
                    <td><input style="width: 90%;" type="text" name="productName" value="<?php echo $row['productName']; ?>" readonly></td>
                    <td><input style="width: 50%;" type="text" name="productPrice" value="<?php echo $row['productPrice'];?>" readonly></td>
                    <td><input style="width: 50%;" type="text" name="productQuan" value="<?php echo $row['productQuan'];?>" readonly></td>
                    <td><input style="  width: 100%;
                                        padding: 12px 20px;
                                        margin: 8px 0;
                                        display: inline-block;
                                        border: 1px solid #ccc;
                                        border-radius: 4px;
                                        box-sizing: border-box;" type="number" name="quantity" min="1"></td>
                    <!--<td><a href="invoice-init-search.php?id=<?php echo $row['productId'];?>" class="editbutton">Select</a></td>-->
                    <td><input type="submit" name="submit" value="Select" class="editbutton"></td>
                </tr>
                <?php }?>
                </form>
            </table>
            
            <?php }
            else{
                
            }?>
            <!--</div>-->
            

            </div>               
        </div>
    </main>
</body>
</html>