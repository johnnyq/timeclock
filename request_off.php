<?php

include("admin/config.php");

if(isset($_POST['pin'])){
  
  $pin = intval($_POST['pin']);
  
  $query = mysqli_query($db_conn,"SELECT * FROM employees WHERE employee_pin = $pin");
  
  if(mysqli_num_rows($query) > 0){

    $row = mysqli_fetch_array($query);
    
    $employee_id = $row['employee_id'];
    $name = $row['employee_name'];

?>

    <!doctype html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <title>Time clock</title>
      </head>
      <body>

        <div class="bg-dark text-center p-5 mb-3">
          <h1 class="text-white display-4">Hello, <?php echo $name; ?></h1>
          <h2 class="text-secondary"><?php echo date("l, F jS", time()); ?></h2>
          <h1 class="text-white"><?php echo date("g:i A", time()); ?></h1>
          <h1 class="text-white">Time Off Request</h1>
        </div>

        <div class="container text-center">
          <div class="row justify-content-sm-center">
            <div class="col-sm-6">
              <form method="post" action="post.php">
                <input type="date" class="form-control form-control-lg mb-3" name="date">
                <textarea class="form-control form-control-lg mb-3" name="note"></textarea>
                <button class="btn btn-primary btn-lg btn-block" type="submit"><h1>Request Off</h1></button>
              </form>
              <a href="logged_in.php" class="btn btn-danger btn-lg btn-block p-4 mb-3"><h1>Go Back</h1></a>
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