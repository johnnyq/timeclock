<?php

include("admin/config.php");

if(isset($_POST['pin'])){
  
  $pin = intval($_POST['pin']);
  
  $query = mysqli_query($db_conn,"SELECT * FROM employees WHERE employee_pin = $pin");
  
  if(mysqli_num_rows($query) > 0){

    $row = mysqli_fetch_array($query);
    
    $employee_id = $row['employee_id'];
    $name = $row['employee_name'];

    $query_punch_status = mysqli_query($db_conn,"SELECT * FROM punches WHERE employee_id = $employee_id AND DATE(punch_time_in) = DATE(NOW()) AND punch_time_out = '0000-00-00 00:00:00' ORDER BY punch_time_in DESC LIMIT 1");
      
    $punch_status = mysqli_num_rows($query_punch_status);
     
    $row = mysqli_fetch_array($query_punch_status);
    
    $punch_id = $row['punch_id'];
    $punch_time_in = $row['punch_time_in'];
    $punch_time_out = $row['punch_time_out'];

?>

    <!doctype html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <title>TimeClock</title>
      </head>
      <body>

        <div class="bg-dark text-center p-5 mb-3">
          <h1 class="text-white display-4">Hello, <?php echo $name; ?></h1>
          <h2 class="text-secondary"><?php echo date("l, F jS", time()); ?></h2>
          <h1 class=" text-white"><?php echo date("g:i A", time()); ?></h1>
        </div>

        <div class="container text-center">
          <div class="row justify-content-sm-center">
            <div class="col-sm-6">
              <?php
              if($punch_status == 0){
              ?>
                <a href="admin/post.php?clockin=<?php echo $employee_id; ?>" class="btn btn-primary btn-lg btn-block p-4 mb-3"><h1>Clock In</h1></a>
              <?php
              }else{
              ?>
              <h2>Clocked in at: <?php echo $punch_time_in; ?></h2>
              <a href="admin/post.php?clockout=<?php echo $punch_id; ?>" class="btn btn-primary btn-lg btn-block p-4 mb-3"><h1>Clock Out</h1></a>
              <?php
              }
              ?>
              <a href="request_off.php?employee_id=<?php echo $employee_id; ?>" class="btn btn-secondary btn-lg btn-block p-4 mb-3"><h1>Request Off</h1></a>
              <button class="btn btn-dark btn-lg btn-block p-4 mb-3"><h1>View Hours</h1></button>
              <a href="index.php" class="btn btn-danger btn-lg btn-block p-4 mb-3"><h1>Sign Out</h1></a>
            </div>
          </div>
        </div>

        <script src="js/jquery.min.js"></script>  
        <script src="js/bootstrap.bundle.min.js"></script>

      </body>
    </html>

<?php
  }

}else{
  echo "Get the fuck out!!";
}

?>