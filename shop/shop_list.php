<?php
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';

sessionCheckForMember();
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

$sql = 'SELECT id, name, price FROM mst_product WHERE 1';

try {
    $dbh = getDBHandler();

    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null; // GCを促してDBへのコネクションを切断している。

    echo '商品一覧<br/><br/>';
    while (true) {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$rec) {
            break;
        }
        echo '<a href="shop_product.php?id='.$rec['id'].'">';
        echo $rec['name'] . '---' . $rec['price'] . '</a><br/>';
    }
} catch (Exception $e) {
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
</body>
</html>
