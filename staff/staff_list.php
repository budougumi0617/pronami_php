<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
<?php
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';

$sql = 'SELECT id, name FROM mst_staff WHERE 1';

try {
    $dbh = getDBHandler();

    $stmt = $dbh->prepare($sql);
    $data[] = $staff_name;
    $data[] = $staff_pass;
    $stmt->execute($data);

    $dbh = null; // GCを促してDBへのコネクションを切断している。

    echo 'スタッフ一覧<br/><br/>';
    echo '<form method="post" action="staff_editt.php">';
    while (true) {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$rec) {
            break;
        }
        echo '<input type="radio" name="id" value=' . $rec['id'] . '">';
        echo $rec['name'] . '<br/>';
    }
    echo '<input type="submit" value="修正">';
    echo '</form>';
} catch (Exception $e) {
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
</body>
</html>
