<?php
$back = $_SERVER['HTTP_REFERER'];
if(empty($_COOKIE['username'])){
	header('Location:/site/syte1.php ');
}
?>
<html> 
<head>
<link rel="stylesheet" href="style.css"> 
</head> 
<body> 
<div class="wrapper"> 
<div class="header"> 
	<h1><li><a href="syte.php">Новости</a></li></h1>
</div> 

<div class="enter">
<?php
	if(empty($_COOKIE['username'])) {
?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	<input type="text" placeholder="логин" name="username"><br>
	<input type="password" placeholder="пароль" name="password"><br>
	<button type="submit" name="submit">Вход</button>
	<button><a href="signup.php">Регистрация</a>
	</form>
<?php
}
else {
	?>
	<div class="exit">
	<h1>пользователь:</h1>
	<h2><?php echo $_COOKIE['username']; ?></h2>
	<p><a href="exit.php">Выйти</a></p>
	</div>
<?php	
}
?>
</div>
<div class="time">
<?php
    echo "Сегодня - ".date("d F Y")."<br>";
    echo "Текущее время - ".date("H:i");
?>
</div>
<div class="menu"> 
	<ul> 
	<li><a href="syte.php">Главная</a></li> 
	<li><a href="new.php">Написать статью</li></a>
    <li><a href="edit.php">Редактировать</a></li>
	<li><a href="delete.php">Удалить</a></li>
	</ul> 
</div> 
<div class="panel"> 
	<div class="panelLeft">
		<ul>
		<?php 
		$dir = "texts/"; 
		if (is_dir($dir)){ 
			if ($dh = opendir($dir)){				
				while (($file = readdir($dh)) !== false){
				if($file!="." and $file!=".."){
					echo "<a href=edit.php?file=$file>$file</a></br>";
					}	
				} 
				closedir($dh); 
			} 
		} 
		?> 
		</ul>
	</div> 
	<div class="EditText">
   <?php
    if(isset($_POST['file'])){
	   $file=$_POST['file'];
	   $text=$_POST['text'];
	   $initialFileName = $_POST['initialFileName'];
	   $initialText = $_POST['initialText'];
	   if ($file !== $initialFileName or $text !== $initialText) {
		unlink($dir.$initialFileName);
	   }
 
	   file_put_contents($dir.$file,$text);
	}elseif(isset($_GET['file'])){
	$file=$_GET['file'];
	$text=file_get_contents("texts/".$file);
   }else{
	   $file="";
	   $text="";

   }
   ?>
   	<form method="post" action="edit.php" class="EditText">
	<input type="text" name="file" placeholder="Выберите статью" value=<?php echo $file; ?>>
	<input type="hidden" name="initialFileName" value="<?= $file ?>">
	<br>
	<textarea name="text"placeholder="Текст"><?php echo $text; ?></textarea>
	<input type="hidden" name="initialText" value="<?= $text ?>">
	<br> 
	<input type="submit" value="Отредактировать">
	</div> 
</div> 
</div> 
</body> 
</html>	