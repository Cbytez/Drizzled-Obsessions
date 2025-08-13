<?php use phpmailer\phpmailer\PHPMailer; ?>

<?php
function escape($string){
    global $dbs;
    return mysqli_real_escape_string($dbs, trim($string));
}

function redirect($location){
    header("Location: {$location}");
    exit;
}

function isAdmin($username){
    global $dbs;
    $sql = "SELECT * FROM users WHERE username = '$username' AND user_role = 'admin' LIMIT 1";
    $result = $dbs->query($sql);
    return $result->rowCount() === 1;
}


?>