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
    
    <title>Customer</title>
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
        <div class="customer-container">
                <div class="card detail">
                    <div class="detail-header">
                        <h2>Customers List</h2>
                        <form action="" method="post">
                            <div class="search">
                                <input style="  padding: 5px 20px;
                                                width: 58%;" type="text" name="search" placeholder="Search Customer">

                                <input style="  padding: 3px 23px;
                                                font-size: 14px;
                                                height: 30px;
                                                width: 95px;
                                                border: 1px solid #89b76e;
                                                background-color: #89b76e;
                                                color: #f2f2f2;
                                                border-radius: 5px;
                                                cursor: pointer;
                                                transition: all 0.2s ease-in;" type="submit" name="customersearch" value="Search">
                            </div>
                        </form>
                        <a href="customer-add.php" class="button"><button>Add Customer</button></a>
                    </div>

                    <?php

                        $now = date('Y-m-d'); /* DATE TODAY */


                        if (isset($_POST["customersearch"])){
                            $searchValue = $_POST["search"];

                            require_once 'customer-functions.php';

                            

                            if (empty($searchValue)){
                                echo '<script>alert("Please Enter Customer Name!");</script>';
                                //exit();

                                $sql = "SELECT * FROM customers WHERE sellerId = '$_SESSION[userId]' ORDER BY customerId DESC;";
                                $result = mysqli_query($conn, $sql);
                                $resultCheck = mysqli_num_rows($result);

                                
                                if($resultCheck > 0){
                                    ?>
                                    
                                    <table>
                                        <tr>
                                            <th>Customer ID</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Contact No.</th>
                                            <th>Status</th>
                                            <th>Date Registered</th>
                                            <th style="width: 0px;">Bill</th>
                                            <th style="width: 0px;">Edit</th>
                                            <th style="width: 0px;">Delete</th>
                                        </tr>
                                        <?php while ($row = mysqli_fetch_assoc($result)){?>
                                        <tr>
                                            <td><?php echo $row['customerId'];?></td>
                                            <td><?php echo $row['customerName'];?></td>
                                            <td><?php echo $row['customerAdd'];?></td>
                                            <td><?php echo $row['customerNo'];?></td>
                                            <td><?php echo $row['customerStatus'];?></td>
                                            <td><?php $regdate = $row['regDate'];
                                            
                                                        $intregdate = strtotime($regdate);
                                                        $intnow = strtotime($now);
                                                        $diff = $intnow - $intregdate;
                                                        $dateDiff = round($diff / 86400);    
                                            
                                                        echo $regdate;
                                            ?></td>
                                            <td><a href="invoice-init.php?id=<?php echo $row['customerId'];?>" <?php if($row['customerStatus'] == 'Bogus'){
                                                ?> onclick="return confirm('Warning! This customer is marked as Bogus. Continue?')" <?php 
                                            }?> class="editbutton">Bill</a></td>
                                            <td><a href="customer-edit.php?id=<?php echo $row['customerId'];?>" class="editbutton">Edit</a></td>
                                            <td><a style="padding: 5px 20px" href="customer-delete.php?id=<?php echo $row['customerId'];?>" onclick="return confirm('Warning! Are you sure you want to delete customer <?php echo $row['customerName'];?>?')" class="editbutton">Delete</a></td>
                                        </tr>
                                        <?php }?>
                                    </table>
                                    
                                    <?php 
                                }

                                exit();

                            }


                            $sql="SELECT * FROM customers WHERE customerName LIKE '%$searchValue%' AND sellerId='$_SESSION[userId]';";
                            $result = mysqli_query($conn, $sql);
                            


                            ?>
                            
                            <table>
                                <tr>
                                    <th>Customer ID</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Contact No.</th>
                                    <th>Status</th>
                                    <th>Date Registered</th>
                                    <th style="width: 0px;">Bill</th>
                                    <th style="width: 0px;">Edit</th>
                                    <th style="width: 0px;">Delete</th>
                                </tr>
                                <?php while ($row = mysqli_fetch_assoc($result)){?>
                                <tr>
                                    <td><?php echo $row['customerId'];?></td>
                                    <td><?php echo $row['customerName'];?></td>
                                    <td><?php echo $row['customerAdd'];?></td>
                                    <td><?php echo $row['customerNo'];?></td>
                                    <td><?php echo $row['customerStatus'];?></td>
                                    <td><?php echo $row['regDate'];?></td>
                                    <td><a href="invoice-init.php?id=<?php echo $row['customerId'];?>" <?php if($row['customerStatus'] == 'Bogus'){
                                        ?> onclick="return confirm('Warning! This customer is marked as Bogus. Continue?')" <?php 
                                    }?> class="editbutton">Bill</a></td>
                                    <td><a href="customer-edit.php?id=<?php echo $row['customerId'];?>" class="editbutton">Edit</a></td>
                                    <td><a style="padding: 5px 20px" href="customer-delete.php?id=<?php echo $row['customerId'];?>" onclick="return confirm('Warning! Are you sure you want to delete customer <?php echo $row['customerName'];?>?')" class="editbutton">Delete</a></td>
                                </tr>
                            </table>
                            
                            <?php }
                            ?>
                            
                            <?php 


                        exit(); 
                        }


			
			            $sql = "SELECT * FROM customers WHERE sellerId = '$_SESSION[userId]' ORDER BY customerId DESC;";
    		            $result = mysqli_query($conn, $sql);
			            $resultCheck = mysqli_num_rows($result);


                        if($resultCheck > 0){
                            /*while ($row = mysqli_fetch_assoc($result)){
                                echo "Product Name: ". $row['productName']."<br>";
                                echo "Price: ". $row['productPrice']."<br>";
                                echo "Quantity: ". $row['productQuan']."<br><br>";
                            }*/
                        
                    ?>



                    <table>
                            <tr>
                                <th>Customer ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Contact No.</th>
                                <th>Status</th>
                                <th>Date Registered</th>
                                <th style="width: 0px;">Bill</th>
                                <th style="width: 0px;">Edit</th>
                                <th style="width: 0px;">Delete</th>
                            </tr>
                            <?php while ($row = mysqli_fetch_assoc($result)){?>
                            <tr>
                                <td><?php echo $row['customerId'];?></td>
                                <td><?php echo $row['customerName'];?></td>
                                <td><?php echo $row['customerAdd'];?></td>
                                <td><?php echo $row['customerNo'];?></td>
                                <td><?php //echo $row['customerStatus'];
                                
                                            $regdate = $row['regDate'];
                                                        
                                            $intregdate = strtotime($regdate);
                                            $intnow = strtotime($now);
                                            $diff = $intnow - $intregdate;
                                            $dateDiff = round($diff / 86400); 
                                            /*
                                            if ($dateDiff >= 5){
                                                echo 'hello';
                                                
                                                $custStatus = 'Bogus';

                                                $sql = "UPDATE customers SET customerStatus = '".$custStatus."' WHERE customerId='".$row['customerId']."';";
                                                $stmt = mysqli_stmt_init($conn);
                                                if(!mysqli_stmt_prepare($stmt, $sql)){
                                                    header("location: customer.php?error=stmtfailed");
                                                    exit();
                                                }
                                                mysqli_stmt_bind_param($stmt, "s", $custStatus);
                                                mysqli_stmt_execute($stmt);
                                                mysqli_stmt_close($stmt);
                                            }
*/
                                            echo $row['customerStatus'];
                                
                                ?></td>
                                <td><?php echo $row['regDate'];?></td>
                                <td><a href="invoice-init.php?id=<?php echo $row['customerId'];?>" <?php if($row['customerStatus'] == 'Bogus'){
                                    ?> onclick="return confirm('Warning! This customer is marked as Bogus. Continue?')" <?php 
                                }?> class="editbutton">Bill</a></td>
                                <td><a href="customer-edit.php?id=<?php echo $row['customerId'];?>" class="editbutton">Edit</a></td>
                                <td><a style="padding: 5px 20px" href="customer-delete.php?id=<?php echo $row['customerId'];?>" onclick="return confirm('Warning! Are you sure you want to delete customer <?php echo $row['customerName'];?>?')" class="editbutton">Delete</a></td>
                            </tr>
                            <?php }?>
                        </table>
                    <?php }?>
                </div>
        </div>
    </main>
</body>
</html>