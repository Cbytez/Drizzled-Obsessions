<?php include "Includes/admin_header.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <div class="container_admin">
        <h1 class="admin_header">Hello Admin</h1>

        <div class="admin_content">
            <h2>Welcome to the admin panel</h2>
            <p>Here you can manage the website</p>
        </div>
    </div>


</body>
</html>

<button class="logout_button" onclick="logout()">Logout</button>

<?php include "Includes/admin_footer.php"; ?>

<script type="text/javascript">
function logout(){
    window.location.href = "../logout.php";
}
</script>