<?php
/**
 * ���������� ����������� �����
 * @version 1.0
 * @package PHPShopClass
 * <code>
 * // example:
 * $PHPShopMail= new PHPShopMail('user@localhost','admin@localhost'','Test','Hi, user!');
 * </code>
 * @param string $to ����
 * @param string $from �� ����
 * @param string $zag ��������� ������
 * @param string $content ��������� ������
 */
class PHPShopMail {
    /**
     * @var string ��������� ������
     */
    var $codepage="windows-1251";
    /**
     * @var string MIME ���
     */
    var $mime  = "1.0";
    /**
     * @var string ��� ����������
     */
    var $type = "text/plain";
    /**
     * �����������
     * @param string $to ����
     * @param string $from �� ����
     * @param string $zag ��������� ������
     * @param string $content ��������� ������
     */
    function __construct($to,$from,$zag,$content) {
        $this->from=$from;
        $this->zag="=?".$this->codepage."?B?".base64_encode($zag)."?=";
        $this->to=$to;
        $header=$this->getHeader();
        $this->sendMail($content,$header);
    }
    /**
     * ��������� ������
     * @return string
     */
    function getHeader() {
        $header = "MIME-Version: ".$this->mime."\n";
        $header.= "From:   <".$this->from.">\n";
        $header.= "Content-Type: ".$this->type."; charset=".$this->codepage."\n";
        $header.= "Content-Transfer-Encoding: 8bit\n";
        return $header;
    }
    /**
     * ����������� ������ ����� php mail
     * @param string $content ����������
     * @param strong $header ���������
     */
    function sendMail($content,$header) {
        mail($this->to,$this->zag,$content,$header);
    }
    /**
     * ������� ���������
     * @return string
     */
    function getCopyright() {
        $s="
	 
	 
Powered & Developed by www.PHPShop.ru
".$GLOBALS['SysValue']['license']['product_name'];
        return $s;
    }
}
?>