<?php
declare(strict_types=1);

require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';

sessionCheck();

function validate(string $name, string $price, array $file): bool
{
    $valid = true;

    if ($name === '') {
        $valid = false;
        echo '商品名が入力されていません。<br/>';
    } else {
        echo "商品名:${name}<br/>";
    }
    if (!preg_match('/\A[0-9]+\z/', $price)) {
        $valid = false;
        echo '価格をきちんと入力してください。<br/>';
    } else {
        echo "商品名:${price}円<br/>";
    }

    if ($file['size'] > 0) {
        if ($file['size'] > 100000) {
            $valid = false;
            echo '画像が大きすぎます';
        } else {
            // これで型が調べられる。
            // echo gettype($file);
            move_uploaded_file($file['tmp_name'], '../gazou/' . h($file['name']));
            echo '<img src="../gazou/' . h($file['name']) . '"><br/>';
        }

    }

    return $valid;
}

$pro_name = h($_POST['name']);
$pro_price = h($_POST['price']);
$pro_gazou = $_FILES['gazou'];
?>
<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
<? if (validate($pro_name, $pro_price, $pro_gazou)): ?>
    <? echo '上記の商品を追加します。' ?><br/>
    <form action="pro_add_done.php" method="post">
        <? // HTMLタグ内で変数を展開する ?>
        <input type="hidden" name="name" value="<? echo $pro_name ?>">
        <input type="hidden" name="price" value="<? echo $pro_price ?>">
        <input type="hidden" name="gazou_name" value="<? echo h($pro_gazou['name']) ?>">
        <br/>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
    </form>

<? else: ?>
    <form>
        <input type="button" onclick="history.back()" value="戻る">
    </form>
<? endif; ?>
</body>
</html>
