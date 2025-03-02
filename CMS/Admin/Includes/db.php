<?php 

	echo "Hello World From DB!";
	echo "<br>";
	
	ob_start();

	$db = new mysqli('localhost', 'Fatality', 'Yennefer0974', 'Drizzled_Obsessions');

	if($db->connect_error){
		die('Connection Failed' . $db->connect_error);
	}else{
		echo "Connected Successfully";
	}

	


 ?>
<!-- The php.ini file needs to be updated to allow the rule to show errors = On  so that we can see the errors in the browser .-->