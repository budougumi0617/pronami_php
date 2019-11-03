<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
<?php
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';

$staff_name = h($_POST['name']);
$staff_pass = h($_POST['pass']);

$sql = 'INSERT INTO mst_staff(name, password) VALUES (?, ?)';

try {
    $dbh = getDBHandler();

    $stmt = $dbh->prepare($sql);
    $data[] = $staff_name;
    $data[] = $staff_pass;
    $stmt->execute($data);

    $dbh = null; // GCを促してDBへのコネクションを切断している。

    echo $staff_name . 'さんを追加しました。<br/>';
} catch (Exception $e) {
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
<a href="staff_list.php">戻る</a>
</body>
</html>
