<?php
declare(strict_types=1);

function h(string $v): string
{
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

function sessionCheck()
{
    session_start();
    // 合言葉を変える
    session_regenerate_id();
    if (!isset($_SESSION['login'])) {
        echo 'ログインされていません。<br/>';
        echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
        exit();
    } else {
        echo $_SESSION['staff_name'] . 'さんログイン中</br>';
    }
}

function sessionCheckForBranch()
{
    session_start();
    // 合言葉を変える
    session_regenerate_id();
    if (!isset($_SESSION['login'])) {
        echo 'ログインされていません。<br/>';
        echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
        exit();
    }
}