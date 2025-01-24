<?php include "Includes/admin_header.php"; ?>

<div class="container_admin">
<h1>Hello Admin</h1>
</div>

<button class="logout_button" onclick="logout()">Logout</button>

<?php include "Includes/admin_footer.php"; ?>

<script type="text/javascript">
function logout(){
    window.location.href = "../logout.php";
}
</script>