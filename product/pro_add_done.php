<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
<?php
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';

$pro_name = h($_POST['name']);
$pro_price = h($_POST['price']);

$sql = 'INSERT INTO mst_product(name, price, gazou) VALUES (?, ?, ?)';

try {
    $dbh = getDBHandler();

    $stmt = $dbh->prepare($sql);
    $data[] = $pro_name;
    $data[] = $pro_price;
    $data[] = '';
    $stmt->execute($data);

    $dbh = null; // GCを促してDBへのコネクションを切断している。

    echo $pro_name . 'を追加しました。<br/>';
} catch (Exception $e) {
    echo $e;
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
<a href="pro_list.php">戻る</a>
</body>
</html>
