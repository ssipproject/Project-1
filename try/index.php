<?php

require_once('php/createDB.php');
require_once('./php/component.php');

//create instance of CreateDB class
$database = new CreateDB("Productdb", "Product");
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="newmain.css"/>
        <link href='https://fonts.googleapis.com/css?family=Megrim' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scaleable=no">
        <title>madewithLuv</title>
    </head>
    <body>
        <div class="sticky">
                <div class="header">
                <a href="index.php" class="logo">madewithLuv</a>
                </div>
                <div class="menucontainer">
                    <ul>
                        <li><a class="active" href="index.php">Shop</a></li>
                        <li class="cart"><a href="cart.html"> Cart <span>0</span></a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="2donation.php">Donations</a></li>
                    </ul>
                </div>
        </div>
        <br>
        <section class="container content-section">
            <h2 class="section-header">ALL ITEMS</h2>
            <div class="shop-items">
                <?php
                    $result = $database->getdata(); //($database->getdata()) this method return the data in $result variable
                    while($row = mysqli_fetch_assoc($result)){
                        component($row['product_name'], $row['product_price'], $row['product_image']);
                    }
                ?>
            </div>    
        </section>
        <div class="footer">
        <marquee direction="left" style="text-align: center; word-spacing: 20px; font-family: Arial, Helvetica, sans-serif; font-size:20px; color:floralwhite; background-color: #931a25;">ALL ITEMS 100% AUTHENTIC    ALL ITEMS 100% AUTHENTIC    ALL ITEMS 100% AUTHENTIC    ALL ITEMS 100% AUTHENTIC    ALL ITEMS 100% AUTHENTIC    ALL ITEMS 100% AUTHENTIC    ALL ITEMS 100% AUTHENTIC    ALL ITEMS 100% AUTHENTIC    ALL ITEMS 100% AUTHENTIC    ALL ITEMS 100% AUTHENTIC    ALL ITEMS 100% AUTHENTIC    ALL ITEMS 100% AUTHENTIC    ALL ITEMS 100% AUTHENTIC    </marquee>
        </div>
    </body>
    <style src="main.js"></style>
</html>