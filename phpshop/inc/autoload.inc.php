<?php
/**
 * ���������
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopInc
 */

// ����������
$_classPath='../phpshop/';

// ������ ������� �� ���������
$PHPShopCoreElement = new PHPShopCoreElement();
$PHPShopCoreElement->init('skin');
$PHPShopCoreElement->init('checkskin');
$PHPShopCoreElement->init('setdefault');

// ����� �������
$PHPShopSkinElement = new PHPShopSkinElement();
$PHPShopSkinElement->init('skinSelect');

// ����� ������� �������
$PHPShopCoreElement->init('pageCss');

// �������� �������
include($SysValue['class']['modules']);
$PHPShopModules = new PHPShopModules();
$PHPShopModules->doLoad();

// �������������� ����
$PHPShopTextElement = new PHPShopTextElement();
$PHPShopTextElement->init('topMenu');

// �������
$PHPShopCatalogElement = new PHPShopCatalogElement();
$PHPShopCatalogElement->init('mainMenuPage');

// ����������� ����
if(!empty($SysValue['nav']['path'])) {
    $core_file="./phpshop/core/".$PHPShopNav->getPath().".core.php";
    if(!$PHPShopModules->doLoadPath($SysValue['nav']['path']))
    if(is_file($core_file)) {
        include_once($core_file);
        $classname = 'PHPShop'.ucfirst($SysValue['nav']['path']);
        if(class_exists($classname)) {
            $PHPShopCore = new $classname ();
            $PHPShopCore->loadActions();
        }else echo PHPShopCore::setError($classname,"�� ��������� ����� phpshop/core/$classname.core.php");
    }else {
        header("HTTP/1.0 404 Not Found");
        header("Status: 404 Not Found");
        $SysValue['other']['DispShop']=ParseTemplateReturn($SysValue['templates']['error_page_forma']);
        ParseTemplate($SysValue['templates']['shop']);
    }
}

?>