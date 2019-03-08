<?php
unset($_COOKIE['user_id']);
unset($_COOKIE['username']);
setcookie('user_id', '', time()-(60*60), '/site');
setcookie('username', '', time()-(60*60), '/site');
header("Location: /site/syte1.php ");
?>