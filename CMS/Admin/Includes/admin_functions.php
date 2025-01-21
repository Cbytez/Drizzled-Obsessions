<?php use PHPMailer\PHPMailer\PHPMailer; ?>
<?php
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

    //for password redirect system
	function userLoginCheckAndRedirect($redirectLocation=null){
		if (isLoggedIn()) {
			redirect($redirectLocation);
		}
	}

    //for password redirect system
	function confirmQuery($result){
		global $db;
		if (!$result) {
			die("QUERY FAILED" . mysqli_error($db));
		}
	}

    function escape($string){
		global $db;
		return mysqli_real_escape_string($db, trim($string));
	}

    function redirect($location){
		header("Location: $location");
	}

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

       $mail->Body = '<p>Semper Fi '. $username .' , <br /><br />Thank you for registering to our site and we hope you enjoy your stay with us. For your password if you did not write it down and already have forgotten it then please use our Forgot Password feature on our site at login. If you have any questions or concerns then please do not hesitate to reach out using an email to Admin or to one of the other forms of communication through the site or by contacting your chain of command directly. We are honored to have you among us and look forward to the future together. OOH RAH! <br /><br /> K3Marines.com </p>';



       if($mail->send()){

               $emailSent = true;

       } else{

               echo "NOT SENT";

       }




    }
?>