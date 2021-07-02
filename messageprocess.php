<?php
require_once 'config/connect.php';

if(isset($_POST) & !empty($_POST)){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $message = $_POST['message'];

    $sql = "INSERT INTO message(name, email, contact, message) VALUES('$name', '$email', '$contact', '$message')";
    $res = mysqli_query($connection, $sql);

    if ($res) {
        header("location: index.php");
    } else {
        header("location: contact.php");
    }
} 
?>