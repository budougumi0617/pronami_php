<?php
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';

$id = $_GET['id'];

$sql = 'SELECT name FROM mst_product WHERE id=?';

try {
    $dbh = getDBHandler();

    $stmt = $dbh->prepare($sql);
    $data[] = $id;
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $pro_name = $rec['name'];

    $dbh = null; // GCを促してDBへのコネクションを切断している。
} catch (Exception $e) {
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>

<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
商品削除<br/>
<br/>
商品コード<br/>
<? echo $id ?>
<br/>
商品名<br/>
<? echo $pro_name ?>
<br/>
この商品を削除してよろしいですか？<br/>
<br/>
<form action="pro_delete_done.php" method="post">
    <input type="hidden" name="id" value="<? echo $id ?>">
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
</form>
</body>
</html>