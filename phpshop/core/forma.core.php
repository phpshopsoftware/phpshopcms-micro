<?php

/**
 * ���������� ����� ��������� � �����
 * @author PHPShop Software
 * @version 1.2
 * @package PHPShopCore
 */
class PHPShopForma extends PHPShopCore {

    /**
     * �����������
     */
    function PHPShopForma() {
        $this->debug=false;
        
        // ������ �������
        $this->action=array("post"=>"message","nav"=>"index");
        parent::PHPShopCore();
    }


    /**
     * ����� �� ���������, ����� ����� �����
     */
    function index() {

        // ����
        $this->title="����� ����� - ".$this->PHPShopSystem->getValue("name");

        // ���������� ����������
        $this->set('pageTitle','����� �����');

        // ���������� ������
        $this->addToTemplate("page/page_forma_list.tpl");
        $this->parseTemplate($this->getValue('templates.page_page_list'));

    }

    /**
     * ����� �������� ����� ��� ��������� $_POST[message]
     */
    function message() {
        
        if(!empty($_SESSION['text']) and $_POST['key']==$_SESSION['text']) {
            $this->send();
        }else $this->set('Error',"������ �����, ��������� ������� ����� �����");
    }


    /**
     * ��������� ���������
     */
    function send() {

        // ���������� ���������� �������� �����
        PHPShopObj::loadClass("mail");

        // ��������� ������������� �����
        if(PHPShopSecurity::true_param($_POST['nameP'],$_POST['subject'],$_POST['message'],$_POST['mail'])){

            $zag=$this->$_POST['subject']." - ".$this->PHPShopSystem->getValue('name');
            $message="��� ������ ��������� � ����� ".$this->PHPShopSystem->getValue('name')."

������ � ������������:
----------------------
";

            // ���������� �� ���������
            foreach($_POST as $key=>$val)
$message.=$val."
";

            $message.="
����:               ".date("d-m-y H:s a")."
IP:
".$_SERVER['REMOTE_ADDR']."
---------------

� ���������,
http://".$_SERVER['SERVER_NAME'];

            $PHPShopMail = new PHPShopMail($this->PHPShopSystem->getValue('admin_mail'),$_POST['mail'],$zag,$message);
            $this->set('Error',"��������� ������� ����������");
        }
        else $this->set('Error',"������ ���������� ������������ �����");
    }

}
?>