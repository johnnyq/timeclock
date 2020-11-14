<?php

include("admin/config.php");

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

    <div class="bg-dark text-center p-5 mb-5">
      <h1 class="text-white display-4">Time Clock</h1>
    </div>

    <div class="container text-center">
      <div class="row justify-content-sm-center">
        <div class="col-sm-6">
      
          <form method="post" action="logged-in.php">
            <input type="number" class="form-control form-control-lg mb-3" name="pin" placeholder="Enter Pin Number">
            <button class="btn btn-primary btn-lg btn-block" type="submit"><h1>Sign In</h1></button>
          </form>
        </div>
      </div>
    </div>

    <script src="js/jquery.min.js"></script>  
    <script src="js/bootstrap.bundle.min.js"></script>

  </body>
</html>