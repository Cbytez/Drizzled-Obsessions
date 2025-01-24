<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
?>
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
    function register_user($username, $user_email, $user_firstname, $user_lastname, $user_password){
        global $db;


       $username = mysqli_real_escape_string($db, $username);
       $user_password = mysqli_real_escape_string($db, $user_password);
       $user_firstname = mysqli_real_escape_string($db,$user_firstname);
       $user_lastname = mysqli_real_escape_string($db, $user_lastname);
       $user_email = mysqli_real_escape_string($db, $user_email);

       $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 11) );

       $stmt3291 = mysqli_prepare($db, "INSERT INTO users (username, user_password, user_firstname, user_lastname, user_email, user_role) VALUES(?,?,?,?,?,?)");
       $user = 'user';
       mysqli_stmt_bind_param($stmt3291, 'ssssss', $username, $user_password, $user_firstname, $user_lastname, $user_email, $user);
       mysqli_stmt_execute($stmt3291);

       require '../vendor/autoload.php';

    //    $mail = new PHPMailer();

       $mail->isSMTP();
       $mail->Host = 'smtp.stackmail.com';
       $mail->Username = 'Admin@DrizzledObsessions.com';
       $mail->Password = 'DrizzledObsessions1253';
       $mail->Port = 25;
       $mail->SMTPSecure = 'tls';
       $mail->SMTPAuth = true;
       $mail->isHTML(true);
       $mail->CharSet = 'UTF-8';


       $mail->setFrom('Admin@DrizzledObsessions.com');
       $mail->addAddress($user_email);

       $mail->Subject = 'Registration Approved!';

       $mail->Body = '<p>Welcome to Drizzled Obsessions '. $username .' , <br /><br />Thank you for registering to our site and we hope you enjoy your stay with us. For your password, We suggest you write it down so your don\'t forget it. If you do forget it then please use our Forgot Password feature on our site at login. If you have any questions or concerns then please do not hesitate to reach out using our Contacts page. We are honored to have you with us and look forward to our obsessive future together. Happy and deep Obsessing! <br /><br /> Drizzled Obsessions.com </p>';



       if($mail->send()){

               $emailSent = true;

       } else{

               echo "NOT SENT";

       }

       mysqli_stmt_close($stmt3291);




    }
?>

<?php
    function login_user($username, $user_password){

        global $db;
		$length = 50;
		$otoken = bin2hex(openssl_random_pseudo_bytes($length));

		$stmt1984 = mysqli_prepare($db, "SELECT user_id, username, otoken FROM users WHERE username = '$username'");
		
		mysqli_stmt_execute($stmt1984);
		mysqli_stmt_store_result($stmt1984);

		$member_count = $stmt1984 -> num_rows;

		if($member_count > 0){
			echo " <h3 class='text-center'>That User Is Already Logged In!</h3>";
		}else{
			

			if(empty($username) || empty('username') && empty($user_password) || empty('user_password')){
						echo " <h3 class='text-center'>Fields Cannot Be Empty or Blank!</h3>";
						
				}elseif (empty($user_password) || empty('user_password')) {
					echo " <h3 class='text-center'>Password Cannot Be Empty Or Blank!</h3>";
				}else{
					if($username == $_SESSION['username']){
						echo " <h3 class='text-center'>That Username is already logged in</h3>";
				}else{
					//trim and escape username and password variables
				$username = trim(mysqli_real_escape_string($db, $username));
				$user_password = trim(mysqli_real_escape_string($db, $user_password));

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



					if (password_verify($user_password,$db_user_password)) {
						$_SESSION['user_id'] = $db_user_id;
						$_SESSION['username'] = $db_username;
						$_SESSION['firstname'] = $db_user_firstname;
						$_SESSION['lastname'] = $db_user_lastname;
						$_SESSION['user_role'] = $db_user_role;

						$stmt1244 = mysqli_prepare($db, "INSERT INTO users (user_id, username, otoken) VALUES (?, ?, ?)");				
						mysqli_stmt_bind_param($stmt1244, 'iss', $user_id, $username, $otoken);
						mysqli_stmt_execute($stmt1244);


					if ($db_user_role == 'admin') {
						header("location: Admin/index.php");
					}else{
						header("location: index.php");
					}
					}else{
						echo "<h3 class='text-center'> Password is not correct!</h3>";
					}

				endwhile;

				mysqli_stmt_close($stmt6244);
					
				}
			}
		}
    }

    function logout(){
        session_destroy();
        redirect('login.php');
    }
    
    
?>