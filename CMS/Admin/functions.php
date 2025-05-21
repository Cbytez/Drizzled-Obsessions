<?php use phpmailer\phpmailer\PHPMailer; ?>

<?php
function escape($string){
    global $db;
    return mysqli_real_escape_string($db, trim($string));
}

function redirect($location){
    header("Location: {$location}");
    exit;
}

function isAdmin($username){
    global $dbs;
    $sql = "SELECT * FROM users WHERE username = '$username' AND user_role = 'admin' LIMIT 1";
    $result = mysqli_query($dbs, $sql);
    return (mysqli_num_rows($result) === 1);
}


?>