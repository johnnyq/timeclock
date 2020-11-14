<?php

include("config.php");
include("check_login.php");
include("header.php");
include("nav.php");

if(isset($_GET['employee_id'])){
	
	$employee_id = intval($_GET['employee_id']);
	
	$query = mysqli_query($db_conn,"SELECT * FROM employees WHERE employee_id = $employee_id");
	
	$row = mysqli_fetch_array($query);
	
	$name = $row['employee_name'];
	$pin = $row['employee_pin'];

?>

<nav>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="employees.php">Employees</a></li>
		<li class="breadcrumb-item active">Edit / <?php echo $name; ?></li>
	</ol>
</nav>

<?php 

	if(isset($_SESSION['response'])){
		echo $_SESSION['response'];
		$_SESSION['response'] = '';
	}

?>

<form action="post.php" method="post">
	<input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
	<div class="form-group">
		<input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
	</div>
	<div class="form-group">
		<input type="number" class="form-control" name="pin" value="<?php echo $pin; ?>">
	</div>
	<button type="submit" class="btn btn-primary btn-block" name="edit_employee">Submit</button>
</form>

<?php 
	
}

include("footer.php");

?>