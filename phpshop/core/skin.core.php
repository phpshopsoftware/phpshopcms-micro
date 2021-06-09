<?php
/**
 * Обработчик шаблонов для скачивания
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopCore
 */
class PHPShopSkin extends PHPShopCore {

    /**
     * Конструктор
     */
    function PHPShopSkin() {
        parent::PHPShopCore();
    }

    /**
     * Экшен по умолчанию, подключение к сервере phpshopcms.ru, вывод списка шаблонов
     */
    function index() {

        // Подключаемся к phpshopcms.ru
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

        // Замена символов для картинок
        $skins=explode("<!-- SKINS_START -->",$disp);
        $dis=str_replace("/load/","http://www.phpshopcms.ru/load/",$skins[1]);
        $dis=str_replace("save.gif","zoom.gif",$dis);

        // Мета
        $this->title="Бесплатные шаблоны для сайта - ".$this->PHPShopSystem->getValue("name");

        // Определяем переменые
        $this->set('pageContent',$dis);
        $this->set('pageTitle','Бесплатные шаблоны для сайта');

        // Подключаем шаблон
        $this->parseTemplate($this->getValue('templates.page_page_list'));
    }
}
?>