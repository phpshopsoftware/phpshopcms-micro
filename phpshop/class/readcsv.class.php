<?
/**
 * ���������� ��� �������� CSV ������
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopClass
 */
class PHPShopReadCsv {
    /**
     * @var mixed ���������� CSV
     */
    var $CsvContent;
    /**
     * @var array ������ �����
     */
    var $ReadCsvRow;
    /**
     * @var array �������� ������
     */
    var $CsvToArray;

    /**
     * �����������
     */
    function PHPShopReadCsv() {
        $this->ReadCsvRow();
        $this->CsvToArray();
    }
    /**
     * ������ ������ � ������� � ������
     */
    function ReadCsvRow() {
        $this->ReadCsvRow = split("\n",$this->CsvContent);
        array_shift($this->ReadCsvRow);
        array_pop($this->ReadCsvRow);
    }
    /**
     * ������ �����
     * @param string $str ������
     * @return string
     */
    function CleanStr($str) {
        return $str;
        //return PHPShopSecurity::CleanStr($str);
    }
    /**
     * ��������� �������
     * @return array
     */
    function CsvToArray() {
        $OutArray=array();

        while (list($key, $val) = each($this->ReadCsvRow)) {
            $array1=split(";",$val);

            if(!($OutArray[$array1[0]])) $OutArray[$array1[0]]=$this->CleanStr($array1);
            else $OutArray[]=$this->CleanStr($array1);
        }

        $this->CsvToArray = $OutArray;
        return $OutArray;
    }

    /**
     * �������  �����
     * @param string $file ����� �����
     * @return string
     */
    function readFile($file) {
        @$fp = fopen($file, "r");
        if ($fp) {
            $fstat = fstat($fp);
            $fread=fread($fp,$fstat['size']);
            fclose($fp);
            return $fread;
        } else echo ("�� ���� ��������� ���� ".$file);
    }
}
?>