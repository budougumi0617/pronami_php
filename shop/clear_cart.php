<?php
session_start();
$_SESSION=array();
if (isset($_COOKIE[session_name()])){
    setcookie(session_name(), '',time()-42000,'/');
}
session_destroy();
?>

<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
カートを空にしました。
</body>
</html>