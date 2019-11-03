<?php
declare(strict_types=1);

function h(string $v):string{
    return htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
}

function getDBHandler(): PDO
{
    // TODO 環境変数から情報を取得する。
    $dsn = 'mysql:dbname=pronami_shop;host=mysql;port=3306;charset=utf8mb4';

    // TODO 環境変数から情報を取得する。
    $user = 'docker';
    $password = 'docker';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}