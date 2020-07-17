<?php
include 'include.php';
if ($_COOKIE['logged'] == 'True') {
	$good = True;
	$result = mysqli_query($server, "select * from users where username = '".$_COOKIE['username']."'");
	$user = mysqli_fetch_assoc($result);

}elseif ($_COOKIE['logged'] == 'False') {
	echo'<script typy="javascript">alert(\'Incorrect username or password\');window.location.replace("index.php");</script>';
}else{
	$result = mysqli_query($server, "select * from users where username = '".$_POST['username']."'");
	if (mysqli_num_rows($result) > 0){
		while ($row = mysqli_fetch_assoc($result)) {
			if (password_verify($_POST['password'], $row['password']) > 0){
				setcookie('logged', 'True');
				setcookie('username', $_POST['username']);
				setcookie('password',$_POST['password']);
				$user = $row;
			}else{
				echo'<script typy="javascript">alert(\'Incorrect username or password\');window.location.replace("index.php");</script>';
			}
		}
	}else{
		echo'<script typy="javascript">alert(\'Incorrect username or password\');window.location.replace("index.php");</script>';
	}
}
if (isset($_POST['haha'])){
	echo "string";
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
	<div id="nav"  align="center">
		<table>
			<tr>
				<td><form action="feed.php"><button type="submit" style="zoom:1.8;">My profile</button></form></td>
				<td><form action="users.php"><button type="submit" style="zoom:1.8;">Users</button></form></td>
				<td><form action="friends.php"><button type="submit" style="zoom:1.8;">Friends</button></form></td>
				<td><form action="chats.php"><button type="submit" style="zoom:1.8;">Chats</button></form></td>
				<td><form action="exit.php"><button type="submit" style="zoom:1.8;">Exit</button></form></td>
			</tr>
		</table>
	</div>
<div align="center">
	<div>
		<h1>My profile</h1>
		<table>
			<tr>
				<td>
					<img id="photoimage" src="media/images/default.jpg" style="width:90px;height:120px"><br>
					<input type="file" value="Change photo" name="photo" style="width: 90px">
				</td>
				<td>
					<div class="group"><label class="profile_label"for="photoimage">Name:<?php echo $user['name']; ?></label></div>
					<div class="group"><label class="profile_label"for="photoimage">Surname:<?php echo $user['surname']; ?></label></div>
					<div class="group"><label class="profile_label"for="photoimage">Username:<?php echo $user['username']; ?></label></div>
					<div class="group"><label class="profile_label"for="photoimage">Password:<?php echo $_COOKIE['password']; ?></label></div>
					<form action="change.php"><input type="submit" name="her" value="Change profile"/></form>
			
				</td>
			</tr>
		</table>
	</div>
</div>
</body>
</html>