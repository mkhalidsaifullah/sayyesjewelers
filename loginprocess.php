<?php 
session_start();
require_once 'config/connect.php'; 
if(isset($_POST) & !empty($_POST)){
	$email = $_POST['email'];
	$password = $_POST['password'];
	$sql = "SELECT * FROM users WHERE email='$email'";
	$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
	$count = mysqli_num_rows($result);
	$r = mysqli_fetch_assoc($result);

	if($count == 1){
		if($password == $r['password']){
			$_SESSION['customer'] = $email;
			$_SESSION['customerid'] = $r['id'];
			header("location: checkout.php");
		}else{
			header("location: login.php?message=1");
		}
	}else{
		header("location: login.php?message=1");
	}
}
?>