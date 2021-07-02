<?php 
session_start();
require_once 'config/connect.php'; 
if(isset($_POST) & !empty($_POST)){

	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$address = $_POST['address'];
	$contact = $_POST['contact'];

	$sql = "INSERT INTO users (name, email, password, address, contact) VALUES ('$name','$email', '$password', '$address', '$contact')";
	$result = mysqli_query($connection, $sql);
	if($result){
		$_SESSION['customer'] = $email;
		$_SESSION['customerid'] = mysqli_insert_id($connection);
		header("location: checkout.php");
	}else{
		header("location: login.php?message=2");
	}
}

?>