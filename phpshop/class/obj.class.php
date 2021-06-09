<?php
if (!defined("OBJENABLED")) define("OBJENABLED", dirname(__FILE__));

/**
 * Родительский класс Объекта
 * @author PHPShop Software
 * @version 1.2
 * @package PHPShopClass
 */
class PHPShopObj {
    /**
     * @var int ИД объекта в БД
     */
    var $objID;
    /**
     * @var string имя БД
     */
    var $objBase;
    /**
     * @var array массив данных
     */
    var $objRow;
    /**
     * @var bool режим отладки
     */
    var $debug=false;
    /**
     * @var bool проверка установки
     */
    var $install=true;

 
    /**
     * Загрузка класса
     * @param string $class_name имя класса, согласно config.ini
     */
    function loadClass($class_name) {
        $class_path=OBJENABLED."/".$class_name.".class.php";
        if(file_exists($class_path)) require_once($class_path);
        else echo "Нет файла ".$class_path;
    }
    /**
     * Выдача десериализованного значения
     * @param string $paramName имя параметра
     * @return <type>
     */
}
?>