<?php if($_COOKIE['logged']=='True'){header('Location: feed.php');}?>
<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
<form method="post" action="feed.php">
	<div align="center">
		<fieldset>
			<legend>Login</legend>
			<input type="text" name="username" placeholder="Username" autocomplete="off"><br>
			<input type="password" name="password" placeholder="Password" autocomplete="off">
			<input type="submit" name="submit" value="Login">
			<button onclick="location.href='registr.php'" type="button">Registration</button>
		</fieldset>
	</div>
</form>
</body>
</html>