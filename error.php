<?php
$back = $_SERVER['HTTP_REFERER'];
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
<html>
<head>
<link rel="stylesheet" href="style.css"> 
</head> 
<body>
<p>"Извините, Вы допустили некорректный ввод логина/пароля. Повторите ввод"</p>
</body>
</html>