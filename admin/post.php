<?php
	
include("config.php");

session_start();

if(isset($_GET['logout'])){

	session_destroy();
	header('Location: login.php');

}

if(isset($_GET['clockin'])){
	$employee_id = intval($_GET['clockin']);

	mysqli_query($db_conn,"INSERT INTO punches SET punch_time_in = NOW(), punch_time_out = '0000-00-00 00:00:00', employee_id = $employee_id") OR DIE("ERROR!");

	header("Location: ../index.php");

}

if(isset($_GET['clockout'])){
	$punch_id = intval($_GET['clockout']);

	mysqli_query($db_conn,"UPDATE punches SET punch_time_out = NOW() WHERE punch_id = $punch_id") OR DIE("ERROR!");

	header("Location: ../index.php");

}

if(isset($_POST['login'])){
  
	$email = mysqli_real_escape_string($db_conn,$_POST['email']);
	$password = md5($_POST['password']);

	$sql = mysqli_query($db_conn,"SELECT * FROM users WHERE user_email = '$email' AND user_password = '$password'");

	if(mysqli_num_rows($sql) == 1){
		$row = mysqli_fetch_array($sql);
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['user_email'] = $row['user_email'];
		  
		header("Location: index.php");

	}else{

		$_SESSION['response'] = "
			<div class='alert alert-danger'>
			    Incorrect username or password.
			    <button class='close' data-dismiss='alert'>
					<span>&times;</span>
				</button>
			</div>
		";

		header("Location: login.php");
	
	}
}

if(isset($_POST['forgot_password'])){
  
	$email = mysqli_real_escape_string($db_conn,$_POST['email']);

	$sql = mysqli_query($db_conn,"SELECT * FROM users WHERE user_email = '$email'");

	if(mysqli_num_rows($sql) == 1){
		$row = mysqli_fetch_array($sql);

		$user_id = $row['user_id'];
		
		function generateRandomString($length = 10) {
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
		    return $randomString;
		}

		$token = generateRandomString();
		
		$url = "https://" . $_SERVER['HTTP_HOST'] . "/" . basename(__DIR__);

		mysqli_query($db_conn,"UPDATE users SET user_token = '$token' WHERE user_id = $user_id");

		mail("$email","Password Reset Request","$url/reset_password.php?user_id=$user_id&token=$token");
		  
		$_SESSION['response'] = "
			<div class='alert alert-success'>
				We just sent a password reset link to your email!
				<button class='close' data-dismiss='alert'>
					<span>&times;</span>
				</button>
			</div>
		";

		header("Location: forgot_password.php");

	}else{

		$_SESSION['response'] = "
			<div class='alert alert-danger'>
			    Email doesn't exist!
			    <button class='close' data-dismiss='alert'>
					<span>&times;</span>
				</button>
			</div>
		";

		header("Location: forgot_password.php");
	
	}
}

if(isset($_POST['reset_password'])){
  
	$user_id = intval($_POST['user_id']);
	$password = md5($_POST['password']);

	mysqli_query($db_conn,"UPDATE users SET user_password = '$password', user_token = '' WHERE user_id = $user_id");

	$_SESSION['response'] = "
		<div class='alert alert-info'>
		    Password has been reset please login with you new password.
		    <button class='close' data-dismiss='alert'>
				<span>&times;</span>
			</button>
		</div>
	";
		  
	header("Location: login.php");

}

