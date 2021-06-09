<?php

/**
 * ����������� �������
 * @author PHPShop Software
 * @version 1.5
 * @package PHPShopClass
 */
class PHPShopModules {

    /**
     * @var mixed ������ ��������� �������� �������
     */
    var $ModValue;

    /**
     * @var string ������������� ���������� �������
     */
    var $ModDir;

    /**
     * @var bool ����� �������
     */
    var $debug = false;

    /**
     * �����������
     * @param string $ModDir  ������������� ���������� �������
     */
    function PHPShopModules($ModDir = "phpshop/modules/") {
        $this->ModDir = $ModDir;
        $this->objBase = $GLOBALS['SysValue']['base']['table_name2'];

        if (@$dh = opendir($this->ModDir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file != "." and $file != "..") {
                    $this->getIni($file);
                }
            }
        }

        // ��������� ���� �������
        $this->addTemplateHook();
    }

    /**
     * ��������� �������� ������� �������
     * @param string $path ���� �� ������������ ������
     */
    function getIni($path) {
        $ini = $this->ModDir . $path . "/inc/config.ini";
        if (file_exists($ini)) {
            $SysValue = parse_ini_file($ini, 1);

            if (!empty($SysValue['system']['enabled'])) {

                if (is_array($SysValue['autoload']))
                    foreach ($SysValue['autoload'] as $k => $v)
                        $this->ModValue['autoload'][$k] = $v;

                if (is_array($SysValue['core']))
                    foreach ($SysValue['core'] as $k => $v)
                        $this->ModValue['core'][$k] = $v;

                if (is_array($SysValue['class']))
                    foreach ($SysValue['class'] as $k => $v)
                        $GLOBALS['SysValue']['class'][$k] = $v;

                if (is_array($SysValue['lang']))
                    foreach ($SysValue['lang'] as $k => $v)
                        $GLOBALS['SysValue']['lang'][$k] = $v;

                if (is_array($SysValue['system']))
                    foreach ($SysValue['system'] as $k => $v)
                        $this->ModValue['system'][$path][$k] = $v;

                if (is_array($SysValue['hook']))
                    foreach ($SysValue['hook'] as $k => $v)
                        $this->ModValue['hook'][][$k] = $v;

                $this->ModValue['templates'][$path] = $SysValue['templates'];
                $GLOBALS['SysValue']['templates'][$path] = $SysValue['templates'];
                $this->ModValue['class'][$path] = $SysValue['class'];
                $GLOBALS['SysValue']['system'][$path] = $this->ModValue['system'][$path];
            }
        }
    }

    /**
     * ��������� �������� ������� ����� ������� /php/hook/
     */
    function addTemplateHook() {
        $ini = 'phpshop/templates/' . $_SESSION['skin'] . "/php/inc/config.ini";
        if (file_exists($ini)) {
            $SysValue = parse_ini_file($ini, 1);

            if (is_array($SysValue['autoload']))
                foreach ($SysValue['autoload'] as $k => $v)
                    $this->ModValue['autoload'][$k] = './phpshop/templates/' . $_SESSION['skin'] . chr(47) . $v;
            
            if (is_array($SysValue['core']))
                foreach ($SysValue['core'] as $k => $v)
                    $this->ModValue['core'][$k] = './phpshop/templates/' . $_SESSION['skin'] . chr(47) . $v;

            if (is_array($SysValue['hook']))
                foreach ($SysValue['hook'] as $k => $v)
                    $this->ModValue['hook'][][$k] = './phpshop/templates/' . $_SESSION['skin'] . chr(47) . $v;
        }
    }

    /**
     * �������� ��������� ������������ �������
     */
    function doLoad() {
        global $SysValue, $PHPShopSystem, $PHPShopNav;
        if (is_array($this->ModValue['autoload']))
            foreach ($this->ModValue['autoload'] as $k => $v) {
                if (file_exists($v))
                    require_once($v);
                else
                    echo("������ �������� ������ " . $k . "<br>����: " . $v);
            }
    }

    /**
     * �������� ���� �������
     * @param string $path ���� ���������� core ����� ������
     * @return <type>
     */
    function doLoadPath($path) {
        global $SysValue;
        if (!empty($this->ModValue['core'][$path])) {
            if (is_file($this->ModValue['core'][$path])) {
                require_once($this->ModValue['core'][$path]);
                $classname = 'PHPShop' . ucfirst($SysValue['nav']['path']);

                if (class_exists($classname)) {
                    $PHPShopCore = new $classname ();
                    $PHPShopCore->loadActions();
                    return true;
                } else
                    echo PHPShopCore::setError($classname, "�� ��������� ����� phpshop/modules/*/core/$classname.core.php");
            }
            else
                PHPShopCore::setError($path, "������ �������� ������ " . $path . "<br>����: " . $this->ModValue['core'][$path]);
        }else
            return false;
    }

    /**
     * ������ ���������������� �������� �������
     * @param string ��� ��������� ����� ������.������������ [������.���������.������������]
     * @return <type>
     */
    function getParam($param) {
        $param = explode(".", $param);
        if (count($param) > 2)
            return $this->ModValue[$param[0]][$param[1]][$param[2]];
        return $this->ModValue[$param[0]][$param[1]];
    }

    /**
     * ������ ���������������� �������� �������
     * @return array
     */
    function getModValue() {
        return $this->ModValue;
    }

    /**
     * ������ � ������� ������ �� ����
     * <code>
     * // example:
     * $PHPShopModules->Parser(array('page'=>'market'),'catalog_page_1');
     * </code>
     * @param array $preg ������ ���������� ��������
     * @param string $TemplateName ��� �������
     * @return string
     */
    function Parser($preg, $TemplateName) {
        $file = newGetFile($GLOBALS['SysValue']['dir']['templates'] . chr(47) . $_SESSION['skin'] . chr(47) . $TemplateName);

        // ������
        foreach ($preg as $k => $v)
            $file = str_replace($k, $v, $file);

        $dis = newParser($file);
        return @$dis;
    }

    /**
     * �������� ������� Hook
     * @param string $class_name ��� ������
     * @param string $function_name ��� �������
     * @param mixed $obj ������
     * @param mixed $data ������
     * @param string �������� ���������� ���� [END|START|MIDDLE]
     */
    function setHookHandler($class_name, $function_name, $obj = false, $data = false, $rout = 'END') {

        if (!empty($this->ModValue['hook'])) {

            foreach ($this->ModValue['hook'] as $hooks) {

                if (isset($hooks[strtolower($class_name)])) {
                    if ((phpversion() * 1) >= '5.0')
                        $hook = $hooks[strtolower($class_name)];
                    else
                        $hook = $hooks[$class_name];
                }
                else
                    $hook = null;

                if (isset($hook)) {
                    if (is_file($hook)) {

                        $addHandler = null;
                        include_once($hook);

                        if ((phpversion() * 1) >= '5.0') {

                            if (is_array($addHandler))
                                foreach ($addHandler as $v => $k)
                                    if (!strstr($v, '#'))
                                        $this->addHandler[$class_name][$v][] = $k;
                        }
                        else {

                            // ��������� ���� ������� � ������ �������
                            if (is_array($addHandler))
                                foreach ($addHandler as $v => $k)
                                    if (!strstr($v, '#'))
                                        $this->addHandler[$class_name][strtolower($v)][] = $k;
                        }

                        if (is_array($this->addHandler[$class_name][$function_name]))
                            foreach ($this->addHandler[$class_name][$function_name] as $hook_function_name) {
                                $user_func_result = call_user_func_array($hook_function_name, array(&$obj, &$data, $rout));

                                if (!empty($user_func_result))
                                    return $user_func_result;
                            }
                    }
                    else
                        echo ("������ ���������� ������ " . $hook);
                }
            }
        }
    }

}

?>