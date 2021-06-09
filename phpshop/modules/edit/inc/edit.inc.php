<?php
class PHPShopUsersElement extends PHPShopElements {

    function PHPShopUsersElement() {
        $this->debug=false;
        parent::PHPShopElements();

        // Авторизация
        if(PHPShopSecurity::true_param($_POST['login'],$_POST['password'])) {

            // Администратор
            if($_POST['login'] == $GLOBALS['SysValue']['system']['edit']['admin_log'] and
                    $_POST['password'] == $GLOBALS['SysValue']['system']['edit']['admin_pas']) {
                $_SESSION['userName']=$GLOBALS['SysValue']['system']['edit']['admin_log'];
                $_SESSION['userNamePath']='*';
            }
            // Менеджер
            else if($_POST['login'] == $GLOBALS['SysValue']['system']['edit']['manager_log'] and
                    $_POST['password'] == $GLOBALS['SysValue']['system']['edit']['manager_pas']) {
                $_SESSION['userName']=$GLOBALS['SysValue']['system']['edit']['manager_log'];
                $_SESSION['userNamePath']=$GLOBALS['SysValue']['system']['edit']['manager_path'];

            }
        }
        // Выход
        elseif(!empty($_POST['logOut'])) {
            unset($_SESSION['userName']);
            unset($_SESSION['userNamePath']);
        }
    }

    /**
     * Форма авторизации
     * @return string
     */
    function autorization_forma() {

        if(!empty($GLOBALS['SysValue']['system']['edit']['demo'])){
            $this->set('userName',$GLOBALS['SysValue']['system']['edit']['admin_log']);
            $this->set('userPassword',$GLOBALS['SysValue']['system']['edit']['admin_pas']);
        }


        if($this->is_autorization()) {
            $this->set('leftMenuName','Администрирование');
            $this->set('userName',$_SESSION['userName']);
            $this->set('leftMenuContent',ParseTemplateReturn($GLOBALS['SysValue']['templates']['edit']['users_forma_element'],true));
            return $this->parseTemplate($this->getValue('templates.left_menu'));
        }
        elseif($this->PHPShopNav->getPath() != 'admin') {
            $this->set('leftMenuName','Авторизация');
            $this->set('leftMenuContent',ParseTemplateReturn($GLOBALS['SysValue']['templates']['edit']['users_forma'],true));
            return $this->parseTemplate($this->getValue('templates.left_menu'));
        }
         
    }


    /**
     * Проверка авторизации
     * @return bool
     */
    function is_autorization() {
        if(!empty($_SESSION['userName'])) return true;
    }
}

$PHPShopUsersElement = new PHPShopUsersElement();

// Авторизация в блоке
$GLOBALS['SysValue']['other']['rightMenu'].=$PHPShopUsersElement->autorization_forma();

if(!empty($_SESSION['userName'])) {
    $GLOBALS['SysValue']['other']['skinSelect'].='<SCRIPT language="JavaScript1.2" src="phpshop/modules/edit/admpanel/phpshop.js"></SCRIPT>
<SCRIPT>
PHPShopMicro.pas = "'.$GLOBALS['SysValue']['system']['edit']['admin_pas'].'";
PHPShopMicro.log = "'.$GLOBALS['SysValue']['system']['edit']['admin_log'].'";
PHPShopMicro.template = "'.$GLOBALS['SysValue']['system']['skin'].'";
</SCRIPT>
<script type="text/javascript" src="phpshop/modules/edit/admpanel/highslide/highslide-full.packed.js"></script>
<link rel="stylesheet" type="text/css" href="phpshop/modules/edit/admpanel/highslide/highslide.css" />
    <link rel="stylesheet" href="phpshop/modules/edit/codemirror/lib/codemirror.css">
    <script src="phpshop/modules/edit/codemirror/lib/codemirror.js"></script>
    <script src="phpshop/modules/edit/codemirror/mode/xml/xml.js"></script>
    <script src="phpshop/modules/edit/codemirror/mode/javascript/javascript.js"></script>
    <script src="phpshop/modules/edit/codemirror/mode/css/css.js"></script>
    <script src="phpshop/modules/edit/codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <script src="phpshop/modules/edit/codemirror/mode/htmlembedded/htmlembedded.js"></script>
    <style type="text/css">.CodeMirror-scroll {height: auto;overflow-y: hidden;overflow-x: auto;width: 100%;} .CodeMirror {background-color;white;}</style>
<script type="text/javascript">
            hs.graphicsDir = "phpshop/modules/edit/admpanel/highslide/graphics/";
            hs.outlineType = "rounded-windows";
            hs.wrapperClassName = "draggable-header";
            hs.showCredits = false;
            hs.headingText = "Редактор";
            hs.dimmingOpacity = 0.5;
            hs.dimmingDuration = 50;
</script>
';
}
?>