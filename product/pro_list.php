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
    echo '<form method="post" action="pro_branch.php">';
    while (true) {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$rec) {
            break;
        }
        echo '<input type="radio" name="id" value=' . $rec['id'] . '>';
        echo $rec['name'] . '---' . $rec['price'] . '<br/>';
    }
    // POSTリクエストにedit keyで修正がvalueとして飛ぶ
    echo '<input type="submit" name="disp" value="参照">';
    echo '<input type="submit" name="add" value="追加">';
    echo '<input type="submit" name="edit" value="修正">';
    echo '<input type="submit" name="delete" value="削除">';
    echo '</form>';
} catch (Exception $e) {
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
<br/>
<a href="../staff_login/staff_top.php">トップメニューへ</a>
</body>
</html>
