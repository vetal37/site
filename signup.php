<?php
$back = $_SERVER['HTTP_REFERER'];
?>
<html>
<head>
<link rel="stylesheet" href="style.css"> 
</head> 
<body> 
<div class="wrapper"> 
<div class="header"> 
	<h1><li><a href="signup.php">Статьи</a></li></h1>
</div>
<div class="time">
<?php
    echo "Сегодня - ".date("d F Y")."<br>";
    echo "Текущее время - ".date("H:i");
?>
</div> 
<div class="menu_reg"> 
	<ul> 
	<li><a href="syte1.php">Вернуться на главную</a></li> 
	</ul> 
</div>
 
<div class="panelReg">
<?php
$dbc = mysqli_connect('localhost', 'root', '', 'reg') OR DIE('Ошибка подключения к базе данных');
if(isset($_POST['submit']))
{
	$username = mysqli_real_escape_string($dbc, trim($_POST['username']));
	$password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
	$password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
	if ($password1 != $password2 or empty($username))
	{
		echo '<strong>Ошибка ввода пароля</strong>';
	}
	else
	{
		
		if(!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) 
		{
			$query = "SELECT * FROM `signup` WHERE username = '$username'";
			$data = mysqli_query($dbc, $query);
			if(mysqli_num_rows($data) == 0) 
			{
				$query ="INSERT INTO `signup` (username, password) VALUES ('$username', SHA('$password2'))";
				mysqli_query($dbc,$query);
				echo '<strong>Можете авторизоваться</strong>';
				mysqli_close($dbc);
			}
			else 
			{
				echo '<strong>Ошибка ввода логина/пароля. Возможно, пользователь с такими данными существует в базе</strong>';
			}
		}
	}
}
?>
	<form method="POST" action="signup.php">
	<br><input type="text" placeholder="придумайте логин" name="username"><br>
	<input type="password" placeholder="придумайте пароль" name="password1"><br><br>
	<input type="password" placeholder="повторите пароль" name="password2"><br><br>
	<button type="submit" name="submit">Регистрация</button>
	</form>
</div> 
</div> 
</body> 
</html>