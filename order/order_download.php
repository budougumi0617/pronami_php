<?php
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common/common.php';
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';

sessionCheck();
?>

<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
ダウンロードしたい注文日を選んでください。<br/>
<form action="order_download_done.php" method="post">
    <? pulldown_year(); ?>
    年
    <? pulldown_month(); ?>
    <? pulldown_day(); ?>
    日<br/>
    <br/>
    <input type="submit" value="ダウンロードへ">
</form>
</body>
</html>