<h1>Customer Area</h1>

<button class="logout_button" onclick="logout()">Logout</button>

<?php include "Includes/footer.php"; ?>

<script type="text/javascript">
function logout(){
    window.location.href = "logout.php";
}
</script>