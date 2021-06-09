<?
/**
 * Библиотека для разборки CSV файлов
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopClass
 */
class PHPShopReadCsv {
    /**
     * @var mixed содержание CSV
     */
    var $CsvContent;
    /**
     * @var array массив строк
     */
    var $ReadCsvRow;
    /**
     * @var array итоговый массив
     */
    var $CsvToArray;

    /**
     * Конструктор
     */
    function PHPShopReadCsv() {
        $this->ReadCsvRow();
        $this->CsvToArray();
    }
    /**
     * Читаем строки и заносим в массив
     */
    function ReadCsvRow() {
        $this->ReadCsvRow = split("\n",$this->CsvContent);
        array_shift($this->ReadCsvRow);
        array_pop($this->ReadCsvRow);
    }
    /**
     * Чистка строк
     * @param string $str строка
     * @return string
     */
    function CleanStr($str) {
        return $str;
        //return PHPShopSecurity::CleanStr($str);
    }
    /**
     * Обработка массива
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
     * Чтением  файла
     * @param string $file адрес файла
     * @return string
     */
    function readFile($file) {
        @$fp = fopen($file, "r");
        if ($fp) {
            $fstat = fstat($fp);
            $fread=fread($fp,$fstat['size']);
            fclose($fp);
            return $fread;
        } else echo ("Не могу прочитать файл ".$file);
    }
}
?>