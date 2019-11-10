<?php
session_start();
session_regenerate_id();

require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common/common.php';


if (!isset($_SESSION['cart'])) {
    header('Location: shop_cartlook.php');
    exit();
}

$post = sanitize($_POST);

$max = $post['max'];
for ($i = 0; $i < $max; $i++) {
    if (preg_match("/\A[0-9]+\z/", $post['kazu' . $i]) == 0) {
        echo '数量に誤りがあります。';
        echo '<a href="shop_cartlook.php">カートに戻る</a>';
        exit();
    }
    if ($post['kazu' . $i] < 1 || 10 < $post['kazu' . $i]) {
        echo '数量は必ず1個以上、10個までです。';
        echo '<a href="shop_cartlook.php">カートに戻る</a>';
        exit();
    }
    $num[] = $post['kazu' . $i];
}

$cart = $_SESSION['cart'];

for ($i = $max; 0 <= $i; $i--) {
    if (isset($post['sakujo' . $i])) {
        array_splice($cart, $i, 1);
        array_splice($num, $i, 1);

    }
}

$_SESSION['cart'] = $cart;
$_SESSION['num'] = $num;

header('Location: shop_cartlook.php');
exit();


