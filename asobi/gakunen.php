<?php

$gakunen = $_POST['gakunen'];

switch ($gakunen) {
    case'1':
        $kousha = 'あなたの校舎は南校舎です。';
        $bukatsu = '部活動にはスポーツ系と文化系があります。';
        $mokuhyou = 'まずは学校に慣れましょう。';
        break;
    case'2':
        $kousha = 'あなたの校舎は西校舎です。';
        $bukatsu = '学園祭目指して全力で取り組みましょう。';
        $mokuhyou = '居間しか出来ないことをみつけよう。';
        break;
    case'3':
        $kousha = 'あなたの校舎は東校舎です。';
        $bukatsu = '受験に就職に忙しくなります。後輩へ譲っていきましょう。';
        $mokuhyou = '将来への道を作ろう。';
        break;
    default:
        $kousha = 'あなたの校舎は3年生と同じです。';
        $bukatsu = '部活動はありません。';
        $mokuhyou = '早く卒業しましょう。';
        break;
}

echo '校舎  ' . $kousha . '<br/>';
echo '部活  ' . $bukatsu . '<br/>';
echo '目標  ' . $mokuhyou . '<br/>';

