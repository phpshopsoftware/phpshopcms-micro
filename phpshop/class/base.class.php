<?
/**
 * Библиотека подключения к БД
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopClass
 * @param string $iniPath путь до конфигурационного файла config.ini
 */
class PHPShopBase {
    /**
     * @var string путь до конфигурационного файла config.ini
     */
    var $iniPath;
    /**
     * @var array массив данных настроек конфига
     */
    var $SysValue;
    /**
     * @var string кодировка базы
     */
    var $codBase="cp1251";
    /**
     * @var bool режим отладки
     */
    var $debug=true;
    /**
     * Подключения к БД
     * @param string $iniPath путь до конфигурационного файла config.ini
     */
    function __construct($iniPath) {
        $this->iniPath=$iniPath;
        $this->SysValue=parse_ini_file($this->iniPath,1);
        $GLOBALS['SysValue']=$this->SysValue;
    }
    /**
     * Выдача системных параметров конфига
     * @return array
     */
    function getSysValue() {
        return $this->SysValue;
    }
    /**
     * Выдача системных параметров конфига
     * <code>
     * // example
     * $PHPShopBase= new PHPShopBase('./inc/config.ini');
     * $PHPShopBase->getParam('base.table_name');
     * </code>
     * @param mixed $param имя параметра
     * @return string
     */
    function getParam($param) {
        $param=explode(".",$param);
        if(count($param)>2) return $this->SysValue[$param[0]][$param[1]][$param[2]];
        return $this->SysValue[$param[0]][$param[1]];
    }
    /**
     * Добавить параметр
     * <code>
     * // example
     * $PHPShopBase= new PHPShopBase('./inc/config.ini');
     * $PHPShopBase->setParam('base.table_name','mybase');
     * </code>
     * @param string $param имя параметра
     * @param mixed $value знячение параметра
     */
    function setParam($param,$value) {
        $param=explode(".",$param);
        if($param[0] == "var") $param[0]="other";
        $GLOBALS['SysValue'][$param[0]][$param[1]]=$value;
    }
}
?>