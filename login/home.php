<?php 
session_start();
    include_once '../include/class.user.php';
    $user = new User();

    $uid = $_SESSION['uid'];

    if (!$user->get_session()){
       header("Location: login.php");
    }

    if (isset($_GET['q'])){
        $user->user_logout();
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
  </head>

  <body>
    <div id="container" class="container">
      <div id="header">
        <a href="home.php?q=logout">LOGOUT</a>
      </div>
      <div id="main-body">
        <br/>
        <br/>
        <br/>
        <br/>
		<center>
			<h1>
			<br>
			<br>Status: <? echo $user->get_status($uid); ?> <!-- same as echo -->
			<br>Hello <?php echo $user->get_fname($uid); ?></h1>
			<a href="../profiles/profiles.php">Edit Profile</a>
		</center>
		<img src="../assets/images/vegeta.jpg" alt="welcome"/><br>
		<br>Full name:<?php echo $user->get_fname($uid);?>
		<br>Last name:<?php echo $user->get_lname($uid);?>
		<br>Email:<?php echo $user->get_uemail($uid);?>
      </div>
      <div id="footer"></div>
    </div>
  </body>

</html>