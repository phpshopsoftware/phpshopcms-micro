<?
/**
 * ���������� ��� ������ � �������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopClass
 */
class PHPShopFile {

    /**
     * ������ ������ � ����
     * @param string $file ���� �� �����
     * @param string $csv ������ ��� ������
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
     * GZIP ��������� �����
     * @param string $source ���� �� �����
     * @param int $level ������� ������
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