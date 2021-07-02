<?php
	session_start();
	unset($_SESSION['cart']);
	unset($_SESSION['customer']);
	unset($_SESSION['customerid']);
	header('location: index.php');
?>