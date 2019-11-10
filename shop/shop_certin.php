<?php
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';

sessionCheckForMember();

$id = $_GET['id'];

$sql = 'SELECT name, price, gazou FROM mst_product WHERE id=?';

try {


    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }
    // array_pushでもよい。
    $cart[] = $id;
    $_SESSION['cart'] = $cart;
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
カートに追加しました<br/>
<br/>
<a href="shop_list.php">商品一覧に戻る</a>
</body>
</html>
