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
// TODO CSRF対策をしないといけない
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';

$staff_id = h($_POST['id']);

$sql = 'DELETE from mst_staff WHERE id=?';

try {
    $dbh = getDBHandler();

    $stmt = $dbh->prepare($sql);
    $data[] = $staff_id;
    $stmt->execute($data);

    $dbh = null; // GCを促してDBへのコネクションを切断している。
} catch (Exception $e) {
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
削除しました。<br/>
<br/>
<a href="staff_list.php">戻る</a>
</body>
</html>
