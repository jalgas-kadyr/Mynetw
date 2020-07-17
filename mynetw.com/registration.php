<?php
include('include.php');
$res=mysqli_query($server,'SELECT * FROM users WHERE username = \''.$_POST['surname'].'\'');
if(mysqli_num_rows($res)==0){
	mysqli_query($server,"INSERT INTO users(name,surname,username,password)VALUES('".$_POST['name']."','".$_POST['surname']."','".$_POST['username']."','".password_hash($_POST['password'], PASSWORD_DEFAULT)."')");
	echo "<script typy='javascript'>window.location.replace('index.php');</script>";
}else{
	echo'<script typy="javascript">alert(\'A user with this username already exists\');window.location.replace("index.php");</script>';
}
?>