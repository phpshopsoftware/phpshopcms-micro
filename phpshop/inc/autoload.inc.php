<?php
/**
 * Загрузчик
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopInc
 */

// Библиотека
$_classPath='../phpshop/';

// Шаблон дизайна по умолчанмю
$PHPShopCoreElement = new PHPShopCoreElement();
$PHPShopCoreElement->init('skin');
$PHPShopCoreElement->init('checkskin');
$PHPShopCoreElement->init('setdefault');

// Выбор шаблона
$PHPShopSkinElement = new PHPShopSkinElement();
$PHPShopSkinElement->init('skinSelect');

// Стили шаблона дизайна
$PHPShopCoreElement->init('pageCss');

// Загрузка модулей
include($SysValue['class']['modules']);
$PHPShopModules = new PHPShopModules();
$PHPShopModules->doLoad();

// Горизонтальное меню
$PHPShopTextElement = new PHPShopTextElement();
$PHPShopTextElement->init('topMenu');

// Каталог
$PHPShopCatalogElement = new PHPShopCatalogElement();
$PHPShopCatalogElement->init('mainMenuPage');

// Подключение ядра
if(!empty($SysValue['nav']['path'])) {
    $core_file="./phpshop/core/".$PHPShopNav->getPath().".core.php";
    if(!$PHPShopModules->doLoadPath($SysValue['nav']['path']))
    if(is_file($core_file)) {
        include_once($core_file);
        $classname = 'PHPShop'.ucfirst($SysValue['nav']['path']);
        if(class_exists($classname)) {
            $PHPShopCore = new $classname ();
            $PHPShopCore->loadActions();
        }else echo PHPShopCore::setError($classname,"не определен класс phpshop/core/$classname.core.php");
    }else {
        header("HTTP/1.0 404 Not Found");
        header("Status: 404 Not Found");
        $SysValue['other']['DispShop']=ParseTemplateReturn($SysValue['templates']['error_page_forma']);
        ParseTemplate($SysValue['templates']['shop']);
    }
}

?>