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
    
    <title>Dashboard</title>
</head>
<body>

    <!--header or navbar-->

    <nav class="navbar">
        <a href="admin-index.php">
            <h4>
            <span class="letterE">E</span>asy <span class="letterI">I</span>nvoice
            </h4>
        </a>
        <div class="profile">
            
            <img src="uploads/IMG-61b782f31fe929.42178131.png" alt="" class="profile-image">
            <p class="profile-name">
            
            <?php 
			
			echo 'admin';
			
			?></p>
        </div>
    </nav>

    <!--sidebar-->

    <input type="checkbox" id="toggle">
    <label for="toggle" class="side-toggle">
        <span class="fa fa-bars"></span>
    </label>

    <div class="sidebar">
        <a href="admin-index.php"><div class="sidebar-menu active-link">
            <span class="fa fa-home"></span>
                <p>Dashboard</p>
        </div></a>
        <a href="users.php"><div class="sidebar-menu">
            <span class="fa fa-group"></span>
                <p>Users</p>
        </div></a>
        <a href="admin-feedback.php"><div class="sidebar-menu">
            <span class="fa fa-question-circle"></span>
                <p>Feedback</p>
        </div></a>
        <a href="logout-init.php"><div class="sidebar-menu">
            <span class="fa fa-sign-out"></span>
                <p>Logout</p>
        </div></a>
    </div>

    <!--main dashboard-->

    <main>
        <?php $now = date('Y-m-d'); /* DATE TODAY */?>
        <div class="index-dashboard-container">
            <div class="card total2">
                <div class="info">
                    <div class="info-detail">
                        <h3>Users</h3>
                        <p>total system users</p>
                        <h2><?php   $sql = "SELECT * FROM users;";
    		                        $custresult = mysqli_query($conn, $sql);
			                        $custresultCheck = mysqli_num_rows($custresult);
                                    echo $custresultCheck;
                            ?>
                        </h2>
                    </div>
                    <div class="info-image">
                        <i class="fa fa-group"></i>
                    </div>
                </div>
            </div>
            <div class="card total3">
                <div class="info">
                    <div class="info-detail">
                        <h3>Overall Invoices</h3>
                        <p>number of invoices</p>
                        <h2><?php   $sql = "SELECT * FROM receipt;";
    		                        $receiptresult = mysqli_query($conn, $sql);
			                        $receiptresultCheck = mysqli_num_rows($receiptresult);
                                    
                                    echo $receiptresultCheck;
                                    
                            ?></h2>
                    </div>
                    <div class="info-image">
                        <i class="fa fa-handshake-o"></i>
                    </div>
                </div>
            </div>
            <div class="card total4">
                <div class="info">
                    <div class="info-detail">
                        <h3>Overall Inventory</h3>
                        <p>total products</p>
                        <h2><?php   $sql = "SELECT * FROM inventory;";
    		                        $result = mysqli_query($conn, $sql);
			                        $resultCheck = mysqli_num_rows($result);
                                    echo $resultCheck;
                            ?>
                        </h2>
                    </div>
                    <div class="info-image">
                        <i class="fa fa-archive"></i>
                    </div>
                </div>
            </div>

            <!--bottom cards-->

            <div class="card detail">
                <div class="detail-header">
                    <h2>Users</h2>
                    <a href="users.php" class="button"><button>See more</button></a>
                </div>

                <?php
                
                $newsql = "SELECT * FROM users ORDER BY usersID DESC LIMIT 5;";
                
                $query_run = mysqli_query($conn, $newsql);                              
                
                if(mysqli_num_rows($query_run) > 0){
                
                ?>

                <table>
                    <tr>
                        <th>User ID</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Description</th>
                    </tr>
                    <?php   $ctr = 0;
                            while ($custrow = mysqli_fetch_assoc($query_run)){
                            if($ctr <= 5){?>
                        <tr>
                            <td><?php echo $custrow['usersID'];?></td>
                            <td><?php echo $custrow['usersEmail'];?></td>
                            <td><?php echo $custrow['usersUid'];?></td>
                            <td><?php echo $custrow['usersAdd'];?></td>
                            <td><?php echo $custrow['usersDesc'];?></td>
                        </tr>
                    <?php $ctr++;} }?>
                </table>
                <?php }?>

            </div>
        </div>
    </main>

</body>
</html>