<?php

class PHPShopPrint extends PHPShopCore {

    function PHPShopPrint() {
        global $PHPShopModules;
        $this->objBase = $GLOBALS['SysValue']['base']['table_name11'];
        $this->debug = false;
        parent::PHPShopCore();
    }

    /**
     * Экшен по умолчанию
     */
    function index() {

        $link = PHPShopSecurity::TotalClean($this->PHPShopNav->getName(), 2);
        $link = str_replace("print", "", $link);


        // Читаем файл
        $dis = $this->OpenHTML($link);

        if (!empty($dis) and $link != "menu" and $link != "catalog" and $GLOBALS['SysValue']['system']['print']['enabled'] == 1) {

            // Мета
            $meta = $this->getMeta($dis);

            $this->title = $meta['title'] . ' - ' . $this->PHPShopSystem->getValue("name");
            $this->description = $meta['description'];
            $this->keywords = $meta['keywords'];

            // Определяем переменые
            $this->set('pageContent', $dis);
            $this->set('pageTitle', $meta['title']);


            // Подключаем шаблон
            $pageContent = ParseTemplateReturn($GLOBALS['SysValue']['templates']['print']['print_page_forma'], true);
            exit($pageContent);
            
        } else {
            header("HTTP/1.0 404 Not Found");
            header("Status: 404 Not Found");
            $this->title = "404 Not Found";
            $this->parseTemplate($this->getValue('templates.error_page_forma'));
        }
    }
    

}

?>