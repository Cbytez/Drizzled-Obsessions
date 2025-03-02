<?php 

	echo "Hello World From DB!";
	echo "<br>";
	
	ob_start();

	$db['db_host'] = "localhost";
	$db['db_user'] = "Fatality";
	$db['db_pass'] = "Yennefer0974";
	$db['db_name'] = "Drizzled_Obsessions";

	foreach ($db as $key => $value) {
		define(strtoupper($key), $value);
	}

	$db = new mysqli($db['db_host'], $db['db_user'], $db['db_pass'], $db['db_name']);

	if($db->connect_error){
		die('Connection Failed' . $db->connect_error);
	}else{
		echo "Connected Successfully";
	}

	


 ?>
<!-- The php.ini file needs to be updated to allow the rule to show errors = On  so that we can see the errors in the browser .-->