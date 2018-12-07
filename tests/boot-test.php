<?php

error_reporting(E_ALL);
$root      = dirname(__DIR__);
$autoload  = realpath($root . '/../../') . '/autoload.php'; //优先使用最上层
$autoload2 = $root . '/vendor/autoload.php';

if (file_exists($autoload)) {
    require $autoload;
} else if (file_exists($autoload2)) {
    require $autoload2;
} else {
    throw new Exception("can not find autoload.php file", 1);
}

//注册basement组件
$basements = array_change_key_case(array_flip(Linker::getBasements()), CASE_UPPER);
foreach ($_ENV as $component => $class) {
    if (isset($basements[strtoupper($component)])) {
        Linker::register([$component => $class]);
    }
}
