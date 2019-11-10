<?php

$mbango = $_POST['mbango'];

$hoshi = [
    'M1' => 'カニ星雲',
    'M31' => 'アンドロメダ星雲',
    'M42' => 'オリオン星雲',
    'M45' => 'すばる',
    'M57' => 'ドーナツ星雲'
];

foreach ($hoshi as $key => $val) {
    echo $key . 'は' . $val . '<br/>';
}

echo 'あなたが選んだ星は、' . $hoshi[$mbango];
