<?php
declare(strict_types=1);
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common/common.php';

session_start();
session_regenerate_id(true);


try {
    $post = sanitize($_POST);

    $name = $post['name'];
    $email = $post['email'];
    $postal1 = $post['postal1'];
    $postal2 = $post['postal2'];
    $address = $post['address'];
    $tel = $post['tel'];

    $cart = $_SESSION['cart'];
    $num = $_SESSION['num'];
    $max = count($cart);


    $dbh = getDBHandler();
    $sql = 'SELECT name, price FROM mst_product WHERE id=?';

    $orders = '';
    for ($i = 0; $i < $max; $i++) {
        $stmt = $dbh->prepare($sql);
        $data[0] = $cart[$i];
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        $pname = $rec['name'];
        $price = $rec['price'];
        $kakaku[] = $price;
        $suryo = $num[$i];
        $sum = $price * $suryo;

        $orders .= $pname . ' ' . $price . '円 x' . $suryo . '個 = ' . $sum . "\n";
    }

    $sql = 'INSERT INTO dat_sales (code_member, name, email, postal1, postal2, address, tell) VALUES (?,?,?,?,?,?,?)';
    $stmt = $dbh->prepare($sql);
    $data = [];
    $data[0] = 0; // 会員コードは暫定で0
    $data[] = $name;
    $data[] = $email;
    $data[] = $postal1;
    $data[] = $postal2;
    $data[] = $address;
    $data[] = $tel;
    $stmt->execute($data);

    // IDを取得
    $sql = 'SELECT LAST_INSERT_ID()';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $lastId = $rec['LAST_INSERT_ID()'];

    for ($i = 0; $i < $max; $i++) {
        $sql = 'INSERT INTO dat_sales_product (sales_id, product_id, price, quantity) VALUES (?,?,?,?)';
        $stmt= $dbh->prepare($sql);
        $data = [];
        $data[]=$lastId;
        $data[]=$cart[$i];
        $data[]=$kakaku[$i];
        $data[]=$num[$i];
        $stmt->execute($data);
    }

    $dbh = null;
} catch (Exception $e) {
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    echo $e;
    exit();
}

// ヒアドキュメントを使ってみる
$format = <<<EOT
{$name}様

このたびはご注文ありがとうございました。

ご注文商品
--------------------
$orders
送料は無料です。
--------------------
代金は以下の口座に振り込んでください。
EOT;

$title = 'ご注文ありがとうございます';
$header = 'From: info@rokumarunouen.co.jp';
$honbun = html_entity_decode($format, ENT_QUOTES, 'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_send_mail($email, $title, $honbun, $header);

$title = 'ご注文ありがとうございました';
$header = 'From: ' . $email;
$honbun = html_entity_decode($format, ENT_QUOTES, 'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_send_mail('info@rokumarunouen.co.jp', $title, $honbun, $header);
?>
    <!doctype html>
    <html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ろくまる農園</title>
    </head>
    <body>
    <?php


    echo $name . '様<br/>';
    echo 'ご注文ありがとうございました。<br/>';
    echo $email . 'にメールを送りましたのでご確認ください。<br/>';
    echo '商品は以下の住所に発送させていただきます。<br/>';
    echo $postal1 . '-' . $postal2 . '<br/>';
    echo $tel . '<br/>';
    // echo nl2br($format);
    ?>
    </body>
    </html>
<?php
