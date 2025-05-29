<?php include 'header.php'; ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drizzled Obsessions Member Area</title>
    <link rel="stylesheet" type="text/css" href="CSS/index-style.css">
    <script src="https://kit.fontawesome.com/584507be96.js" crossorigin="anonymous"></script>
    <script src="javascript/DO.js"></script>
    <script src="javascript/index.js"></script>
</head>
<body>
    <div class="container">

    <h1 class="welcome_text1">Drizzled Obsessions Members Area</h1>

        <h1 class="welcome_text">Hello <?php echo $_SESSION['username']; ?></h1>

       

        <div class="navigation">
            <div id="navigation_links">
            <a href="index.php" class="active">Home</a>
            <a href="cust_info.php">Customer Info</a>
            <a href="order_info.php">Order Info</a>
            <a href="order_history.php">Order History</a>
            <a href="payment_info.php">Payment Info</a>
            </div>
        </div>

        <button class="logout_button" onclick="logout()">Logout</button>
    </div>
   <div class="footer">
    <p>Copyright &copy; 2025 Drizzled Obsessions. All rights reserved.</p>
   </div>
</body>
</html>



<script type="text/javascript">
function logout(){
    window.location.href = "logout.php";
}

//get the conatiner element
var linkContainer = document.getElementById("navigation_links");

//get all the links with class="active"
var activeLink = linkContainer.getElementsByClassName("active");

//Loop through the links and add the active class to the current/clicked link
for(var i = 0; i < activeLink.length; i++){
    activeLink[i].addEventListener("click", function(){
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace("active", "");
        this.className += "active";
    });
}


</script>