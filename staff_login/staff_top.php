<?php
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
ショップ管理メニュー<br/>
<br/>
<a href="../staff/staff_list.php">スタッフ管理</a><br/>
<a href="../product/pro_list.php">商品管理</a>
<br/>
<a href="../order/order_download.php">注文ダウンロード</a><br/>
<br/>
<a href="../staff/staff_logout.php">ログアウト</a>
</body>
</html>