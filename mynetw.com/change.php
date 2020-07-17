<?php
include('include.php');
if(array_key_exists('her', $_POST)){
	if ($_POST['her'] == 'Cancel'){
		header('Location:feed.php');
	}
	else{
		$res=mysqli_query($server,'SELECT * FROM users WHERE username = \''.$_POST['surname'].'\'');
		if(mysqli_num_rows($res)!=0){
			echo'<script typy="javascript">alert(\'A user with this username already exists\');window.location.replace("index.php");</script>';
		}else{
			$res = mysqli_query($server, "select * from users where username='".$_COOKIE['username']."'");
			$row = mysqli_fetch_assoc($res);
			$sql = "UPDATE users SET name = '".$_POST['name']."', surname = '".$_POST['surname']."' ,username = '".$_POST['username']."' , password = '".password_hash($_POST['password'], PASSWORD_DEFAULT)."' where id = ".$row['id'];
			$change = mysqli_query($server, $sql);
			if ($change){
				header('Location:feed.php');
				setcookie('username', $_POST['username']);
				setcookie('password', $_POST['password']);
			}
			else{
				echo $sql;
				echo "<br>";
				echo "select * from users where username='".$_POST['username']."'";
			}
		}
		
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Main page</title>
	<script type="text/javascript" src="script.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body id="new">
<div align="center">
	<h1>Change profile</h1>
	<form autocomplete="off" method="post">
		<div class="group"><input name="name" type="text" name="" placeholder="Name" autocomplete="off"></div>
		<div class="group"><input name="surname"type="text" name="" placeholder="Surname" autocomplete="off"></div>
		<div class="group"><input name="username"type="text" name="" placeholder="Username" autocomplete="new-username"></div>
		<div class="group"><input name="password"type="password" name="" placeholder="Password" autocomplete="new-password"></div>
		<input type="submit" name="her" value="Save and back"/>
		<input type="submit" name="her" value="Cancel"/>
	</form>
</div>
</body>
</html>