<?php
/*
  +-------------------------------------+
  |  PHPShop CMS Micro 3.4              |
  |  PHPShop Software 2012              |
  |  ���� ���������                     |
  +-------------------------------------+
 */

// ��������� ������
session_start();

/**
 * TPL Parser
 * @param string $TemplateName  ��� �������
 */
function ParseTemplate($TemplateName) {
    global $SysValue;

    $file = getTplFile($SysValue['dir']['templates'] . chr(47) . $_SESSION['skin'] . chr(47) . $TemplateName);
    $string = newParser($file);

    // �������� ����
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
 * TPL Parser � ��������� ��������
 * @param string $TemplateName ��� �������
 * @param bool $mod ������������� � ������
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
 * ������ ���������
 */
function ConstantS($string) {
    return @preg_replace_callback("/@([[:alnum:]]+)@/", "ConstantR", $string);
}

/**
 * ���������� ������ php � �������
 */
function evalstr($str) {
    ob_start();
    if (eval(stripslashes($str[2])) !== NULL) {
        echo ('<center style="color:red"><br><br><b>PHPShop Template Code: � ������� ���������� ������ ���������� php</b><br>');
        echo ('��� ���������� ������:');
        echo ('<pre>');
        echo ($str[2]);
        echo ('</pre></center>');
        return ob_get_clean();
    }
    return ob_get_clean();
}

/**
 * ���������� ���������� � �������
 * @param string $string ���������� �������
 * @param bool $php ����� ����� php � �������
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
 * ����� ����������� ���������� � �������
 */
function Parser($string, $php = true) {
    return newParser($string, $php = true);
}

/**
 * ��������� ��������
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
 * ������ ����������� ����� �������
 * @param string $path ����� �����
 * @return boolean 
 */
function getTplFile($path) {
    $file = @file_get_contents($path);
    if (!$file)
        return false;
    return $file;
}

// �������� ������
$time = explode(' ', microtime());
$start_time = $time[1] + $time[0];

// ��������� ������������ ����
include("./phpshop/class/base.class.php");
$PHPShopBase = new PHPShopBase("./phpshop/inc/config.ini");

// ������ ������ GZIP
if ($SysValue['my']['gzip'] == "true")
    include($SysValue['file']['gzip']);

// ���������� ����������
include($SysValue['class']['obj']);
include($SysValue['class']['category']);
include($SysValue['class']['system']);
include($SysValue['class']['nav']);
include($SysValue['class']['security']);
include($SysValue['class']['core']);
include($SysValue['class']['elements']);
include($SysValue['class']['date']);
include($SysValue['class']['debug']);

// ��������� ���������
$PHPShopSystem = new PHPShopSystem();

// ���������
$PHPShopNav = new PHPShopNav();

// �������
$PHPShopDebug = new PHPShopDebug();

// ��������
include($SysValue['file']['elements']);
include($SysValue['file']['catalog']);

// ���������� ������ autoload
foreach ($SysValue['autoload'] as $val)
    if (is_file($val))
        include_once($val);

// �������� �������� ������
include($SysValue['file']['autoload']);

// ��������� ������
$time = explode(' ', microtime());
$seconds = ($time[1] + $time[0] - $start_time);
$seconds = substr($seconds, 0, 6);

// ������ ������
$_MEM = null;
if (function_exists('memory_get_usage')) {
    $mem = memory_get_usage();
    $_MEM = ' '.round($mem / 1024, 2) . " Kb";
}

// ������ �������
if ($SysValue['my']['debug'] == "true")
    $PHPShopDebug->compile();

echo "<!-- �������� ������� �� $seconds $_MEM, ������ " . $SysValue['upload']['version'] . " -->";

// ������ ������ GZIP
if ($SysValue['my']['gzip'] == "true")
    GzDocOut($SysValue['my']['gzip_level'], $SysValue['my']['gzip_debug']);
?>