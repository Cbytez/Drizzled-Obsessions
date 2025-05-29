<?php 

$host = "localhost";
$user = "Fatality";
$pass = "Yennefer0974";
$name = "Drizzled_Obsessions";

$dbs = mysqli_connect($host, $user, $pass, $name);

if ($dbs) {
	echo "We are connected Fool!<br>";
}else{
	echo "Not Connected!<br>";
}

 ?>
<!-- The php.ini file needs to be updated to allow the rule to show errors = On  so that we can see the errors in the browser .-->