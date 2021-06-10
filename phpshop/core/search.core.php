<?php
/**
 * ���������� ������
 * @author PHPShop Software
 * @version 1.2
 * @package PHPShopCore
 */
class PHPShopSearch extends PHPShopCore {

    /**
     * �����������
     */
    function __construct() {

        // �������
        $this->debug=false;

        // ������ �������
        $this->action=array("post"=>"words","nav"=>"index");
        parent::__construct();
    }
    /**
     * ����� �� ���������, ����� �����
     */
    function index() {
        // ���������� ������
        $this->parseTemplate($this->getValue('templates.search_page_list'));
    }

    /**
     * ����� ������� ���������� ������ ��� ������� ���������� $_POST[words]
     * ����� �� ��������� � ��������
     */
    function words() {

        // �������� �� ������ �������
        $this->words=PHPShopSecurity::TotalClean($_POST['words'],4);

        // �������� HTML
        $j=0;
        $dir="pageHTML/";

        $this->set('pageFrom',$this->getValue('system.path'));

        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if($file != "." and $file != "..") {
                    $fp = fopen($dir.$file, "r");
                    $fstat = fstat($fp);
                    $fread=@fread($fp,$fstat['size']);
                    $Content=strip_tags($fread);
                    fclose($fp);
                    $patern="/\b".$this->words."\b/i";


                    if (preg_match($patern,$Content)) {

                        $filename=explode(".",$file);

                        $meta=$this->getMeta($fread);
                        if(empty($title)) $title=$filename[0].".html";

                        if(!empty($meta['title'])) {

                            // ���������� ����������
                            $this->set('productName',$meta['title']);
                            $this->set('pageWords',$this->words);
                            $this->set('productKey',substr(strip_tags($Content),0,300)."...");
                            $this->set('pageLink',$filename[0].".html");
                            $i++;
                            $this->set('productNum',$i);
                            
                            $this->addToTemplate($this->getValue('templates.main_search_forma'));
                        }
                    }

                }


            }

            closedir($dh);
        }

        $this->set('pageTitle',$this->PHPShopSystem->getParam('name').' / ��������');

        $this->add('<p><br></p>',true);


        $this->set('searchString',$this->words);

        // ���������� ������
        if($i==0) $this->add('<h3>������ �� �������</h3><p><br></p>
	<div style="padding:5;border-style: dashed;border-width: 1px;border-color:#D3D3D3"> 
	���� �� <b>�� �����</b> ������ ����������, 
	�������������� <a href="/map/">������ �����</a>
	 </div>',true);

        // ����
        $this->title="����� - ".$this->PHPShopSystem->getValue("name");
        
        // �������� ������
        $this->setHook(__CLASS__,__FUNCTION__);

        $this->parseTemplate($this->getValue('templates.search_page_list'));
    }
}
?>