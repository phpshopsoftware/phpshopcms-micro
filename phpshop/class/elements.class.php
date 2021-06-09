<?php

/**
 * ������������ ����� �������� ���������
 * ������� ������������� ��������� � ����� phpshop/inc/
 * @author PHPShop Software
 * @version 1.2
 * @package PHPShopClass
 */
class PHPShopElements {

    /**
     * @var string ��� ��
     */
    var $objBase;
    var $objPath;

    /**
     * @var bool ����� �������
     */
    var $debug = false;

    /**
     * @var string ��������� ������ �������
     */
    var $Disp;

    /**
     * @var bool �������� ������ php ������� � *.html ������
     */
    var $parser = false;

    /**
     * �����������
     * @global obj $PHPShopSystem
     * @global obj $PHPShopNav
     * @global obj $PHPShopModules
     */
    function PHPShopElements() {
        global $PHPShopSystem, $PHPShopNav, $PHPShopModules;

        $this->SysValue = &$GLOBALS['SysValue'];
        $this->PHPShopSystem = &$PHPShopSystem;
        $this->PHPShopNav = &$PHPShopNav;
        $this->LoadItems = &$GLOBALS['LoadItems'];
        $this->PHPShopModules = &$PHPShopModules;
    }

    /**
     * ������� ����������� �����
     * @global array $SysValue ���������
     * @param string $path ��� ����� ��� ����������
     * @return string
     */
    function OpenHTML($path) {
        global $SysValue;
        $dir = "pageHTML/";
        $pages = $path . ".html";
        $handle = opendir($dir);
        while ($file = readdir($handle)) {
            if ($file == $pages) {
                $urlfile = fopen("$dir$file", "r");
                $text = fread($urlfile, 1000000);
                $text = Parser($text, $this->parser);
                return $text;
            }
        }
        return false;
    }

    /**
     * ���������� � ���������� ������ ����� ������
     * @param string $template ��� ������� ��� ��������
     */
    function addToTemplate($template) {
        $this->Disp.=ParseTemplateReturn($template);
    }

    /**
     * ���������� � ���������� ������
     * @param sting $content �������
     */
    function add($content) {
        $this->Disp.=$content;
    }

    /**
     * ������� �������
     * @param string $template ��� �������
     * @return string
     */
    function parseTemplate($template) {
        return ParseTemplateReturn($template);
    }

    /**
     * �������� ��������� ���������� ��� ��������
     * @param string $name ���
     * @param mixed $value ��������
     * @param bool $flag [1] - ��������, [0] - ����������
     */
    function set($name, $value, $flag = false) {
        if ($flag)
            $this->SysValue['other'][$name].=$value;
        else
            $this->SysValue['other'][$name] = $value;
    }

    /**
     * ������ ��������� ����������
     * @param string $param ������.��� ����������
     * @return mixed
     */
    function getValue($param) {
        $param = explode(".", $param);
        return $this->SysValue[$param[0]][$param[1]];
    }

    /**
     * ������ ���������� �� ����
     * @param string $param ������.��� ����������
     * @return string
     */
    function getValueCache($param) {
        return $this->LoadItems[$param];
    }

    /**
     * ������������ ���������� �� ���������� ���������� �������
     * @param string $method_name ��� �������
     * @param bool $flag ���������� ������ � ����������
     */
    function init($method_name, $flag = false) {

        // ���� ���������� �� ���������� �������
        if (!empty($flag) and $this->isAction($method_name))
            $this->set($method_name, call_user_func(array(&$this, $method_name)), true);

        elseif (empty($this->SysValue['other'][$method_name])) {
            if ($this->isAction($method_name))
                $this->set($method_name, call_user_func(array(&$this, $method_name)));
            elseif ($this->isAction("index"))
                $this->set($method_name, call_user_func(array(&$this, 'index')));
            else
                $this->setError("index", "����� �� ����������");
        }
    }

    /**
     * �������� ������
     * @param string $method_name ��� ������
     * @return bool
     */
    function isAction($method_name) {
        if (method_exists($this, $method_name))
            return true;
    }

    /**
     * ��������� �� ������
     * @param string $name ��� �������
     * @param string $action ���������
     */
    function setError($name, $action) {
        echo '<p><span style="color:red">������ ����������� �������: </span> <strong>' . $name . '()</strong>
	 <br><em>' . $action . '</em></p>';
    }

    /**
     * ���������� ������ ��������� ���������� POST � GET
     */
    function setAction($action) {

        if (!empty($action))
            $this->action = $action;

        if (is_array($this->action)) {
            foreach ($this->action as $k => $v) {

                switch ($k) {

                    // ����� POST
                    case("post"):

                        // ���� ��������� �������
                        if (is_array($v)) {
                            foreach ($v as $function)
                                if (!empty($_POST[$function]) and $this->isAction($function))
                                    return call_user_func(array(&$this, $this->action_prefix . $function));
                        } else {
                            // ���� ���� �����
                            if (!empty($_POST[$v]) and $this->isAction($v))
                                return call_user_func(array(&$this, $this->action_prefix . $v));
                        }
                        break;

                    // ����� GET
                    case("get"):

                        // ���� ��������� �������
                        if (is_array($v)) {
                            foreach ($v as $function)
                                if (!empty($_GET[$function]) and $this->isAction($function))
                                    return call_user_func(array(&$this, $this->action_prefix . $function));
                        } else {
                            // ���� ���� �����
                            if (!empty($_GET[$v]) and $this->isAction($v))
                                return call_user_func(array(&$this, $this->action_prefix . $v));
                        }

                        break;

                    // ����� NAME
                    case("name"):

                        // ���� ��������� �������
                        if (is_array($v)) {
                            foreach ($v as $function)
                                if ($this->PHPShopNav->getName() == $function and $this->isAction($function))
                                    return call_user_func(array(&$this, $this->action_prefix . $function));
                        } else {
                            // ���� ���� �����
                            if ($this->PHPShopNav->getName() == $v and $this->isAction($v))
                                return call_user_func(array(&$this, $this->action_prefix . $v));
                        }

                        break;


                    // ����� NAV
                    case("nav"):

                        // ���� ��������� �������
                        if (is_array($v)) {
                            foreach ($v as $function) {
                                if ($this->PHPShopNav->getNav() == $function and $this->isAction($function)) {
                                    return call_user_func(array(&$this, $this->action_prefix . $function));
                                    $call_user_func = true;
                                }
                            }
                        } else {
                            // ���� ���� �����
                            if ($this->PHPShopNav->getNav() == $v and $this->isAction($v))
                                return call_user_func(array(&$this, $this->action_prefix . $v));
                        }
                        break;
                }
            }
        }
        else
            $this->setError("action", "������ ��������� �������");
    }

    /**
     * ���������� ��������� ������� ���������� �������
     * @param string $class_name ��� ������
     * @param string $function_name ��� ������
     * @param mixed $data ������ ��� ���������
     * @param string $rout ������� ������ � ������� [END | START | MIDDLE], �� ��������� END
     * @return bool
     */
    function setHook($class_name, $function_name, $data = false, $rout = false) {
        return $this->PHPShopModules->setHookHandler($class_name, $function_name, array(&$this), $data, $rout);
    }

}

?>