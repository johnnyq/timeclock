<?php

include("config.php");
include("check_login.php");
include("header.php");	
include("nav.php");

?>

<nav>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="employees.php">Employees</a></li>
		<li class="breadcrumb-item active">Add</li>
	</ol>
</nav>

<form action="post.php" method="post">
	<div class="form-group">
		<label>Name</label>
		<input type="text" class="form-control" name="name" autofocus>
	</div>
	<div class="form-group">
		<label>Pin</label>
		<input type="number" class="form-control" name="pin">
	</div>
	<button type="submit" class="btn btn-primary btn-block" name="add_employee">Submit</button>
</form>

<?php 

include("footer.php");

?>