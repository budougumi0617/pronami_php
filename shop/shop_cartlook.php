<?php
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';

sessionCheckForMember();

$cart = $_SESSION['cart'];
$num = $_SESSION['num'];
if (!isset($cart)) {
    $cart = [];
}
$max = count($cart);

try {
    $dbh = getDBHandler();

    foreach ($cart as $k => $v) {
        $sql = 'SELECT id, name, price, gazou FROM mst_product WHERE id=?';
        $stmt = $dbh->prepare($sql);
        $data[0] = $v; // ループが回るたびにインクリメントしないように。
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        $name[] = $rec['name'];
        $price[] = $rec['price'];
        if ($rec['gazou'] == '') {
            $gazou[] = '';
        } else {
            $gazou[] = '<img src="../gazou/' . $rec['gazou'] . '">';
        }
    }
    $dbh = null;
} catch (Exception $e) {
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
<form action="kazu_change.php" method="post">


    <? for ($i = 0; $i < $max; $i++): ?>
        <? echo $name[$i] . $gazou[$i] . $price[$i] . '円 '; ?>
        <input type="text" name="kazu<? echo $i; ?>" value="<? echo $num[$i]; ?>">
        <? echo $price[$i] * $num[$i] . '円' ?><br/>
    <? endfor; ?>
    <input type="hidden" name="max" value="<? echo $max ?>">
    <input type="submit" value="数量変更"><br/>
    <input type="button" onclick="history.back()" value="戻る">
</form>
</body>
</html>
