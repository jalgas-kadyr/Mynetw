<?php 
include 'include.php';
if (isset($_POST['add_friend'])){
	$res = mysqli_query($server, "SELECT id FROM users WHERE username ='".$_COOKIE['username']."'");
	$data = mysqli_fetch_assoc($res);
	$user_id = $data['id'];
	$res = mysqli_query($server, "SELECT id FROM users WHERE username ='".$_POST['username']."'");
	$data = mysqli_fetch_assoc($res);
	$usver_id = $data['id'];
	mysqli_query($server,"INSERT INTO friends(user_id, friend_id) VALUES(".$user_id.",".$usver_id.")");
	mysqli_query($server,"INSERT INTO friends(friend_id, user_id) VALUES(".$user_id.",".$usver_id.")");
	mysqli_query($server, "INSERT INTO chats(user, friend) VALUES('".$_COOKIE['username']."', '".$_POST['username']."')");
}
$result = mysqli_query($server, "SELECT * from users WHERE username = '".$_POST['username']."'");
$user = mysqli_fetch_assoc($result);
$isfriend = isfriend($server, $_COOKIE['username'], $_POST['username']);

?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_POST['username']; ?></title>
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
		<h1>User detail</h1>
		<table>
			<tr>
				<td>
					<img id="photoimage" src="media/images/default.jpg" style="width:90px;height:120px"><br>
				</td>
				<td>
					<div class="group"><label class="profile_label"for="photoimage">Name:<?php echo $user['name']; ?></label></div>
					<div class="group"><label class="profile_label"for="photoimage">Surname:<?php echo $user['surname']; ?></label></div>
					<div class="group"><label class="profile_label"for="photoimage">Username:<?php echo $user['username']; ?></label></div>
					<?php
					if ($isfriend == True){
						$res = mysqli_query($server, "SELECT chat_id FROM chats WHERE user = '".$_COOKIE['username']."' and friend = '".$_POST['username']."' or user = '".$_POST['username']."' and friend = '".$_COOKIE['username']."'");
						$data = mysqli_fetch_assoc($res);
						$chat_id = $data['chat_id'];
						echo '<form action="chat.php" method="post">
						<button type="submit" name="reciver" value="'.$_POST['username'].'">Send message</button>
						<input name = "chat" value="'.$chat_id.'"  style="visibility: hidden;">
						</form>';
					}else{
						echo '<form action="" method="post">
								<button type="submit" name="username" value="'.$_POST['username'].'">Add to friends</button>
								<input name = "add_friend" value="test"  style="visibility: hidden;">
							</form>';
					}
					?>
					
				</td>
			</tr>
		</table>
	</div>
</div>
</body>
</html>