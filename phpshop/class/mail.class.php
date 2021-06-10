<?php
/**
 * Библиотека Отправление почты
 * @version 1.0
 * @package PHPShopClass
 * <code>
 * // example:
 * $PHPShopMail= new PHPShopMail('user@localhost','admin@localhost'','Test','Hi, user!');
 * </code>
 * @param string $to куда
 * @param string $from от кого
 * @param string $zag заголовок письма
 * @param string $content содежание письма
 */
class PHPShopMail {
    /**
     * @var string кодировка письма
     */
    var $codepage="windows-1251";
    /**
     * @var string MIME тип
     */
    var $mime  = "1.0";
    /**
     * @var string Тип содержания
     */
    var $type = "text/plain";
    /**
     * Конструктор
     * @param string $to куда
     * @param string $from от кого
     * @param string $zag заголовок письма
     * @param string $content содежание письма
     */
    function __construct($to,$from,$zag,$content) {
        $this->from=$from;
        $this->zag="=?".$this->codepage."?B?".base64_encode($zag)."?=";
        $this->to=$to;
        $header=$this->getHeader();
        $this->sendMail($content,$header);
    }
    /**
     * Заголовок письма
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
     * Отправление письма через php mail
     * @param string $content содержание
     * @param strong $header заголовок
     */
    function sendMail($content,$header) {
        mail($this->to,$this->zag,$content,$header);
    }
    /**
     * Вставка копирайта
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