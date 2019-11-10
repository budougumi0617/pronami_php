<?php
declare(strict_types=1);

require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common/common.php';

$post = sanitize($_POST);

$name = $post['name'];
$email = $post['email'];
$postal1 = $post['postal1'];
$postal2 = $post['postal2'];
$address = $post['address'];
$tel = $post['tel'];

$ok = true;

if ($name == '') {
    echo 'お名前が入力されていません。<br/><br/>';
    $ok = false;
} else {
    echo 'お名前<br/>';
    echo $name . '<br/><br/>';
}

if (preg_match('/\A[\w\-\.]+\@[\w\-\.]+.([a-z]+)\z/', $email) == 0) {
    echo 'メールアドレスを正確に入力してください。<br/>><br/>';
    $ok = false;
} else {
    echo 'メールアドレス<br/>';
    echo $email . '<br/><br/>';
}

if (preg_match('/\A[0-9]+\z/', $postal1) == 0) {
    echo '郵便番号は半角数字で入力してください。<br/>><br/>';
    $ok = false;
}

if (preg_match('/\A[0-9]+\z/', $postal2) == 0) {
    echo '郵便番号は半角数字で入力してください。<br/>><br/>';
    $ok = false;
} else {
    echo '郵便番号<br/>';
    echo $postal1 . '-' . $postal2 . '<br/><br/>';
}

if ($address == '') {
    echo '住所が入力されていません。<br/><br/>';
    $ok = false;
} else {
    echo '住所<br/>';
    echo $address . '<br/><br/>';
}

if (preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/', $tel) == 0) {
    echo '電話番号を正確に入力してください。<br/><br/>';
    $ok = false;
} else {
    echo '電話番号<br/>';
    echo $tel . '<br/><br/>';
}

if ($ok){
    echo '<form method="post" action="shop_form_done.php">';
    echo '<input type="hidden" name="name" value="' . $name . '">';
    echo '<input type="hidden" name="email" value="' . $email . '">';
    echo '<input type="hidden" name="postal1" value="' . $postal1 . '">';
    echo '<input type="hidden" name="postal2" value="' . $postal2 . '">';
    echo '<input type="hidden" name="address" value="' . $address . '">';
    echo '<input type="hidden" name="tel" value="' . $tel . '">';
    echo '<input type="button" onclick="history.back()" value="戻る">';
    echo '<input type="submit" value="OK"><br/>';
}else{
    echo '<input type="button" onclick="history.back()" value="戻る">';
}
