<?php

session_start();

include 'dbcon.php';

if (isset($_GET['order_id']))
{
	$order_id=$_GET['order_id'];
	$result = mysqli_query($mysqli, 'SELECT SUM(subtotal) AS amount_due FROM invoice_order WHERE status = "open"'); 
	$row = mysqli_fetch_assoc($result); 
	$sum = $row['amount_due'];
	echo $sum;

    echo "<script>window.location = 'invoice_list.php';</script>";
} else {
    echo "ERR!";
}


?>