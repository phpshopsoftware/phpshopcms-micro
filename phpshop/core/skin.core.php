<?php
/**
 * ���������� �������� ��� ����������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopCore
 */
class PHPShopSkin extends PHPShopCore {

    /**
     * �����������
     */
    function PHPShopSkin() {
        parent::PHPShopCore();
    }

    /**
     * ����� �� ���������, ����������� � ������� phpshopcms.ru, ����� ������ ��������
     */
    function index() {

        // ������������ � phpshopcms.ru
        $fp = fsockopen("www.phpshopcms.ru", 80, $errno, $errstr, 30);
        if (!$fp) {
            echo "$errstr ($errno)<br />\n";
        } else {
            $out = "GET /pageHTML/skins.php HTTP/1.0\r\n";
            $out .= "Host: www.phpshopcms.ru\r\n";
            $out .= "Connection: Close\r\n\r\n";

            fwrite($fp, $out);
            while (!feof($fp)) {
                $disp.=  fgets($fp, 128);
            }
            fclose($fp);
        }

        // ������ �������� ��� ��������
        $skins=explode("<!-- SKINS_START -->",$disp);
        $dis=str_replace("/load/","http://www.phpshopcms.ru/load/",$skins[1]);
        $dis=str_replace("save.gif","zoom.gif",$dis);

        // ����
        $this->title="���������� ������� ��� ����� - ".$this->PHPShopSystem->getValue("name");

        // ���������� ���������
        $this->set('pageContent',$dis);
        $this->set('pageTitle','���������� ������� ��� �����');

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.page_page_list'));
    }
}
?>