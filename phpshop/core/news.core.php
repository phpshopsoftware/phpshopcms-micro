<?php
/**
 * ���������� ��������
 * @author PHPShop Software
 * @version 1.2
 * @package PHPShopCore
 */
class PHPShopNews extends PHPShopCore {

    /**
     * �����������
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * ����� �� ���������
     */
    function index() {
        global $PHPShopModules;

        // ������ ����
        $dis = $this->OpenHTML('news');

        // ����
        $meta = $this->getMeta($dis);

        // ����
        $this->title = $meta['title'] . ' - ' . $this->PHPShopSystem->getValue("name");
        $this->description = $meta['description'];
        $this->keywords = $meta['keywords'];

        // ���������� ���������
        $this->set('pageContent', $dis);
        $this->set('pageTitle', $meta['title']);

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, $dis);

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.page_page_list'));
    }

}

?>