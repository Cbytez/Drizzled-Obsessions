<?php use PHPMailer\PHPMailer\PHPMailer; ?>
<?php

	function function_alert($message) {

	// Display the alert box
	echo "<script>alert('$message');</script>";
	}


	function imagePlaceholder($image=''){
		if(!$image){
			return 'Lang.jpg';
		}else{
			return $image;
		}
	}


	function redirect($location){
 		 header("location:" . $location);
 		 exit;
 	}

	function confirmQuery($result){
		global $db;
		if (!$result) {
			die("Query Failed!" . mysqli_error($db));
		}
	}

	//for password redirect system
	function ifItIsMethod($method=NULL){
		if ($_SERVER['REQUEST_METHOD'] == strtoupper($method)) {
			return true;
		}

		return false;
	}


	//for password redirect system
	function isLoggedIn(){
		if (isset($_SESSION['user_role'])) {

			return true;

		}

		return false;

	}

	function loggedInUserId(){

		if (isLoggedIn()) {
			global $db;
			$query = "SELECT * FROM users WHERE username='" . $_SESSION['username'] ."'";
			$result = mysqli_query($db, $query);
			confirmQuery($result);
			$user = mysqli_fetch_array($result);
			return mysqli_num_rows($result) >= 1 ? $user['user_id'] : false;

		}
		return false;
	}

	function userLikedPost($post_id){
		$query = "SELECT * FROM likes WHERE user_id=" .loggedInUserId() . " AND post_id={$post_id}";
		$result = mysqli_query($db, $query);
		confirmQuery($result);
		return mysqli_num_rows($result) >= 1 ? true : false;
	}


	//for password redirect system
	function userLoginCheckAndRedirect($redirectLocation=null){
		if (isLoggedIn()) {
			redirect($redirectLocation);
		}
	}


	function insert_categories(){
		global $db;
	if(isset($_POST['submit'])) {
			$cat_title = escape($_POST['cat_title']);

			if ($cat_title == "" || empty($cat_title)) {
				echo "<strong>This field should not be empty!</strong>";
			}else{
				$stmt = mysqli_prepare($db, "INSERT INTO catagories(cat_title) VALUE(?) ");

				mysqli_stmt_bind_param($stmt, 's', $cat_title);
				mysqli_stmt_execute($stmt);


				if (!$stmt) {
					die('QUERY FAILED!' . mysqli_error($db));
				}
			}
		}

	}

	function findAllCategories(){
		global $db;

		$stmt = mysqli_prepare($db, "SELECT cat_id, cat_title FROM catagories");

		mysqli_stmt_execute($stmt);

		mysqli_stmt_bind_result($stmt, $cat_id, $cat_title);

		while(mysqli_stmt_fetch($stmt)):
		 	echo "<tr>";
		 	echo "<td>{$cat_id}</td>";
		 	echo "<td>{$cat_title}</td>";
		 	echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('Are You sure you want to delete?'); \" href='categories.php?delete={$cat_id}'>delete</a></td>";
		 	echo "<td><a class='btn btn-primary' href='categories.php?edit={$cat_id}'>edit</a></td>";
		 	echo "</tr>";
		 endwhile;

	}

	function deleteQuery(){
		global $db;

		if (isset($_GET['delete'])) {
			$the_cat_id = escape($_GET['delete']);
			$stmt = mysqli_prepare($db, "DELETE FROM catagories WHERE cat_id = ?");

			mysqli_stmt_bind_param($stmt, 'i', $the_cat_id);

			mysqli_stmt_execute($stmt);
			header("location: categories.php");
		}
	}

 ?>

 <?php

?>

<?php

	function escape($string){
		global $db;
		return mysqli_real_escape_string($db, trim($string));
	}




?>

<?php

	function recordCount($table){
		global $db;

		$stmt2077 = mysqli_prepare($db, "SELECT * FROM " . $table);

		mysqli_stmt_execute($stmt2077);

		mysqli_stmt_store_result($stmt2077);

		$result = $stmt2077 -> num_rows;

		return $result;


	}



	function checkStatus($table, $column, $status){
		global $db;

		$query = "SELECT * FROM $table WHERE $column = '$status' ";
        $result = mysqli_query($db, $query);
        return mysqli_num_rows($result);

	}

	function checkUserRole($table, $column, $role){
		global $db;
		$query = "SELECT * FROM $table WHERE $column = '$role' ";
		$select_all_users = mysqli_query($db, $query);

		return mysqli_num_rows($select_all_users);
	}
?>

<?php

 	function isAdmin($username = ''){
 		global $db;

 		$query = "SELECT user_role FROM users WHERE username = '$username'";
 		$result = mysqli_query($db, $query);
 		confirmQuery($result);
 		$row = mysqli_fetch_array($result);

 		if ($row['user_role'] === 'admin') {
 			return true;
 		}else{
 			return false;
 		}

 	}

	// for online verification
	function username_online($username){
		global $db;
		$query = "SELECT username FROM members_online WHERE username = '$username' ";
		$result = mysqli_query($db, $query);
		confirmQuery($result);
		$row = mysqli_fetch_array($result);

		if(mysqli_num_rows($result) > 0){
			echo '<div class="alert alert-danger" role="alert">User is online</div>';
		}else{
			return false;
		}
	}

	// for registration system
 	function username_exists($username){
 		global $db;
 		$query = "SELECT username FROM users WHERE username = '$username' ";
 		$result = mysqli_query($db, $query);
 		confirmQuery($result);
 		$row = mysqli_fetch_array($result);

 		if (mysqli_num_rows($result) > 0) {
 			return true;
 		}else{
 			return false;
 		}
 	}


	function email_exists($email){
 		global $db;
 		$query = "SELECT user_email FROM users WHERE user_email = '$email' ";
 		$result = mysqli_query($db, $query);
 		confirmQuery($result);
 		$row = mysqli_fetch_array($result);

 		if (mysqli_num_rows($result) > 0) {
 			return true;
 		}else{
 			return false;
 		}
 	}
