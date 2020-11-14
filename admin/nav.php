
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Timeclock</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link <?php if(basename($_SERVER["PHP_SELF"]) == "punches.php") { echo "active"; } ?>" href="punches.php">Hours</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if(basename($_SERVER["PHP_SELF"]) == "punches.php") { echo "active"; } ?>" href="time_off_requests.php">Time off Requests</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if(basename($_SERVER["PHP_SELF"]) == "employees.php") { echo "active"; } ?>" href="employees.php">Employees</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if(basename($_SERVER["PHP_SELF"]) == "users.php") { echo "active"; } ?>" href="users.php">Users</a>
      </li>
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
          <?php echo $session_user_email; ?>
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="post.php?logout">Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>