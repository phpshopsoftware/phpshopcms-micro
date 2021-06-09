<?php


class PHPShopAdmin extends PHPShopCore {

    /**
     * Конструктор
     */
    function PHPShopAdmin() {

        // Список экшенов
        $this->action=array("nav"=>"ID","post"=>"create",);
        parent::PHPShopCore();

    }

    // Проверка прав пользователя
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
     * Создание файла
     */
    function create() {
        if(!empty($_POST['nameFile']) and !is_file('pageHTML/'.$_POST['nameFile'].'.html')) {
            if(@fwrite(fopen('pageHTML/'.$_POST['nameFile'].'.html',"w+"), 'Файл '.$_POST['nameFile'].' создан в '.PHPShopDate::dataV()))
                $this->set('fileLog','Файл успешно создан.');
            else  $this->set('fileLog','Ошибка создания файла, проверьте права на запись папки pageHTML (CHMOD 775)');
        }
        else $this->set('fileLog','Ошибка создания файла!');
        $this->index();
    }


    /**
     * Форма авторизации
     */
    function index() {

        if($this->is_autorization()) {
            $this->set('pageTitle','Личный кабинет');
            $this->set('userName',$_SESSION['userName']);
            $this->set('filesDB',$this->files());
            $this->set('pageContent',ParseTemplateReturn($GLOBALS['SysValue']['templates']['edit']['users_forma_cabinet'],true));

        }
        else {
            $this->set('pageTitle','Авторизация');
            $this->set('pageContent',ParseTemplateReturn($GLOBALS['SysValue']['templates']['edit']['users_forma'],true));
        }

        // Мета
        $this->title='Администрирование - '.$this->PHPShopSystem->getValue("name");

        $this->parseTemplate($this->getValue('templates.page_page_list'));
    }

    /**
     * Проверка авторизации
     * @return bool
     */
    function is_autorization() {
        if(!empty($_SESSION['userName'])) return true;
    }

}
?>