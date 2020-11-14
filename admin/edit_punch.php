<?php

include("config.php");
include("check_login.php");
include("header.php");
include("nav.php");

if(isset($_GET['punch_id'])){
	
	$punch_id = intval($_GET['punch_id']);
	
	$query = mysqli_query($db_conn,"SELECT * FROM punches, employees WHERE employees.employee_id = punches.employee_id AND punch_id = $punch_id");
	
	$row = mysqli_fetch_array($query);
	
	$name = $row['employee_name'];
	$date = date("Y-m-d",strtotime($row['punch_time_in']));
	$time_in = date("H:i",strtotime($row['punch_time_in']));
	$time_out = $row['punch_time_out'];

?>

<nav>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="employees.php">Employees</a></li>
		<li class="breadcrumb-item"><a href="employees.php"><?php echo $name; ?></a></li>
		<li class="breadcrumb-item active">Edit Punch</li>
	</ol>
</nav>

<?php 

	if(isset($_SESSION['response'])){
		echo $_SESSION['response'];
		$_SESSION['response'] = '';
	}

?>

<h1><?php echo $time_in; ?></h1>

<form action="post.php" method="post">
	<input type="hidden" name="punch_id" value="<?php echo $punch_id; ?>">
	<input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
	<input type="hidden" name="date" value="<?php echo $time_in; ?>">
	<div class="form-group">
		<input type="time" class="form-control" name="time_in" value="<?php echo $time_in; ?>">
	</div>
	<div class="form-group">
		<input type="time" class="form-control" name="time_out" value="<?php echo $time_out; ?>">
	</div>
	<button type="submit" class="btn btn-primary btn-block" name="edit_punch">Submit</button>
</form>

<?php 
	
}

include("footer.php");

?>