<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
<?php
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';

$staff_id = h($_POST['id']);
$staff_name = h($_POST['name']);
$staff_pass = h($_POST['pass']);

$sql = 'UPDATE mst_staff SET name=?, password=? WHERE id=?';

try {
    $dbh = getDBHandler();

    $stmt = $dbh->prepare($sql);
    $data[] = $staff_name;
    $data[] = $staff_pass;
    $data[] = $staff_id;
    $stmt->execute($data);

    $dbh = null; // GCを促してDBへのコネクションを切断している。
} catch (Exception $e) {
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
修正しました。<br/>
<br/>
<a href="staff_list.php">戻る</a>
</body>
</html>
