<?php

/**
 * Родительский класс создания элементов
 * Примеры использования размещены в папке phpshop/inc/
 * @author PHPShop Software
 * @version 1.2
 * @package PHPShopClass
 */
class PHPShopElements {

    /**
     * @var string имя БД
     */
    var $objBase;
    var $objPath;

    /**
     * @var bool режим отладки
     */
    var $debug = false;

    /**
     * @var string результат работы парсера
     */
    var $Disp;

    /**
     * @var bool включить парсер php функций в *.html файлах
     */
    var $parser = false;

    /**
     * Конструктор
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
     * Возврат содержимого файла
     * @global array $SysValue настройки
     * @param string $path имя файла без расширения
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
     * Добавление в переменную вывода через парсер
     * @param string $template имя шаблона для паисинга
     */
    function addToTemplate($template) {
        $this->Disp.=ParseTemplateReturn($template);
    }

    /**
     * Добавление в переменную вывода
     * @param sting $content контент
     */
    function add($content) {
        $this->Disp.=$content;
    }

    /**
     * Парсинг шаблона
     * @param string $template имя шаблона
     * @return string
     */
    function parseTemplate($template) {
        return ParseTemplateReturn($template);
    }

    /**
     * Создание системной переменной для парсинга
     * @param string $name имя
     * @param mixed $value значение
     * @param bool $flag [1] - добавить, [0] - переписать
     */
    function set($name, $value, $flag = false) {
        if ($flag)
            $this->SysValue['other'][$name].=$value;
        else
            $this->SysValue['other'][$name] = $value;
    }

    /**
     * Выдача системной переменной
     * @param string $param раздел.имя переменной
     * @return mixed
     */
    function getValue($param) {
        $param = explode(".", $param);
        return $this->SysValue[$param[0]][$param[1]];
    }

    /**
     * Выдача переменной из кэша
     * @param string $param раздел.имя переменной
     * @return string
     */
    function getValueCache($param) {
        return $this->LoadItems[$param];
    }

    /**
     * Иницилизация переменной по результату выполенния функции
     * @param string $method_name имя функции
     * @param bool $flag добавление данных в переменную
     */
    function init($method_name, $flag = false) {

        // Если переменная не определена модулем
        if (!empty($flag) and $this->isAction($method_name))
            $this->set($method_name, call_user_func(array(&$this, $method_name)), true);

        elseif (empty($this->SysValue['other'][$method_name])) {
            if ($this->isAction($method_name))
                $this->set($method_name, call_user_func(array(&$this, $method_name)));
            elseif ($this->isAction("index"))
                $this->set($method_name, call_user_func(array(&$this, 'index')));
            else
                $this->setError("index", "метод не существует");
        }
    }

    /**
     * Проверка экшена
     * @param string $method_name имя метода
     * @return bool
     */
    function isAction($method_name) {
        if (method_exists($this, $method_name))
            return true;
    }

    /**
     * Сообщение об ошибке
     * @param string $name имя функции
     * @param string $action сообщение
     */
    function setError($name, $action) {
        echo '<p><span style="color:red">Ошибка обработчика события: </span> <strong>' . $name . '()</strong>
	 <br><em>' . $action . '</em></p>';
    }

    /**
     * Назначение экшена обработки переменных POST и GET
     */
    function setAction($action) {

        if (!empty($action))
            $this->action = $action;

        if (is_array($this->action)) {
            foreach ($this->action as $k => $v) {

                switch ($k) {

                    // Экшен POST
                    case("post"):

                        // Если несколько экшенов
                        if (is_array($v)) {
                            foreach ($v as $function)
                                if (!empty($_POST[$function]) and $this->isAction($function))
                                    return call_user_func(array(&$this, $this->action_prefix . $function));
                        } else {
                            // Если один экшен
                            if (!empty($_POST[$v]) and $this->isAction($v))
                                return call_user_func(array(&$this, $this->action_prefix . $v));
                        }
                        break;

                    // Экшен GET
                    case("get"):

                        // Если несколько экшенов
                        if (is_array($v)) {
                            foreach ($v as $function)
                                if (!empty($_GET[$function]) and $this->isAction($function))
                                    return call_user_func(array(&$this, $this->action_prefix . $function));
                        } else {
                            // Если один экшен
                            if (!empty($_GET[$v]) and $this->isAction($v))
                                return call_user_func(array(&$this, $this->action_prefix . $v));
                        }

                        break;

                    // Экшен NAME
                    case("name"):

                        // Если несколько экшенов
                        if (is_array($v)) {
                            foreach ($v as $function)
                                if ($this->PHPShopNav->getName() == $function and $this->isAction($function))
                                    return call_user_func(array(&$this, $this->action_prefix . $function));
                        } else {
                            // Если один экшен
                            if ($this->PHPShopNav->getName() == $v and $this->isAction($v))
                                return call_user_func(array(&$this, $this->action_prefix . $v));
                        }

                        break;


                    // Экшен NAV
                    case("nav"):

                        // Если несколько экшенов
                        if (is_array($v)) {
                            foreach ($v as $function) {
                                if ($this->PHPShopNav->getNav() == $function and $this->isAction($function)) {
                                    return call_user_func(array(&$this, $this->action_prefix . $function));
                                    $call_user_func = true;
                                }
                            }
                        } else {
                            // Если один экшен
                            if ($this->PHPShopNav->getNav() == $v and $this->isAction($v))
                                return call_user_func(array(&$this, $this->action_prefix . $v));
                        }
                        break;
                }
            }
        }
        else
            $this->setError("action", "экшены объявлена неверно");
    }

    /**
     * Назначение перехвата события выполнения модулем
     * @param string $class_name имя класса
     * @param string $function_name имя метода
     * @param mixed $data данные для обработки
     * @param string $rout позиция вызова к функции [END | START | MIDDLE], по умолчанию END
     * @return bool
     */
    function setHook($class_name, $function_name, $data = false, $rout = false) {
        return $this->PHPShopModules->setHookHandler($class_name, $function_name, array(&$this), $data, $rout);
    }

}

?>