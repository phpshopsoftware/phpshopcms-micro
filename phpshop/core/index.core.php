<?php

/**
 * ���������� ������ ��������
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopCore
 */
class PHPShopIndex extends PHPShopCore {

    /**
     * �����������
     */
    function PHPShopIndex() {
        parent::PHPShopCore();
    }


    /**
     * ����� �� ���������
     */
    function index() {

        // �������� �� ������� ��������
        if($GLOBALS['SysValue']['nav']['truepath'] == "/")
            $this->indexpage();
        else $this->page();

    }


    /**
     * ��������� ��������
     */
    function indexpage() {

        // ������ ����
        $dis=$this->OpenHTML('index');

        // ����
        $meta = $this->getMeta($dis);

        $this->title=$meta['title'].' - '.$this->PHPShopSystem->getValue("name");
        $this->description = $meta['description'];
        $this->keywords = $meta['keywords'];

        // ���������� ���������
        $this->set('pageContent',$dis);
        $this->set('pageTitle',$meta['title']);

        // �������� ������
        $this->setHook(__CLASS__,__FUNCTION__,$dis);

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.page_page_list'));
    }

    /**
     * ����� �� ���������
     */
    function page() {
        global $PHPShopModules;

        $link=PHPShopSecurity::TotalClean($this->PHPShopNav->getName(),2);
        

        // ������ ����
        $dis = $this->OpenHTML($link);

        if(!empty($dis) and $link != "menu" and $link != "catalog") {

            // ����
            $meta = $this->getMeta($dis);

            $this->title = $meta['title'].' - '.$this->PHPShopSystem->getValue("name");
            $this->description = $meta['description'];
            $this->keywords = $meta['keywords'];

            // ���������� ���������
            $this->set('pageContent',$dis);
            $this->set('pageTitle',$meta['title']);

            // �������� ������
            $this->setHook(__CLASS__,__FUNCTION__,$dis);

            // ���������� ������
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