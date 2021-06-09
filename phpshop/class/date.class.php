<?php
/**
 * ���������� ������ � ������
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopClass
 */
class PHPShopDate {
    /**
     * �������������� ���� �� Unix � ��������� ���
     * @param int $nowtime ������ ���� � Unix
     * @param bool $full ����� ����� � �����
     * @return string
     */
    function dataV($nowtime=false,$full=true) {

        if(!$nowtime) $nowtime = date("U");

        $Months = array("01"=>"������","02"=>"�������","03"=>"�����",
                "04"=>"������","05"=>"���","06"=>"����", "07"=>"����",
                "08"=>"�������","09"=>"��������",  "10"=>"�������",
                "11"=>"������","12"=>"�������");
        $curDateM = date("m",$nowtime);
        $time=date("d",$nowtime)."-".$curDateM."-".date("y",$nowtime);
        if($full) $time.=" ".date("H:i ",$nowtime);

        return $time;
    }

    /**
     * �������������� ���� �� ���������� ���� � Unix
     * @param string $data ���� � ������� ������
     * @param string $delim ����������� ���� [-] ��� [.]
     * @return <type>
     */
    function GetUnixTime($data,$delim='-') {
        $array=explode($delim,$data);
        return @mktime(12, 0, 0, $array[1], $array[0], $array[2]);
    }

}
?>