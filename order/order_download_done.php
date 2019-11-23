<?php
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common/common.php';

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

$post = sanitize($_POST);

$year = $post['year'];
$month = $post['month'];
$day = $post['day'];

$sql = '
select
    ds.id,
    ds.date,
    ds.code_member,
    ds.name as ds_name,
    ds.email,
    ds.postal1,
    ds.postal2,
    ds.address,
    ds.tell,
    dsp.product_id,
    mp.name as mp_name,
    dsp.price,
    dsp.quantity
from
    dat_sales as ds,
    dat_sales_product as dsp,
    mst_product as mp 
where ds.id = dsp.sales_id 
and dsp.product_id = mp.id 
and substr(ds.date,1,4)= ? 
and substr(ds.date,6,2)= ? 
and substr(ds.date,9,2)= ?;
';

try {
    $dbh = getDBHandler();

    $stmt = $dbh->prepare($sql);
    $data[] = $year;
    $data[] = $month;
    $data[] = $day;
    var_dump($data);
    $stmt->execute($data);

    $dbh = null; // GCを促してDBへのコネクションを切断している。

    $csv = "注文コード,注文日時,会員番号,お名前,メール,郵便番号,住所,TEL,商品コード,商品名,価格,数量\n";
    while (true) {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$rec) {
            break;
        }
        $line = $rec['id'] . ',' . $rec['date'] . ',' . $rec['code_member'] . ',' . $rec['ds_name'] . ',' . $rec['email'] . ',' . $rec['postal1'] . '-' . $rec['postal2'];
        $line .= $rec['address'] . ',' . $rec['tell'] . ',' . $rec['product_id'] . ',' . $rec['mp_name'] . ',' . $rec['price'] . ',' . $rec['quantity'] . "\n";
        $csv .= $line;
    }

    // echo nl2br($csv);
    $file = fopen('./order.csv', 'w');
    $csv = mb_convert_encoding($csv, 'SJIS', 'UTF-8');
    fputs($file, $csv);
    fclose($file);
} catch (Exception $e) {
    var_dump($e);
    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}

?>
<br/>
<a href="./order.csv">注文データのダウンロード</a><br/>
<a href="./order_download.php">日付選択へ</a><br/>
<a href="../staff_login/staff_top.php">トップメニューへ</a>
</body>
</html>
