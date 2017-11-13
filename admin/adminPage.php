<?php 
session_start();
include_once '../include/class.user.php';
$user = new User();

$uid = $_SESSION['uid'];

if (!$user->get_session()){
    header("location:../login/login.php");
}

if (isset($_GET['q'])){
    $user->user_logout();
    header("location:../login/login.php");
}
?>

<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../assets/css/custom.css">

<center>
<div id="header">
  <a href="adminPage.php?q=logout">LOGOUT</a>
</div>
  <br>Hello welcome <h3><?php $user->get_fname($uid); ?></h3> so good to see you<br>
  <br>Status:<h3><?= $user->get_status($uid);?></h3> <!-- same as echo --><br>   
        <!--  Your Permissions:  -->
        <?php //	$user->get_cname($uid);?>    
    <img src="add picture here" alt="ProfilePicture"/><br>
  <br>Full name:<?php $user->get_fname($uid);?>
  <br>Last name:<?php $user->get_lname($uid);?>
  <br>Email:<?php $user->get_uemail($uid);?>
</center>
<?php

$role = $user->fetch_role($uid);

if($role == 'guest')
{
echo "guest content";
}
elseif($role == 'member')
{
echo "member content";
}
elseif($role == 'moderator')
{
echo "moderator content";}
elseif($role == 'admin')
{
echo "admin content";
}
?>