?>
<?php

 		function register_user($username, $email, $user_firstname, $user_lastname, $password){
 			global $db;


			$username = mysqli_real_escape_string($db, $username);
			$password = mysqli_real_escape_string($db, $password);
			$user_firstname = mysqli_real_escape_string($db,$user_firstname);
			$user_lastname = mysqli_real_escape_string($db, $user_lastname);
			$email = mysqli_real_escape_string($db, $email);

			$password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 11) );

			$stmt3291 = mysqli_prepare($db, "INSERT INTO users (username, user_password, user_firstname, user_lastname, user_email, user_role) VALUES(?,?,?,?,?,?)");
			$user = 'user';
			mysqli_stmt_bind_param($stmt3291, 'ssssss', $username, $password, $user_firstname, $user_lastname, $email, $user);
			mysqli_stmt_execute($stmt3291);

			require '../vendor/autoload.php';

			$mail = new PHPMailer();

			$mail->isSMTP();
			$mail->Host = 'smtp.stackmail.com';
			$mail->Username = 'Admin@k3marines.com';
			$mail->Password = 'KCMCL1253';
			$mail->Port = 587;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPAuth = true;
			$mail->isHTML(true);
			$mail->CharSet = 'UTF-8';


			$mail->setFrom('Admin@k3marines.com');
			$mail->addAddress($email);

			$mail->Subject = 'Registration Approved!';

			$mail->Body = '<p>Welcome to Drizzled Obsessions '. $username .' , <br /><br />Thank you for registering to our site and we hope you enjoy your stay with us. For your password if you did not write it down and already have forgotten it then please use our Forgot Password feature on our site at login. If you have any questions or concerns then please do not hesitate to reach out using an email to Admin or to one of the other forms of communication through the site. We are thankful and appreciative to have you among us and look forward to supplying your indulgences. We wish you and Drizzling sweet day! <br /><br /> DrizzledObsessions.com </p>';



			if($mail->send()){

					$emailSent = true;

			} else{

					echo "NOT SENT";

			}




		 }



	

	function login_user($username, $password){

        global $db;
		$length = 50;
		$otoken = bin2hex(openssl_random_pseudo_bytes($length));

		$stmt1984 = mysqli_prepare($db, "SELECT online_id, username, otoken FROM members_online WHERE username = '$username'");
		
		mysqli_stmt_execute($stmt1984);
		mysqli_stmt_store_result($stmt1984);

		$member_count = $stmt1984 -> num_rows;

		if($member_count > 0){
			echo " <h3 class='text-center'>That User Is Already Logged In!</h3>";
		}else{
			

			if(empty($username) || empty('username') && empty($password) || empty('password')){
						echo " <h3 class='text-center'>Fields Cannot Be Empty or Blank!</h3>";
						
				}elseif (empty($password) || empty('password')) {
					echo " <h3 class='text-center'>Password Cannot Be Empty Or Blank!</h3>";
				}else{
					if($username == $_SESSION['username']){
						echo " <h3 class='text-center'>That Username is already logged in</h3>";
				}else{
					//trim and escape username and password variables
				$username = trim(mysqli_real_escape_string($db, $username));
				$password = trim(mysqli_real_escape_string($db, $password));

				$stmt = mysqli_prepare($db, "SELECT username FROM users WHERE username = '$username'");

				mysqli_stmt_execute($stmt);

				mysqli_stmt_store_result($stmt);

				$countsz = $stmt -> num_rows;

				if ($countsz <= 0) {
					echo "<h3 style='text-align: center;'>Username Incorrect or Not Registered!</h3>";
				}
				
				
				$stmt6244 = mysqli_prepare($db, "SELECT user_id, username, user_password, user_firstname, user_lastname, user_role FROM users WHERE username = ? ");


				mysqli_stmt_bind_param($stmt6244, 's', $username);

				mysqli_stmt_execute($stmt6244);
				$result = $stmt6244 -> get_result();

				while ($row = $result -> fetch_assoc()):
						$db_user_id = $row['user_id'];
						$db_username = $row['username'];
						$db_user_password = $row['user_password'];
						$db_user_firstname = $row['user_firstname'];
						$db_user_lastname = $row['user_lastname'];
						$db_user_role = $row['user_role'];



					if (password_verify($password,$db_user_password)) {
						$_SESSION['user_id'] = $db_user_id;
						$_SESSION['username'] = $db_username;
						$_SESSION['firstname'] = $db_user_firstname;
						$_SESSION['lastname'] = $db_user_lastname;
						$_SESSION['user_role'] = $db_user_role;

						$stmt1244 = mysqli_prepare($db, "INSERT INTO members_online (online_id, username, otoken) VALUES (?, ?, ?)");				
						mysqli_stmt_bind_param($stmt1244, 'iss', $online_id, $username, $otoken);
						mysqli_stmt_execute($stmt1244);


					if ($db_user_role == 'admin') {
						header("location: admin/index.php");
					}else{
						header("location: index.php");
					}
					}else{
						echo "<h3 class='text-center'> Password is not correct!</h3>";
					}

				endwhile;

					
				}
			}
		}
    }

	
?>
