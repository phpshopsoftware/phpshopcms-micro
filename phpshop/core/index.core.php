<?php

/**
 * Обработчик первой страницы
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopCore
 */
class PHPShopIndex extends PHPShopCore {

    /**
     * Конструктор
     */
    function PHPShopIndex() {
        parent::PHPShopCore();
    }


    /**
     * Экшен по умолчанию
     */
    function index() {

        // Проверка на главную страницу
        if($GLOBALS['SysValue']['nav']['truepath'] == "/")
            $this->indexpage();
        else $this->page();

    }


    /**
     * Начальная страница
     */
    function indexpage() {

        // Читаем файл
        $dis=$this->OpenHTML('index');

        // Мета
        $meta = $this->getMeta($dis);

        $this->title=$meta['title'].' - '.$this->PHPShopSystem->getValue("name");
        $this->description = $meta['description'];
        $this->keywords = $meta['keywords'];

        // Определяем переменые
        $this->set('pageContent',$dis);
        $this->set('pageTitle',$meta['title']);

        // Перехват модуля
        $this->setHook(__CLASS__,__FUNCTION__,$dis);

        // Подключаем шаблон
        $this->parseTemplate($this->getValue('templates.page_page_list'));
    }

    /**
     * Экшен по умолчанию
     */
    function page() {
        global $PHPShopModules;

        $link=PHPShopSecurity::TotalClean($this->PHPShopNav->getName(),2);
        

        // Читаем файл
        $dis = $this->OpenHTML($link);

        if(!empty($dis) and $link != "menu" and $link != "catalog") {

            // Мета
            $meta = $this->getMeta($dis);

            $this->title = $meta['title'].' - '.$this->PHPShopSystem->getValue("name");
            $this->description = $meta['description'];
            $this->keywords = $meta['keywords'];

            // Определяем переменые
            $this->set('pageContent',$dis);
            $this->set('pageTitle',$meta['title']);

            // Перехват модуля
            $this->setHook(__CLASS__,__FUNCTION__,$dis);

            // Подключаем шаблон
            $this->parseTemplate($this->getValue('templates.page_page_list'));
        } else {
            header("HTTP/1.0 404 Not Found");
            header("Status: 404 Not Found");
            $this->title="404 Not Found";
            $this->parseTemplate($this->getValue('templates.error_page_forma'));
        }

    }

}
?>