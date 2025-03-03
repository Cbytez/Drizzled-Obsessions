<?php 

	echo "Hello World From DB!";
	echo "<br>";
	
	ob_start();

	$db = mysqli_connect('localhost', 'Fatality', 'Yennefer0974', 'Drizzled_Obsessions');

	// $db['db_host'] = "localhost";
	// $db['db_user'] = "Fatality";
	// $db['db_pass'] = "Yennefer0974";
	// $db['db_name'] = "Drizzled_Obsessions";

	// foreach ($db as $key => $value) {
	// 	define(strtoupper($key), $value);
	// }

	// $db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if ($db) {
		echo "We are connected!";
	}else{
		echo "Not Connected!";
	}

	


 ?>
<!-- The php.ini file needs to be updated to allow the rule to show errors = On  so that we can see the errors in the browser .-->