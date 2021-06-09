<?
/**
 * Библиотека для работы с файлами
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopClass
 */
class PHPShopFile {

    /**
     * Запись данных в файл
     * @param string $file путь до файла
     * @param string $csv данные для записи
     */
    function write($file,$csv) {
        $fp = fopen($file, "w+");
        if ($fp) {
            //stream_set_write_buffer($fp, 0);
            fputs($fp, $csv);
            fclose($fp);
        }
    }


    /**
     * GZIP компресия файла
     * @param string $source путь до файла
     * @param int $level степень сжатия
     * @return bool
     */
    function gzcompressfile($source,$level=false) {
        $dest=$source.'.gz';
        $mode='wb'.$level;
        $error=false;
        if($fp_out=gzopen($dest,$mode)) {
            if($fp_in=fopen($source,'rb')) {
                while(!feof($fp_in))
                    gzwrite($fp_out,fread($fp_in,1024*512));
                fclose($fp_in);
            }
            else $error=true;
            gzclose($fp_out);
            unlink($source);
            rename($dest, $source.'.bz2');
        }
        else $error=true;
        if($error) return false;
        else return $dest;
    }

}

?>