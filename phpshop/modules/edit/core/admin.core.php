<?php


class PHPShopAdmin extends PHPShopCore {

    /**
     * �����������
     */
    function PHPShopAdmin() {

        // ������ �������
        $this->action=array("nav"=>"ID","post"=>"create",);
        parent::PHPShopCore();

    }

    // �������� ���� ������������
    function check_rules($page) {
        if(PHPShopSecurity::true_param($_SESSION['userNamePath'],$_SESSION['userName'])) {

            if($_SESSION['userNamePath'] == '*')
                return true;

            else if(!strstr($_SESSION['userNamePath'], ',')) {
                $path[]=$_SESSION['userNamePath'];
            }else {
                $path = explode(",",$_SESSION['userNamePath']);
            }

            foreach($path as $file) {
                if($file.'.html' == $page) {
                    return true;
                }
            }
            return false;
        }
        else return false;
    }

    function files() {
        $dir="pageHTML/";
        $list=null;
        if (@$dh = @opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if($this->check_rules($file) && $file != '.' && $file != '..') {
                    $fp = fopen($dir.$file, "r");
                    $fstat = fstat($fp);
                    $list.='<tr><td><a href="../'.$file.'">'.$file.'</a></td><td>'.PHPShopDate::dataV($fstat['mtime']).'</td></tr>';
                }
            }
            closedir($dh);
        }
        return $list;
    }

    /**
     * �������� �����
     */
    function create() {
        if(!empty($_POST['nameFile']) and !is_file('pageHTML/'.$_POST['nameFile'].'.html')) {
            if(@fwrite(fopen('pageHTML/'.$_POST['nameFile'].'.html',"w+"), '���� '.$_POST['nameFile'].' ������ � '.PHPShopDate::dataV()))
                $this->set('fileLog','���� ������� ������.');
            else  $this->set('fileLog','������ �������� �����, ��������� ����� �� ������ ����� pageHTML (CHMOD 775)');
        }
        else $this->set('fileLog','������ �������� �����!');
        $this->index();
    }


    /**
     * ����� �����������
     */
    function index() {

        if($this->is_autorization()) {
            $this->set('pageTitle','������ �������');
            $this->set('userName',$_SESSION['userName']);
            $this->set('filesDB',$this->files());
            $this->set('pageContent',ParseTemplateReturn($GLOBALS['SysValue']['templates']['edit']['users_forma_cabinet'],true));

        }
        else {
            $this->set('pageTitle','�����������');
            $this->set('pageContent',ParseTemplateReturn($GLOBALS['SysValue']['templates']['edit']['users_forma'],true));
        }

        // ����
        $this->title='����������������� - '.$this->PHPShopSystem->getValue("name");

        $this->parseTemplate($this->getValue('templates.page_page_list'));
    }

    /**
     * �������� �����������
     * @return bool
     */
    function is_autorization() {
        if(!empty($_SESSION['userName'])) return true;
    }

}
?>