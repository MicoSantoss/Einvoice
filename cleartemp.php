<?php

session_start();
require_once 'dbh.php';

$customerId = $_SESSION['customerId'];

$sql = "DELETE FROM inventorytemp;";
$result = mysqli_query($conn, $sql);

header('location: invoice-init.php?id='.$customerId);