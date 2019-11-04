<?php
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';


$id = h($_POST['id']);
$pass = md5(h($_POST['pass']));
$sql = 'SELECT name  FROM mst_staff WHERE id=? AND password=?';

try {
    $dbh = getDBHandler();

    $stmt = $dbh->prepare($sql);
    $data[] = $id;
    $data[] = $pass;
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    $dbh = null; // GCを促してDBへのコネクションを切断している。


    if (!$rec) {
        echo 'スタッフコードかパスワードが間違っています。<br/>';
        echo '<a href="staff_login.html">戻る</a>';
    } else {
        header('Location: staff_top.php');
        exit();
    }
} catch (Exception $e) {
    echo $e;
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}