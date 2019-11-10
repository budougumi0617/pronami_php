<?php
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';

sessionCheckForMember();

$max = 0;

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    $num = $_SESSION['num'];
    $max = count($cart);
}

if ($max === 0) {
    echo 'カートに商品が入っていません。<br/>';
    echo '<a href="shop_list.php">商品一覧へ戻る</a>';
    exit();
}

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
    <table border="1">
        <tr>
            <td>商品</td>
            <td>商品画像</td>
            <td>価格</td>
            <td>数量</td>
            <td>小計</td>
            <td>削除</td>
        </tr>

        <? for ($i = 0; $i < $max; $i++): ?>
            <tr>
                <td><?= $name[$i] ?></td>
                <td><?= $gazou[$i] ?></td>
                <td><?= $price[$i] ?>円</td>
                <td><input type="text" name="kazu<?= $i ?>" value="<?= $num[$i] ?>"></td>
                <td><?= $price[$i] * $num[$i] . '円' ?></td>
                <td><input type="checkbox" name="sakujo<?= $i ?>"></td>
            </tr>
        <? endfor; ?>
    </table>
    <input type="hidden" name="max" value="<?= $max ?>">
    <input type="submit" value="数量変更"><br/>
    <!-- <input type="button" onclick="history.back()" value="戻る"> -->
</form>
<a href="shop_list.php">商品一覧へ戻る</a>
</body>
</html>
