<?php
declare(strict_types=1);

function sanitize(array $before): array{
    $after = array();
    foreach ($before as $k => $v){
        $after[$k] = htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
    }
    return $after;
}

function convertToGengo(int $seireki): string
{
    $gengo = '';
    if (1868 <= $seireki && $seireki <= 1911) {
        $gengo = '明治';
    } elseif (1912 <= $seireki && $seireki <= 1925) {
        $gengo = '大正';
    } elseif (1926 <= $seireki && $seireki <= 1988) {
        $gengo = '昭和';
    } elseif (1989 <= $seireki && $seireki <= 2018) {
        $gengo = '平成';
    } elseif (2019 <= $seireki) {
        $gengo = '令和';
    }
    return $gengo;
}

