<?php
/**
 * Загрузчик ядра
 * @author PHPShop Software
 * @version PHPShop.CMS Micro 5.0
 * @copyright PHPShop © 2004-2021
 * @license https://www.phpshopcms.ru/doc/license.html
 */
//  UTF-8 Default Charset Fix
if (stristr(ini_get("default_charset"), "utf")) {
    ini_set("default_charset", "cp1251");
}

// PHP Version Warning
if (floatval(phpversion()) < 5.3) {
    exit("PHP " . phpversion() . " is not supported");
}
// Запускаем сессию
session_start();

// Парсируем установочный файл
include("./phpshop/class/base.class.php");
$PHPShopBase = new PHPShopBase("./phpshop/inc/config.ini");

// Сжатие данных GZIP
if ($SysValue['my']['gzip'] == "true")
    include($SysValue['file']['gzip']);

// Подключаем библиотеки
include($SysValue['class']['obj']);
include($SysValue['class']['system']);
include($SysValue['class']['nav']);
include($SysValue['class']['security']);
include($SysValue['class']['core']);
include($SysValue['class']['elements']);
include($SysValue['class']['date']);

// Системные настройки
$PHPShopSystem = new PHPShopSystem();

// Навигация
$PHPShopNav = new PHPShopNav();

// Элементы
include($SysValue['file']['elements']);
include($SysValue['file']['catalog']);

// Подключаем модули autoload
foreach ($SysValue['autoload'] as $val)
    if (is_file($val))
        include_once($val);

// Загрузка основной логики
include($SysValue['file']['autoload']);

// Сжатие данных GZIP
if ($SysValue['my']['gzip'] == "true")
    GzDocOut($SysValue['my']['gzip_level'], $SysValue['my']['gzip_debug']);
?>