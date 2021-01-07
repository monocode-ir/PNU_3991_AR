<?php
  session_start();

  if (!isset($_SESSION['username'])) {
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

<div class="header">
	<h2>صفحه ی اصلی</h2>
</div>
<div class="content">
  	<!-- notification message -->

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p class="notification">خوش آمدید  <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a class="button is-danger" href="index.php?logout='logout'" >خروج</a> </p>
    <?php endif ?>
</div>

</body>
</html>
