<?php
/**
 * Обработчик новостей
 * @author PHPShop Software
 * @version 1.2
 * @package PHPShopCore
 */
class PHPShopNews extends PHPShopCore {

    /**
     * Конструктор
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * Экшен по умолчанию
     */
    function index() {
        global $PHPShopModules;

        // Читаем файл
        $dis = $this->OpenHTML('news');

        // Мета
        $meta = $this->getMeta($dis);

        // Мета
        $this->title = $meta['title'] . ' - ' . $this->PHPShopSystem->getValue("name");
        $this->description = $meta['description'];
        $this->keywords = $meta['keywords'];

        // Определяем переменые
        $this->set('pageContent', $dis);
        $this->set('pageTitle', $meta['title']);

        // Перехват модуля
        $this->setHook(__CLASS__, __FUNCTION__, $dis);

        // Подключаем шаблон
        $this->parseTemplate($this->getValue('templates.page_page_list'));
    }

}

?>