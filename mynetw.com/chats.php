<!DOCTYPE html>
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
		<h1>Chats</h1>
		<?php
		include 'include.php';   
		$res = mysqli_query($server, "SELECT * FROM chats WHERE user='".$_COOKIE['username']."' or friend='".$_COOKIE['username']."'");
		if (mysqli_num_rows($res) == 0){
			echo "<h4>Chats not found<h4>";
		}else{
			while($row = mysqli_fetch_assoc($res)){
				if ($row['friend'] == $_COOKIE['username']){
					$friend = $row['user'];
				}else{
					$friend = $row['friend'];
				}
				echo '
					<div align="center">
						<div style="border-radius: 5px; padding: 1px; border: solid 1px; width: 50%;" align="left">
							<form action="chat.php" method="post" style="margin:2px;">
								<a href="#" onclick="this.parentNode.submit();" 2>'.$friend.'</a>
								<input name = "chat" value="'.$row['chat_id'].'"  style="visibility: hidden;">
								<input name = "reciver" value="'.$friend.'"  style="visibility: hidden;">
								<label>Messages:'.$messages.'</label>
							</form>
						</div>
					</div>
				';
				
			}
		}
		?> 
	</div>
	
</body>
</html>

