<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
<?php
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';

$sql = 'SELECT name FROM mst_staff WHERE 1';

try {
    $dbh = getDBHandler();

    $stmt = $dbh->prepare($sql);
    $data[] = $staff_name;
    $data[] = $staff_pass;
    $stmt->execute($data);

    $dbh = null; // GCを促してDBへのコネクションを切断している。

    echo 'スタッフ一覧<br/><br/>';

    while(true){
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$rec){
            break;
        }
        echo $rec['name'].'<br/>';
    }
} catch (Exception $e) {
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
</body>
</html>
