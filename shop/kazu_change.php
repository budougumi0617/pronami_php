<?php
session_start();
session_regenerate_id();

require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common/common.php';

$post = sanitize($_POST);

$max = $post['max'];
for ($i = 0; $i < $max; $i++) {
    $num[] = $post['kazu' . $i];
}

$_SESSION['num'] = $num;

header('Location: shop_cartlook.php');
exit();


