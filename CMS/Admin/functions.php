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


?>