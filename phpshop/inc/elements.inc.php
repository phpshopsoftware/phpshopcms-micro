<?php
/**
 * ������� ����������� ��������� ����������
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopElements
 */
class PHPShopCoreElement extends PHPShopElements {

    /**
     * �����������
     */
    function PHPShopCoreElement() {
        parent::PHPShopElements();
    }

    /**
     * ���������� �������� �������
     * @return string
     */
    function skin() {
        if(empty($_SESSION['skin']))
            $_SESSION['skin']=$this->PHPShopSystem->getValue('skin');
        return $_SESSION['skin'];
    }

    /**
     * �������� ������������� �������,
     * ����� �� ������ ��������� ������ ��� �������������� ����� � ��������
     * @return string
     */
    function checkskin() {
        if (!file_exists("phpshop/templates/".$_SESSION['skin']."/index.html")) {
            $dir=$this->getValue('dir.templates').chr(47);
            if (is_dir($dir)) {
                if (@$dh = opendir($dir)) {
                    while (($file = readdir($dh)) !== false) {
                        if(is_file($dir.$file.chr(47).'index.html')) {
                            $_SESSION['skin']=$file;
                            header('Location: /?status=template_error');
                        }
                    }
                    closedir($dh);
                }
            }
            exit('Template error!');
        }
    }

    /**
     * ����������� ����������� ��������� ���������� ��� ��������
     * (���, �������, ����� ��������������)
     */
    function setdefault() {
        $this->set('telNum',$this->PHPShopSystem->getValue('tel'));
        $this->set('name',$this->PHPShopSystem->getValue('name'));
        $this->set('company',$this->PHPShopSystem->getValue('company'));
        $this->set('mail',$this->PHPShopSystem->getValue('mail'));
        $this->set('serverName',$_SERVER['SERVER_NAME']);
        $this->set('path',$this->PHPShopSystem->getValue('path'));
    }

    /**
     * ����� ������� �������
     * @return string
     */
    function pageCss() {
        $this->set('pathTemplate','phpshop/templates/'.$_SESSION['skin']);
        return $this->getValue('dir.templates').chr(47).$_SESSION['skin'].chr(47).$this->getValue('css.default');
    }

}

/**
 * ������� c���� ��������
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopElements
 */
class PHPShopSkinElement extends PHPShopElements {

    /**
     * �����������
     */
    function PHPShopSkinElement() {
        parent::PHPShopElements();

        // ������
        $this->setAction(array('post' => 'skin', 'get' => 'skin'));
    }

    /**
     * ���������� �������� �������
     * @return string
     */
    function skin() {
        if ($this->PHPShopSystem->getValue('skin_choice')) {

            if (isset($_REQUEST['skin'])) {
                if (file_exists("phpshop/templates/" . $_REQUEST['skin'] . "/index.html")) {
                    $skin = $_REQUEST['skin'];
                    if (PHPShopSecurity::true_login($_REQUEST['skin']))
                        $_SESSION['skin'] = $_REQUEST['skin'];
                }
            }
            elseif (empty($_SESSION['skin'])) {
                $skin = $this->PHPShopSystem->getValue('skin');
                $_SESSION['skin'] = $skin;
            }
        } else {
            $skin = $this->PHPShopSystem->getValue('skin');
            $_SESSION['skin'] = $skin;
        }
    }

    /**
     * ����� ����� ��������
     * @return string
     */
    function index() {
        $dis = $name = '';
        if ($this->PHPShopSystem->getValue('skin_choice') == 'true') {
            $dir = $this->getValue('dir.templates') . chr(47);
            if (is_dir($dir)) {
                if (@$dh = opendir($dir)) {
                    while (($file = readdir($dh)) !== false) {

                        if ($_SESSION['skin'] == $file)
                            $sel = "selected";
                        else
                            $sel = "";

                        if ($file != "." and $file != ".." and $file != "index.html")
                            @$name.= "<option value=\"$file\" $sel>������ $file</option>";
                    }
                    closedir($dh);
                }
            }


            // ���������� ���������
            $forma = "<div style=\"padding:10px\"><form name=SkinForm method=post><select name=\"skin\" onchange=\"ChangeSkin()\">" . $name . "</select></form></div>";
            $this->set('leftMenuContent', $forma);
            $this->set('leftMenuName', "������� ������");

            // ���������� ������
            $dis = $this->parseTemplate($this->getValue('templates.left_menu'));
        }
        return $dis;
    }

}

class PHPShopTextElement extends PHPShopElements {

    /**
     * �����������
     */
    function PHPShopTextElement() {
        parent::PHPShopElements();
    }

    /**
     * ����� �� ���������
     */
    function topMenu() {
        global $PHPShopModules;

        // ���������� ������
        $dis = $this->OpenHTML('menu');

        // �������� ������
        $PHPShopModules->setHookHandler(__CLASS__, __FUNCTION__, $this, $dis);

        return $dis;
    }

}

?>