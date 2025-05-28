<?php include 'header.php'; ?>
<?php session_start(); ?>
<h1>Hello <?php echo $_SESSION['username']; ?></h1>

<h1>Welcome to the Customer Area</h1>

<button class="logout_button" onclick="logout()">Logout</button>

<?php include 'footer.php'; ?>

<script type="text/javascript">
function logout(){
    window.location.href = "logout.php";
}
</script>