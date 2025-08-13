<?php use phpmailer\phpmailer\PHPMailer; ?>

<?php
function escape($string){
    global $dbs;
    return htmlspecialchars(trim($string));
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

function query($query){
        global $dbs;
        return $dbs->query($query);
}

function fetch($result){
    global $dbs;
    return $result->fetch(PDO::FETCH_ASSOC);
}

function rowCount($result){
    global $dbs;
    return $result->rowCount();
}

function close(){
    global $dbs;
    $dbs = null;
}




?>