<!DOCTYPE html>
<html>
<head>
	<title>Main page</title>
	<script type="text/javascript" src="script.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
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
	<div align="center" style="font-size: 20px">
		<h1>Users</h1>
		<?php
include('include.php');
$users = mysqli_query($server, "SELECT * FROM users WHERE NOT username = '".$_COOKIE['username']."'");
while ($row = mysqli_fetch_assoc($users)) {
	echo '<form action="userdetail.php" method="post" style="margin:2px;"><a href="#" onclick="this.parentNode.submit();" 2>'.$row['username'].'</a><input name = "username" value="'.$row['username'].'"  style="visibility: hidden;"></form>';
}
?>
	</div>
</body>
</html>
