<?php 
include'include.php';
print_r($_POST);
if (isset($_POST['send'])){

	mysqli_query($server,"INSERT INTO messages (chat_id, sender, recepient, messsage) VALUES (".$_POST['chat'].", '".$_COOKIE['username']."', '".$_POST['reciver']."', '".$_POST['message']."' );");
	echo "INSERT INTO messages (chat_id, sender, recepient, messsage) VALUES (".$_POST['chat'].", '".$_COOKIE['username']."', '".$_POST['reciver']."', '".$_POST['message']."' );";
}
$messages = mysqli_query($server,"select * from messages where chat_id = ".$_POST['chat']." ORDER BY message_id  DESC limit 50 ");

 ?><!DOCTYPE html>
<html>
<head>
	<title></title>
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
	<div align="center">
		<h1>Messages</h1>
		<div>

			<div style="border: solid 1px; border-radius:3px; width: 50%; padding: 5px;margin: 10px" align="left">
				<h3>Send message</h3>
				<form action="" method="post">
					From:<?php echo $_COOKIE['username']; ?><br>
					To:<?php echo $_POST['reciver']; ?><br>
					Message:<textarea name="message" id="" cols="70" rows="5"></textarea>
					<div align="center">
						<input name = "chat" value="<?php echo $_POST['chat'] ?>"  style="visibility: hidden;">
						<input name = "reciver" value="<?php echo $_POST['reciver'] ?>"  style="visibility: hidden;">
						<input type="submit" name="send" value="Send" style="">
					</div>
				</form>
			</div>
		</div>
		<div>
			<?php 
			if (!$messages) {

			}else{
				while ($message = mysqli_fetch_assoc($messages)) {
					echo '
					<div style="border: solid 1px; border-radius:3px; margin:10px; width: 50%; padding: 5px" align="left">
						From: '.$message['sender'].'<br>
						To: '.$message['recepient'].'<br>
						Text: '.$message['messsage'].'
					</div>
					';
				}
			}
			
			?>
		</div>
	</div>	
</body>
</html>

