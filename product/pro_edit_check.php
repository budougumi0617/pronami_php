<?php
declare(strict_types=1);

require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';

function validate(string $name, string $price): bool
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
    }else{
        echo "商品名:${price}円<br/>";
    }

    return $valid;
}

$id = h($_POST['id']);
$pro_name = h($_POST['name']);
$pro_price = h($_POST['price']);
?>
<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
<? if (validate($pro_name, $pro_price)): ?>
    <? echo '上記のように変更します。' ?><br/>
    <form action="pro_edit_done.php" method="post">
        <? // HTMLタグ内で変数を展開する ?>
        <input type="hidden" name="id" value="<? echo $id ?>">
        <input type="hidden" name="name" value="<? echo $pro_name ?>">
        <input type="hidden" name="price" value="<? echo $pro_price ?>">
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
