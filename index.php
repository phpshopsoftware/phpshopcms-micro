<?php
/**
 * ��������� ����
 * @author PHPShop Software
 * @version PHPShop.CMS Micro 5.0
 * @copyright PHPShop � 2004-2021
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
// ��������� ������
session_start();

// ��������� ������������ ����
include("./phpshop/class/base.class.php");
$PHPShopBase = new PHPShopBase("./phpshop/inc/config.ini");

// ������ ������ GZIP
if ($SysValue['my']['gzip'] == "true")
    include($SysValue['file']['gzip']);

// ���������� ����������
include($SysValue['class']['obj']);
include($SysValue['class']['system']);
include($SysValue['class']['nav']);
include($SysValue['class']['security']);
include($SysValue['class']['core']);
include($SysValue['class']['elements']);
include($SysValue['class']['date']);

// ��������� ���������
$PHPShopSystem = new PHPShopSystem();

// ���������
$PHPShopNav = new PHPShopNav();

// ��������
include($SysValue['file']['elements']);
include($SysValue['file']['catalog']);

// ���������� ������ autoload
foreach ($SysValue['autoload'] as $val)
    if (is_file($val))
        include_once($val);

// �������� �������� ������
include($SysValue['file']['autoload']);

// ������ ������ GZIP
if ($SysValue['my']['gzip'] == "true")
    GzDocOut($SysValue['my']['gzip_level'], $SysValue['my']['gzip_debug']);
?>