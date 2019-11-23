<?php
declare(strict_types=1);

function sanitize(array $before): array
{
    $after = array();
    foreach ($before as $k => $v) {
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

function pulldown_year()
{
    echo '<select name="year">';
    echo '<option value="2017">2017</option>';
    echo '<option value="2018">2018</option>';
    echo '<option value="2019">2019</option>';
    echo '<option value="2020">2020</option>';
    echo '</select>';
}

function pulldown_month()
{
    echo '<select name="month">';
    echo '<option value="01">01</option>';
    echo '<option value="02">02</option>';
    echo '<option value="03">03</option>';
    echo '<option value="04">04</option>';
    echo '<option value="05">05</option>';
    echo '<option value="06">06</option>';
    echo '<option value="07">07</option>';
    echo '<option value="08">08</option>';
    echo '<option value="09">09</option>';
    echo '<option value="10">10</option>';
    echo '<option value="11">11</option>';
    echo '<option value="12">12</option>';
    echo '</select>';
}

function pulldown_day()
{
    echo '<select name="day">';
    echo '<option value="01">01</option>';
    echo '<option value="02">02</option>';
    echo '<option value="03">03</option>';
    echo '<option value="04">04</option>';
    echo '<option value="05">05</option>';
    echo '<option value="06">06</option>';
    echo '<option value="07">07</option>';
    echo '<option value="08">08</option>';
    echo '<option value="09">09</option>';
    echo '<option value="10">10</option>';
    echo '<option value="11">11</option>';
    echo '<option value="12">12</option>';
    echo '<option value="13">13</option>';
    echo '<option value="14">14</option>';
    echo '<option value="15">15</option>';
    echo '<option value="16">16</option>';
    echo '<option value="17">17</option>';
    echo '<option value="18">18</option>';
    echo '<option value="19">19</option>';
    echo '<option value="20">20</option>';
    echo '<option value="21">21</option>';
    echo '<option value="22">22</option>';
    echo '<option value="23">23</option>';
    echo '<option value="24">24</option>';
    echo '<option value="25">25</option>';
    echo '<option value="26">26</option>';
    echo '<option value="27">27</option>';
    echo '<option value="28">28</option>';
    echo '<option value="29">29</option>';
    echo '<option value="30">30</option>';
    echo '<option value="31">31</option>';
    echo '</select>';
}