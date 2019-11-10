<?php
require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common/common.php';

$seireki = $_POST['seireki'];

$wareki = convertToGengo($seireki);
echo $wareki;


