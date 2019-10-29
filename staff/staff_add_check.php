<?php
declare(strict_types=1);

require_once $_ENV['APACHE_DOCUMENT_ROOT'] . '/common.php';

function validate(string $name, string $pass, string $pass2): bool
{
    $valid = true;

    if ($name === '') {
        $valid = false;
        echo 'スタッフ名が入力されていません。<br/>';
    } else {
        echo "スタッフ名:${name}<br/>";
    }
    if ($pass == '') {
        $valid = false;
        echo 'パスワードが入力されていません。<br/>';
    }
    if ($pass != $pass2) {
        $valid = false;
        echo 'パスワードが一致しません。<br/>';
    }

    return $valid;
}

$staff_name = h($_POST['name']);
$staff_pass = h($_POST['pass']);
$staff_pass2 = h($_POST['pass2']);
?>
<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
<? if (validate($staff_name, $staff_pass, $staff_pass2)): ?>
    <form>
        <input type="button" onclick="history.back()" value="戻る">
    </form>
<? else: ?>
    <? $staff_pass = md5($staff_pass) ?>
    <form action="staff_add_done.php" method="post">
        <? // HTMLタグ内で変数を展開する ?>
        <input type="hidden" name="name" value="<? echo $staff_name ?>">
        <input type="hidden" name="pass" value="<? echo $staff_pass ?>">
        <br/>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
    </form>
<? endif; ?>
</body>
</html>
