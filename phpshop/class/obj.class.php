<?php
if (!defined("OBJENABLED")) define("OBJENABLED", dirname(__FILE__));

/**
 * ������������ ����� �������
 * @author PHPShop Software
 * @version 1.2
 * @package PHPShopClass
 */
class PHPShopObj {
    /**
     * @var int �� ������� � ��
     */
    var $objID;
    /**
     * @var string ��� ��
     */
    var $objBase;
    /**
     * @var array ������ ������
     */
    var $objRow;
    /**
     * @var bool ����� �������
     */
    var $debug=false;
    /**
     * @var bool �������� ���������
     */
    var $install=true;

 
    /**
     * �������� ������
     * @param string $class_name ��� ������, �������� config.ini
     */
    function loadClass($class_name) {
        $class_path=OBJENABLED."/".$class_name.".class.php";
        if(file_exists($class_path)) require_once($class_path);
        else echo "��� ����� ".$class_path;
    }
    /**
     * ������ ������������������ ��������
     * @param string $paramName ��� ���������
     * @return <type>
     */
}
?>