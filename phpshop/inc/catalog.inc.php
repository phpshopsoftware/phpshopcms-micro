<?

class PHPShopCatalogElement extends PHPShopElements {

    /**
     * �����������
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * ����� �� ���������
     */

    function mainMenuPage() {
        global $PHPShopModules;

        // ���������� ������
        $dis = $this->OpenHTML('catalog');

        // �������� ������
        $PHPShopModules->setHookHandler(__CLASS__,__FUNCTION__, $this, $dis);

        return $dis;
    }
}
?>