if(isset($_SESSION['user_id'])){

	$session_user_id = $_SESSION['user_id'];

	if(isset($_POST['add_employee'])){
		$name = trim(strip_tags(mysqli_real_escape_string($db_conn,$_POST['name'])));
		$pin = intval($_POST['pin']);

		mysqli_query($db_conn,"INSERT INTO employees SET employee_name = '$name', employee_pin = $pin, employee_active = 1") OR DIE("ERROR!");

		header("Location: employees.php");

	}

	if(isset($_POST['edit_employee'])){
		$employee_id = intval($_POST['employee_id']);
		$name = trim(strip_tags(mysqli_real_escape_string($db_conn,$_POST['name'])));
		$pin = intval($_POST['pin']);

		mysqli_query($db_conn,"UPDATE employees SET employee_name = '$name', employee_pin = $pin WHERE employee_id = $employee_id");

		header("Location: employees.php");

	}

	if(isset($_GET['disable_employee'])){
		$employee_id = intval($_GET['disable_employee']);

		mysqli_query($db_conn,"UPDATE employees SET employee_active = 0 WHERE employee_id = $employee_id");

		header("Location: employees.php");

	}

	if(isset($_GET['enable_employee'])){
		$employee_id = intval($_GET['enable_employee']);

		mysqli_query($db_conn,"UPDATE employees SET employee_active = 1 WHERE employee_id = $employee_id");

		header("Location: employees.php");

	}

	if(isset($_POST['add_user'])){
		$email = trim(strip_tags(mysqli_real_escape_string($db_conn,$_POST['email'])));
		$password = md5($_POST['password']);

		mysqli_query($db_conn,"INSERT INTO users SET user_email = '$email', user_password = '$password'");

		$_SESSION['response'] = "
			<div class='alert alert-success'>
			    User added.
			    <button class='close' data-dismiss='alert'>
					<span>&times;</span>
				</button>
			</div>
		";

		header("Location: users.php");

	}

	if(isset($_POST['edit_user'])){
		$user_id = intval($_POST['user_id']);
		$email = trim(strip_tags(mysqli_real_escape_string($db_conn,$_POST['email'])));
		$current_password_hash = $_POST['current_password_hash'];
	    $password = $_POST['password'];
	    if($current_password_hash == $password){
	        $password = $current_password_hash;
	    }else{
	        $password = md5($password);
	    }
		
		mysqli_query($db_conn,"UPDATE users SET user_email = '$email', user_password = '$password' WHERE user_id = $user_id");

		header("Location: edit_user.php?user_id=$user_id");

	}

	if(isset($_GET['delete_user'])){
		$user_id = intval($_GET['delete_user']);

		mysqli_query($db_conn,"DELETE FROM users WHERE user_id = $user_id");

		header("Location: users.php");

	}

	if(isset($_POST['add_punch'])){;
		$current_uri = mysqli_real_escape_string($db_conn,$_POST['current_uri']);
		$employee_id = intval($_POST['employee_id']);
		$date = strip_tags(mysqli_real_escape_string($db_conn,$_POST['date']));
		$time_in = strip_tags(mysqli_real_escape_string($db_conn,$_POST['time_in']));
		$time_in = "$date $time_in";
		$time_out = strip_tags(mysqli_real_escape_string($db_conn,$_POST['time_out']));
		if(empty($time_out)){
			$time_out = '0000-00-00 00:00:00';
		}else{
			$time_out = "$date $time_out";
		}

		mysqli_query($db_conn,"INSERT punches SET punch_time_in = '$time_in', punch_time_out = '$time_out', employee_id = $employee_id") OR DIE("ERROR!");

		header("Location: $current_uri");

	}

	if(isset($_POST['edit_punch'])){
		$current_uri = mysqli_real_escape_string($db_conn,$_POST['current_uri']);
		$punch_id = intval($_POST['punch_id']);
		$date = strip_tags(mysqli_real_escape_string($db_conn,$_POST['date']));
		$time_in = strip_tags(mysqli_real_escape_string($db_conn,$_POST['time_in']));
		$time_in = "$date $time_in";
		$time_out = strip_tags(mysqli_real_escape_string($db_conn,$_POST['time_out']));
		if(empty($time_out)){
			$time_out = '0000-00-00 00:00:00';
		}else{
			$time_out = "$date $time_out";
		}

		mysqli_query($db_conn,"UPDATE punches SET punch_time_in = '$time_in', punch_time_out = '$time_out' WHERE punch_id = $punch_id") OR DIE("ERROR!");

		header("Location: $current_uri");

	}

	if(isset($_GET['delete_punch'])){
		$punch_id = intval($_GET['delete_punch']);
		$current_uri = urldecode($_GET['current_uri']);

		mysqli_query($db_conn,"DELETE FROM punches WHERE punch_id = $punch_id");

		header("Location: $current_uri");

	}

}

?>