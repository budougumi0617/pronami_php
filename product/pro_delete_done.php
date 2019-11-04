<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
<?php
// TODO CSRF対策をしないといけない
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';

$pro_id = h($_POST['id']);

$sql = 'DELETE from mst_product WHERE id=?';

try {
    $dbh = getDBHandler();

    $stmt = $dbh->prepare($sql);
    $data[] = $pro_id;
    $stmt->execute($data);

    $dbh = null; // GCを促してDBへのコネクションを切断している。
} catch (Exception $e) {
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
削除しました。<br/>
<br/>
<a href="pro_list.php">戻る</a>
</body>
</html>
