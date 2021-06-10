<?php
/**
 * Системные настройки
 * Упрощенный доступ к параметрам системы
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopObj
 */

class PHPShopSystem{
    
    /**
     * Конструктор
     */
    function __construct() {
        global $PHPShopBase;
        $this->System = $PHPShopBase;
    }


    function getValue($value){
        return $this->System->getParam('system.'.$value);
    }

    /**
     * Выдача параметра имени сайта
     * @return string 
     */
    function getName() {
        return $this->getValue("name");
    }
    
    /**
     * Выдача сериализованного значения
     * @param string $param параметр [param.val]
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