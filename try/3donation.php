<?php

    try {
        $db = new mysqli("localhost", "root", "", "newdonation");
    }
    catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
    
    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['nominal'])) {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $nominal = $_POST['nominal'];

    $db->query("INSERT INTO `donate`(`user_name`, `user_email`, `nominal`) VALUES ('$name', '$email', '$nominal')");
    
    }
    

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="3donate.css"/>
        <link href='https://fonts.googleapis.com/css?family=Megrim' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scaleable=no">
        <title>Donate for Kids</title>
        <script>
            // When the user clicks on div, open the popup
            function myFunction() {
              var popup = document.getElementById("myPopup");
              popup.classList.toggle("show");
            }
        </script>
    </head>
    <body>
        <div class="sticky">
            <div class="header">
              <a href="index.php" class="logo">madewithLuv</a>
            </div>
            <div class="menucontainer">
                <ul>
                    <li><a href="index.php">Shop</a></li>
                    <li class="cart"><a href="cart.html"> Cart <span>0</span></a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a class="active" href="2donation.php">Donations</a></li>
                </ul>
            </div>
        </div>
        <br>
        <center>
            <div class="middle" style="height: 1080px; width: 950px; font-size: 20px;">   
                <h1 style="text-align: left;">MAKE <em style="color: orangered">A DIFFERENCE</em></h1>
                <img src="./photos/unicef.jpg" alt="unicef" width="800px" height="350px">
                <h3 style="float: left">
                <strong>Save The Future of Children with UNICEF #LawanCovid19!</strong>
                </h3>
                <br>
                <br>
                <br>
                <br>
                <p style="text-align: justify;"> <em style="color:darkred">   MadewithLuv</em> 
                    is working with UNICEF Indonesia to make donations to Indonesian children against Covid. Let's join us! Your donation every month, regardless of value, is a long-term help for Indonesian children. Join as a Child Warrior now! You can also make a one-time donation to keep helping them.
                </p>
                
                <h4 class="outset" style="float: left; text-align: justify;">
                How your donation can help children from West to Eastern Indonesia:<br>
                    - UNICEF Indonesia is providing support for nutritional medicine supplies during the pandemic for children suffering from malnutrition.<br>
                    - UNICEF Indonesia facilitates 5000 health services to continue to provide immunization services to children. Including developing technical instructions for safe immunization procedures from Covid-19 transmission.<br>
                    - UNICEF assists the Ministry of Education and Culture in developing school modules from home including online module preparation, television, radio, and printed materials.
                    <br>
                
                </h4>
            </div>
            <div class="content">
                <h3>Put your donation here!</h3>
                <form method="post" action="">
                <input id="name" type="text" name="name" placeholder="Name" Style="width: 100px;">
                <input id="nominal" type="number" name="nominal" placeholder="Amount" Style="width: 100px; margin-left: 10px; margin-right: 10px;">
                <input id="email" type="text" name="email" placeholder="Email" Style="width: 100px;">
                    <br>
                    <br>
                <div class="popup" onclick="myFunction()">
                    <input type="submit" style=" margin-left: 20px;" value="Donate">
                    <span class="popuptext" id="myPopup">Thank you for your donation, we will contact you through email shortly!</span>
                </div>
                </form>
            </div>
        </center>
      <section id="outro">
        <div class="row row-no-gutters">
            <div class="col-sm-8">
                <p>
                  &ldquo;You must be the change you wish to see in the world.&rdquo;
                </p>
                  <br>
                <i>Mahatma Ghandi</i>
            </div>
              <div class="col-sm-4">
                  <a href="#" class="fa fa-facebook"></a>
                  <a href="#" class="fa fa-twitter"></a>
                  <a href="#" class="fa fa-instagram"></a>
                  <a href="#" class="fa fa-google"></a>
                  <br>
                <p>Connect with us through our social media and get the updates about your donation!</p>
            </div>
        </div>
      </section>
        <script src="main.js"></script>
    </body>
</html>
