<?php
/**
 * ��������� ���������
 * ���������� ������ � ���������� �������
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopObj
 */

class PHPShopSystem{
    
    /**
     * �����������
     */
    function __construct() {
        global $PHPShopBase;
        $this->System = $PHPShopBase;
    }


    function getValue($value){
        return $this->System->getParam('system.'.$value);
    }

    /**
     * ������ ��������� ����� �����
     * @return string 
     */
    function getName() {
        return $this->getValue("name");
    }
    
    /**
     * ������ ���������������� ��������
     * @param string $param �������� [param.val]
     * @return string
     */
    function getSerilizeParam($param) {
        return $this->System->getParam($param);
    }

    function getParam($param){
        return true;
    }

}
?>