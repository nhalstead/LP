<?php 
session_start();
require_once('../include/class.user.php');
$user = new User();
$uid = $_SESSION['uid'];

if (!$user->get_session()){
    header("location: ../login/login.php");
	exit(); #Dont Leak any Data Pass this Point.
}

if (isset($_GET['q'])){
    $user->user_logout();
    header("location: ../login/login.php");
	exit(); #Dont Leak any Data Pass this Point.
}
?>

<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../assets/css/custom.css">

<center>
<div id="header">
  <a href="adminPage.php?q=logout">LOGOUT</a>
</div>
  <br>Hello Welcome <h3><?php echo $user->get_fname($uid); ?></h3> so good to see you<br>
  <br>Status:<h3><?php echo $user->get_status($uid); ?></h3> <!-- same as echo --><br>   
        <!--  Your Permissions:  -->
        <?php //$user->get_cname($uid); ?>    
    <img src="add picture here" alt="ProfilePicture"/><br>
  <br>Full name:<?php echo $user->get_fname($uid);?>
  <br>Last name:<?php echo $user->get_lname($uid);?>
  <br>Email:<?php echo $user->get_uemail($uid);?>
</center>
<?php

$role = $user->fetch_role($uid);

switch(strtoupper($role)){
	case "GUEST": 
		echo "Welcome Guest!";
	break;
	
	case "MEMBER":
		echo "Hello Memeber!";
	break;
	
	case "MODERATOR":
		echo "Hello Mod!";
	break;
	
	case "ADMIN":
		echo "Hello Admin!";
	break;
	
	case "":
		http_response_code(500);
		echo "Please contact support, You Account has on perms.";
		exit();
	break;
	default:
		http_response_code(500);
		echo "Programming Error! User has no case!";
		exit();
	break;
}
?>