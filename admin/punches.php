<?php

include("config.php");
include("check_login.php");
include("header.php");
include("nav.php");

$query = mysqli_query($db_conn,"SELECT * FROM employees");

?>

<h1>Hours</h1>

<hr>

<div class="table-responsive">
	<legend>Week 2 (Feb 9 - 15)</legend>

	<table class="table border">
		<thead class="thead-light">
			<tr>
				<th>Employee</th>
				<th class="text-center">Sun</th>
				<th class="text-center">Mon</th>
				<th class="text-center">Tue</th>
				<th class="text-center">Wed</th>
				<th class="text-center">Thu</th>
				<th class="text-center">Fri</th>
				<th class="text-center">Sat</th>
				<th class="text-center">Total Hours</th>
			</tr>
		</thead>
		<tbody>
			
			<?php 

			while($row = mysqli_fetch_array($query)){
			
			$employee_id = $row['employee_id'];
			$name = $row['employee_name'];
			
			?>
			
				<tr>	
					<th><?php echo $name; ?></th>
					<td class="text-center">-</td>
					<td class="text-center">8</td>
					<td class="text-center">6</td>
					<td class="text-center">8</td>
					<td class="text-center">10</td>
					<td class="text-center">10</td>
					<td class="text-center">-</td>
					<th class="text-center">44</th>
				</tr>
			
			<?php 
			
			}

			?>
			<tr>
				<th colspan="8"></th>
				<th class="text-center">88</th>
			</tr>
		
		</tbody>
	</table>

</div>

<?php 

include("footer.php");

?>