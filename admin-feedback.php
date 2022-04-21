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
    
    <title>Feedback</title>
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
        <a href="admin-index.php"><div class="sidebar-menu">
            <span class="fa fa-home"></span>
                <p>Dashboard</p>
        </div></a>
        <a href="users.php"><div class="sidebar-menu">
            <span class="fa fa-group"></span>
                <p>Users</p>
        </div></a>
        <a href="admin-feedback.php"><div class="sidebar-menu active-link">
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
        <div class="customer-container">
                <div class="card detail">
                    <div class="detail-header">
                        <h2>Users With Feedback</h2>
                        <!--<a href="customer-add.php" class="button"><button>Add Customer</button></a>-->
                    </div>

                    <?php

                        $now = date('Y-m-d'); /* DATE TODAY */
			
			            $sql = "SELECT * FROM response ORDER BY usersId DESC;";
    		            $result = mysqli_query($conn, $sql);
			            $resultCheck = mysqli_num_rows($result);


                        if($resultCheck > 0){
                    ?>



                    <table>
                            <tr>
                                <th>User ID</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Description</th>
                                <th style="width: 0px;">View</th>
                                <th style="width: 0px;">Delete</th>
                            </tr>
                            <?php while ($row = mysqli_fetch_assoc($result)){
                                    
                                    $usersId = $row['usersId'];
                                    $tempsql = "SELECT * FROM users WHERE usersID = $usersId;";
                                    $tempresult = mysqli_query($conn, $tempsql);
			                        $tempresultCheck = mysqli_num_rows($tempresult);
                                    if($tempresultCheck = 0){
                                        exit();
                                    }
                                    $temprow = mysqli_fetch_assoc($tempresult)

                                    ?>
                            <tr>
                                <td><?php echo $temprow['usersID'];?></td>
                                <td><?php echo $temprow['usersEmail'];?></td>
                                <td><?php echo $temprow['usersUid'];?></td>
                                <td><?php echo $temprow['usersAdd'];?></td>
                                <td><?php echo $temprow['usersDesc'];?></td>
                                <td><a href="admin-feedback-view.php?id=<?php echo $temprow['usersID'];?>" class="editbutton">View</a></td>
                                <td><a style="padding: 5px 20px" href="admin-feedback-delete.php?id=<?php echo $temprow['usersID'];?>" onclick="return confirm('Warning! Are you sure you want to delete Feedback from <?php echo $temprow['usersUid'];?>?')" class="editbutton">Delete</a></td>
                            </tr>
                            <?php }?>
                        </table>
                    <?php }?>
                </div>
        </div>
    </main>
</body>
</html>