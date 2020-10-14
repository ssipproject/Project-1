<?php
    include_once("pass.php");
    $conn = mysqli_connect(($host,$username,$password,$db) or die ("error"));

    $name=$_GET['name'];
    $nominal=$_GET['nominal'];
    $email=$_GET['email'];
    $card=$_GET['card'];

    $res=mysqli_query($conn, "INSERT INTO donations (name, nominal, email, card) VALUES ('$name', '$nominal', '$email', '$card')");
    if($res) echo $name. $nominal. $email. $card. " is successfully written into database table";
    else echo "error";
?>
