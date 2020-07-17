<?php
$server = mysqli_connect('127.0.0.1','root','');
$data = mysqli_query($server, 'show databases;');
$good = False;
while ($row = mysqli_fetch_assoc($data)){
	if ($row['Database'] == 'mynetw'){
		$good = True;
	}
}
if($good){
	$server = mysqli_connect('127.0.0.1','root','','mynetw');
}else{
	mysqli_query($server, 'create database `mynetw`');
	$server = mysqli_connect('127.0.0.1','root','','mynetw');
	$sql = 'CREATE TABLE users ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(30) NOT NULL, surname VARCHAR(30) NOT NULL, username VARCHAR(50), password VARCHAR(500))';
	mysqli_query($server, $sql);
	$sql = 'CREATE TABLE friends(user_id INT(6), friend_id INT(6))';
	mysqli_query($server, $sql);
	$sql = 'CREATE TABLE chats(chat_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, user VARCHAR(30), friend VARCHAR(30))';
	mysqli_query($server, $sql);
	$sql = 'CREATE TABLE messages(message_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY, chat_id INT(11), sender VARCHAR(50), recepient VARCHAR(50), messsage  VARCHAR(500))';
	mysqli_query($server, $sql);
}

function isfriend($server, $username, $friend_username){
	$result = mysqli_query($server, "SELECT * FROM users WHERE username = '".$friend_username."'");
	$data = mysqli_fetch_assoc($result);
	$friends_id = $data['id'];
	$result = mysqli_query($server, "SELECT * FROM users WHERE username = '".$username."'");
	$data = mysqli_fetch_assoc($result);
	$user_id = $data['id'];
	$result = mysqli_query($server , 'SELECT * FROM friends WHERE user_id = '.$user_id.' and friend_id='.$friends_id.' or user_id = '.$friends_id.' and friend_id='.$user_id.'');
	$rows = mysqli_num_rows($result);
	if ($rows == 0){
		return False;
	}else{
		return True;
	}
}
?>