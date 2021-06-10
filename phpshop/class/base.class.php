<?
/**
 * ���������� ����������� � ��
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopClass
 * @param string $iniPath ���� �� ����������������� ����� config.ini
 */
class PHPShopBase {
    /**
     * @var string ���� �� ����������������� ����� config.ini
     */
    var $iniPath;
    /**
     * @var array ������ ������ �������� �������
     */
    var $SysValue;
    /**
     * @var string ��������� ����
     */
    var $codBase="cp1251";
    /**
     * @var bool ����� �������
     */
    var $debug=true;
    /**
     * ����������� � ��
     * @param string $iniPath ���� �� ����������������� ����� config.ini
     */
    function __construct($iniPath) {
        $this->iniPath=$iniPath;
        $this->SysValue=parse_ini_file($this->iniPath,1);
        $GLOBALS['SysValue']=$this->SysValue;
    }
    /**
     * ������ ��������� ���������� �������
     * @return array
     */
    function getSysValue() {
        return $this->SysValue;
    }
    /**
     * ������ ��������� ���������� �������
     * <code>
     * // example
     * $PHPShopBase= new PHPShopBase('./inc/config.ini');
     * $PHPShopBase->getParam('base.table_name');
     * </code>
     * @param mixed $param ��� ���������
     * @return string
     */
    function getParam($param) {
        $param=explode(".",$param);
        if(count($param)>2) return $this->SysValue[$param[0]][$param[1]][$param[2]];
        return $this->SysValue[$param[0]][$param[1]];
    }
    /**
     * �������� ��������
     * <code>
     * // example
     * $PHPShopBase= new PHPShopBase('./inc/config.ini');
     * $PHPShopBase->setParam('base.table_name','mybase');
     * </code>
     * @param string $param ��� ���������
     * @param mixed $value �������� ���������
     */
    function setParam($param,$value) {
        $param=explode(".",$param);
        if($param[0] == "var") $param[0]="other";
        $GLOBALS['SysValue'][$param[0]][$param[1]]=$value;
    }
}
?>