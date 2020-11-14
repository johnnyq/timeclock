<?php

include("config.php");
include("check_login.php");
include("header.php");
include("nav.php");

$current_uri = basename($_SERVER['REQUEST_URI']);
$encoded_uri = urlencode($current_uri);

if(isset($_GET['employee_id'])){
	
	$employee_id = intval($_GET['employee_id']);
	
	$query = mysqli_query($db_conn,"SELECT * FROM employees WHERE employee_id = $employee_id");
	
	$row = mysqli_fetch_array($query);
	
	$name = $row['employee_name'];
	$pin = $row['employee_pin'];
	$active = $row['employee_active'];

?>

<nav>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="employees.php">Employees</a></li>
		<li class="breadcrumb-item active"><?php echo $name; ?></li>
	</ol>
</nav>

<div class="row">
	<div class="col-md-4">
		
		<div class="card mb-3">
			<h3 class="card-header"><?php echo $name; ?></h3>
			<div class="card-body">
				<p>Pin: <?php echo $pin; ?></p>
				<p>20 Hours this week</p>
				<p>5 Upcoming Days off</p>
				<p>Clocked In 10AM</p>
				<p>2 Missed punch outs</p>
				<p>
			</div>
		</div>

	</div>

	<div class="col-md-8">

		<ul class="nav nav-pills nav-fill border bg-light p-2 mb-3" id="pills-tab">
			<li class="nav-item">
		    	<a href="?employee_id=<?php echo $employee_id; ?>&tab=punches" class="nav-link <?php if($_GET['tab'] == "punches") { echo "active"; } ?>">Punches</a>
			</li>
			<li class="nav-item">
		    	<a href="?employee_id=<?php echo $employee_id; ?>&tab=time_off" class="nav-link <?php if($_GET['tab'] == "time_off") { echo "active"; } ?>">Time Off</a>
			</li>
			<li class="nav-item">
		    	<a href="?employee_id=<?php echo $employee_id; ?>&tab=edit" class="nav-link <?php if($_GET['tab'] == "edit") { echo "active"; } ?>">Edit</a>
			</li>	
		</ul>
		
		<?php 

		if($_GET['tab'] == "punches"){ 

		?>

			<?php

			if(!empty($_GET['date_from'])){
				$date_from = $_GET['date_from'];
				$date_to = $_GET['date_to'];
			}else{
				$date_from = date("Y-m-d",time());
				$date_to = date("Y-m-d",time());
			} 

			$query = mysqli_query($db_conn,"SELECT * FROM punches WHERE employee_id = $employee_id AND DATE(punch_time_in) BETWEEN '$date_from' AND '$date_to' ORDER BY punch_time_in DESC");

			?>


			<form>
				<input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
				<input type="hidden" name="tab" value="<?php echo $_GET['tab']; ?>">

				<div class="form-row">
					<div class="col-md-3 mb-3">
			        	<input type="date" class="form-control" name="date_from" value="<?php echo $date_from; ?>">
			        </div>
			        <div class="col-md-3 mb-3">    	
			        	<input type="date" class="form-control" name="date_to" value="<?php echo $date_to; ?>">
			        </div>
			        <div class="col-md-2">
			        	<button class="btn btn-outline-secondary btn-block mb-3">Search</button>
			       	</div>
					<div class="col-md-2 offset-md-2 mb-3">
						<a href="#" class="btn btn-dark btn-block" data-toggle="modal" data-target="#addPunchModal">Add Punch</a>
					</div>
				</div>
			</form>

			<table class="table border">
				<thead class="thead-light">
					<tr>
						<th>Date</th>
						<th>In Time</th>
						<th>Out Time</th>
						<th></th>
					</tr>
				</thead>
				<tbody>


				<?php

				while($row = mysqli_fetch_array($query)){
		
					$punch_id = $row['punch_id'];
					$date = date("l, M jS",strtotime($row['punch_time_in']));
					$time_in = date("g:i A",strtotime($row['punch_time_in']));
					$time_out = $row['punch_time_out'];
					if($time_out == '0000-00-00 00:00:00'){
						$time_out_disp = "-";
					}else{
						$time_out_disp = date("g:i A",strtotime($row['punch_time_out']));
					}
					$date_edit = date("Y-m-d",strtotime($row['punch_time_in']));
					$time_in_edit = date("h:i",strtotime($row['punch_time_in']));
					$time_out_edit = date("h:i",strtotime($row['punch_time_out']));

				?>

					<tr>
						<td><?php echo $date; ?></td>
						<td><?php echo $time_in; ?></td>
						<td><?php echo $time_out_disp; ?></td>
						<td class="text-center">
							<a href="#" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editPunchModal<?php echo $punch_id; ?>">Edit</a>
							<a href="post.php?delete_punch=<?php echo $punch_id; ?>&current_uri=<?php echo $encoded_uri; ?>" class="btn btn-sm btn-outline-danger">Del</a>
						</td>
					</tr>
					<?php include("edit_punch_modal.php"); ?>
				<?php
				}
				?>

				</tbody>
			</table>

		<?php 
		
		} 
		
		?>

		<?php 

		if($_GET['tab'] == "edit"){

		?>
  		
	  		<form class="border p-3" action="post.php" method="post">
				
				<input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
				<div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
				</div>
				<div class="form-group">
					<label>Pin</label>
					<input type="number" class="form-control" name="pin" value="<?php echo $pin; ?>">
				</div>
				<button type="submit" class="btn btn-primary btn-block" name="edit_employee">Submit</button>
			
			</form>
		
		<?php

		}

		?>
		
	</div>

<?php 

include("add_punch_modal.php");
	
}


include("footer.php");

?>