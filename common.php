<?php
declare(strict_types=1);

function h(string $v):string{
    return htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
}