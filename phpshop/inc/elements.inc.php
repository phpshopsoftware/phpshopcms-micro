<?php
/**
 * Элемент стандартных системных переменных
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopElements
 */
class PHPShopCoreElement extends PHPShopElements {

    /**
     * Конструктор
     */
    function PHPShopCoreElement() {
        parent::PHPShopElements();
    }

    /**
     * Назначение текущего шаблона
     * @return string
     */
    function skin() {
        if(empty($_SESSION['skin']))
            $_SESSION['skin']=$this->PHPShopSystem->getValue('skin');
        return $_SESSION['skin'];
    }

    /**
     * Проверка существования шаблона,
     * смена на другой найденный шаблон при переименовании папки с шаблоном
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
     * Определение стандратных системных переменных для шаблонов
     * (имя, телефон, почта администратора)
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
     * Стили шаблона дизайна
     * @return string
     */
    function pageCss() {
        $this->set('pathTemplate','phpshop/templates/'.$_SESSION['skin']);
        return $this->getValue('dir.templates').chr(47).$_SESSION['skin'].chr(47).$this->getValue('css.default');
    }

}

/**
 * Элемент cмена шаблонов
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopElements
 */
class PHPShopSkinElement extends PHPShopElements {

    /**
     * Конструктор
     */
    function PHPShopSkinElement() {
        parent::PHPShopElements();

        // Экшены
        $this->setAction(array('post' => 'skin', 'get' => 'skin'));
    }

    /**
     * Назначение текущего шаблона
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
     * Вывод смены шаблонов
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
                            @$name.= "<option value=\"$file\" $sel>Шаблон $file</option>";
                    }
                    closedir($dh);
                }
            }


            // Определяем переменые
            $forma = "<div style=\"padding:10px\"><form name=SkinForm method=post><select name=\"skin\" onchange=\"ChangeSkin()\">" . $name . "</select></form></div>";
            $this->set('leftMenuContent', $forma);
            $this->set('leftMenuName', "Сменить дизайн");

            // Подключаем шаблон
            $dis = $this->parseTemplate($this->getValue('templates.left_menu'));
        }
        return $dis;
    }

}

class PHPShopTextElement extends PHPShopElements {

    /**
     * Конструктор
     */
    function PHPShopTextElement() {
        parent::PHPShopElements();
    }

    /**
     * Экшен по умолчанию
     */
    function topMenu() {
        global $PHPShopModules;

        // Подключаем шаблон
        $dis = $this->OpenHTML('menu');

        // Перехват модуля
        $PHPShopModules->setHookHandler(__CLASS__, __FUNCTION__, $this, $dis);

        return $dis;
    }

}

?>