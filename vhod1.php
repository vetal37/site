<?php
$dbc = mysqli_connect('localhost', 'root', '', 'reg');
if(!isset($_COOKIE['user_id'])) {
	if(isset($_POST['submit'])) {
		$user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
		$user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
		if(!empty($user_username) && !empty($user_password)) {
			$query = "SELECT `user_id` , `username` FROM `signup` WHERE username = '$user_username' AND password = SHA('$user_password')";
			$data = mysqli_query($dbc,$query);
			if(mysqli_num_rows($data) == 1) {
				$row = mysqli_fetch_assoc($data);
				setcookie('user_id', $row['user_id'], time() + (60*60*24));
				setcookie('username', $row['username'], time() + (60*60*24));
				header('Location:/site/syte.php ');
			}
			else{
				header('Location:/site/error.php ');
				echo '<strong>Ошибка ввода</strong>';
			}
		}
		else{
			header('Location:/site/error.php ');
			echo '<strong>Ошибка ввода</strong>';
		}
	}
}
?>