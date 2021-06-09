<?php
/*
  +-------------------------------------+
  |  PHPShop CMS Micro 3.4              |
  |  PHPShop Software 2012              |
  |  Файл Загрузчик                     |
  +-------------------------------------+
 */

// Запускаем сессию
session_start();

/**
 * TPL Parser
 * @param string $TemplateName  имя шаблона
 */
function ParseTemplate($TemplateName) {
    global $SysValue;

    $file = getTplFile($SysValue['dir']['templates'] . chr(47) . $_SESSION['skin'] . chr(47) . $TemplateName);
    $string = newParser($file);

    // Реальный путь
    $path_parts = pathinfo($_SERVER['PHP_SELF']);
    if (getenv("COMSPEC"))
        $dirSlesh = "\\";
    else
        $dirSlesh = "/";
    $root = $path_parts['dirname'] . "/";
    if ($path_parts['dirname'] != $dirSlesh) {
        $replaces = array(
            "/images\//i" => $SysValue['dir']['templates'] . chr(47) . $_SESSION['skin'] . "/images/",
            "/\/favicon.ico/i" => $root . "favicon.ico",
            "/java\//i" => $root . "java/",
            "/css\//i" => $root . "css/",
            "/phpshop\//i" => $root . "phpshop/",
            "/\/links\//i" => $root . "links/",
            "/\/files\//i" => $root . "files/",
            "/\/page\//i" => $root . "page/",
            "/\/news\//i" => $root . "news/",
            "/\/gbook\//i" => $root . "gbook/",
            "/\/search\//i" => $root . "search/",
            "/\"\/\"/i" => $root,
            "/\/map\//i" => $root . "map/",
        );
    } else {
        $replaces = array(
            "/images\//i" => $SysValue['dir']['templates'] . chr(47) . $_SESSION['skin'] . "/images/",
            "/java\//i" => "/java/",
            "/css\//i" => "/css/",
            "/phpshop\//i" => "/phpshop/",
        );
    }
    $string = preg_replace(array_keys($replaces), array_values($replaces), $string);
    echo $string;
}

/**
 * TPL Parser с возвратом значения
 * @param string $TemplateName имя шаблона
 * @param bool $mod использование в модуле
 * @return string 
 */
function ParseTemplateReturn($TemplateName, $mod = false) {
    $SysValue = $GLOBALS['SysValue'];
    if ($mod)
        $file = getTplFile($TemplateName);
    else
        $file = getTplFile($SysValue['dir']['templates'] . chr(47) . $_SESSION['skin'] . chr(47) . $TemplateName);
    $dis = newParser($file);
    return $dis;
}

/**
 * Парсер константы
 */
function ConstantS($string) {
    return @preg_replace_callback("/@([[:alnum:]]+)@/", "ConstantR", $string);
}

/**
 * Обработчик ошибки php в шаблоне
 */
function evalstr($str) {
    ob_start();
    if (eval(stripslashes($str[2])) !== NULL) {
        echo ('<center style="color:red"><br><br><b>PHPShop Template Code: В шаблоне обнаружена ошибка выполнения php</b><br>');
        echo ('Код содержащий ошибки:');
        echo ('<pre>');
        echo ($str[2]);
        echo ('</pre></center>');
        return ob_get_clean();
    }
    return ob_get_clean();
}

/**
 * Обработчик переменных в шаблоне
 * @param string $string содержание шаблона
 * @param bool $php режим учета php в шаблоне
 * @return string
 */
function newParser($string, $php = true) {
    global $SysValue;
    if ($php)
        $newstring = @preg_replace_callback("/(@php)(.*)(php@)/sU", "evalstr", $string);
    else
        $newstring = $string;
    
    $newstring = @preg_replace("/@([[:alnum:]]+)@/e", '$SysValue["other"]["\1"]', $newstring);
    return $newstring;
}

/**
 * Алиас обработчика переменных в шаблоне
 */
function Parser($string, $php = true) {
    return newParser($string, $php = true);
}

/**
 * Обработка констант
 */
function ConstantR($array) {
    global $SysValue;
    if (!empty($SysValue['other'][$array[1]]))
        $string = $SysValue['other'][$array[1]];
    else
        $string = null;

    return $string;
}

/**
 * Чтение содержимого файла шаблона
 * @param string $path адрес файла
 * @return boolean 
 */
function getTplFile($path) {
    $file = @file_get_contents($path);
    if (!$file)
        return false;
    return $file;
}

// Включаем таймер
$time = explode(' ', microtime());
$start_time = $time[1] + $time[0];

// Парсируем установочный файл
include("./phpshop/class/base.class.php");
$PHPShopBase = new PHPShopBase("./phpshop/inc/config.ini");

// Сжатие данных GZIP
if ($SysValue['my']['gzip'] == "true")
    include($SysValue['file']['gzip']);

// Подключаем библиотеки
include($SysValue['class']['obj']);
include($SysValue['class']['category']);
include($SysValue['class']['system']);
include($SysValue['class']['nav']);
include($SysValue['class']['security']);
include($SysValue['class']['core']);
include($SysValue['class']['elements']);
include($SysValue['class']['date']);
include($SysValue['class']['debug']);

// Системные настройки
$PHPShopSystem = new PHPShopSystem();

// Навигация
$PHPShopNav = new PHPShopNav();

// Отладка
$PHPShopDebug = new PHPShopDebug();

// Элементы
include($SysValue['file']['elements']);
include($SysValue['file']['catalog']);

// Подключаем модули autoload
foreach ($SysValue['autoload'] as $val)
    if (is_file($val))
        include_once($val);

// Загрузка основной логики
include($SysValue['file']['autoload']);

// Выключаем таймер
$time = explode(' ', microtime());
$seconds = ($time[1] + $time[0] - $start_time);
$seconds = substr($seconds, 0, 6);

// Расход памяти
$_MEM = null;
if (function_exists('memory_get_usage')) {
    $mem = memory_get_usage();
    $_MEM = ' '.round($mem / 1024, 2) . " Kb";
}

// Панель отладки
if ($SysValue['my']['debug'] == "true")
    $PHPShopDebug->compile();

echo "<!-- Страница создана за $seconds $_MEM, Сборка " . $SysValue['upload']['version'] . " -->";

// Сжатие данных GZIP
if ($SysValue['my']['gzip'] == "true")
    GzDocOut($SysValue['my']['gzip_level'], $SysValue['my']['gzip_debug']);
?>