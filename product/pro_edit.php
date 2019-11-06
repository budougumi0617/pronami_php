<?php
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';

sessionCheck();

$id = $_GET['id'];

$sql = 'SELECT name, price, gazou FROM mst_product WHERE id=?';

try {
    $dbh = getDBHandler();

    $stmt = $dbh->prepare($sql);
    $data[] = $id;
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $pro_name = $rec['name'];
    $pro_price = $rec['price'];
    $pro_file_old = $rec['gazou'];

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
商品修正<br/>
<br/>
商品コード<br/>
<? echo $id ?>
<br/>
<br/>
<form action="pro_edit_check.php" method="post", enctype="multipart/form-data">
    <input type="hidden" name="id" value="<? echo $id ?>">
    <input type="hidden" name="gazou_name_old" value="<? echo $pro_file_old ?>">
    商品名<br/>
    <input type="text" name="name" style="width: 200px" value="<? echo $pro_name ?>"><br/>
    価格<br/>
    <input type="text" name="price" style="width: 50px" value="<? echo $pro_price ?>"><br/>
    <? if ($pro_file_old != '') : ?>
        <img src="../gazou/<? echo $pro_file_old ?>"><br/>
    <? endif; ?>
    画像を選んでください<br/>
    <input type="file" name="gazou_name" style="width: 400px"><br/>
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
</form>
</body>
</html>
