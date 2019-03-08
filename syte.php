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
if(empty($_COOKIE['username'])){
	header('Location:/site/syte1.php ');
}else{
?>
	<div class="exit">
	<h1>пользователь:</h1>
	<h2><?php echo $_COOKIE['username']; ?></h2>
	<p><a href="exit.php">Выйти</a>
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
					echo "<a href=syte.php?file=$file>$file</a></br>";
					}	
				} 
				closedir($dh); 
			} 
		} 
		?> 
		</ul>
	</div> 
	<div class="panelRight">
	<?php 
		if(isset($_GET['file'])){
		$nazv=$_GET['file'];
		$contents=file_get_contents($dir.$_GET['file']);
		$contents=nl2br($contents);
		echo "<strong>$nazv</strong></br></br>";
		echo $contents;
		}
?> 
	</div>
	</div> 
</div> 
</div> 
</body> 
</html>