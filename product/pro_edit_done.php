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
<?php
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';

$id = h($_POST['id']);
$pro_name = h($_POST['name']);
$pro_price = h($_POST['price']);
$pro_gazou_old = h($_POST['gazou_name_old']);
$pro_gazou = h($_POST['gazou_name']);

$sql = 'UPDATE mst_product SET name = ?, price = ?, gazou = ? WHERE id = ?';

try {
    $dbh = getDBHandler();

    $stmt = $dbh->prepare($sql);
    $data[] = $pro_name;
    $data[] = $pro_price;
    $data[] = $pro_gazou;
    $data[] = $id;
    $stmt->execute($data);

    $dbh = null; // GCを促してDBへのコネクションを切断している。

    if ($pro_gazou_old != '' && $pro_gazou_old != $pro_gazou) {
        unlink('../gazou/' . $pro_gazou_old);
    }
    echo '修正しました。<br/>';
} catch (Exception $e) {
    echo $e;
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
<a href="pro_list.php">戻る</a>
</body>
</html>
