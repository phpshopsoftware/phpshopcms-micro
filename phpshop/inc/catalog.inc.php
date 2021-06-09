<?

class PHPShopCatalogElement extends PHPShopElements {

    /**
     * Конструктор
     */
    function PHPShopCatalogElement() {
        parent::PHPShopElements();
    }

    /**
     * Экшен по умолчанию
     */

    function mainMenuPage() {
        global $PHPShopModules;

        // Подключаем шаблон
        $dis = $this->OpenHTML('catalog');

        // Перехват модуля
        $PHPShopModules->setHookHandler(__CLASS__,__FUNCTION__, $this, $dis);

        return $dis;
    }
}
?>