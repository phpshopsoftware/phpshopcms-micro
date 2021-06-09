<?
/**
 * Библиотека проверки безопасности
 * @author PHPShop Software
 * @version 1.2
 * @package PHPShopClass
 */
class PHPShopSecurity {

    /**
     * Проверка на пустые данные
     * @return bool
     */
    function true_param() {
        $Arg=func_get_args();
        foreach($Arg as $val) {
            if(empty($val)) return false;
        }
        return true;
    }

    /**
     * Проверка расширения файла
     * @param string $sFileName имя файла
     * @return mixed
     */
    function getExt($sFileName) {
        $sTmp=$sFileName;
        while($sTmp!="") {
            $sTmp=strstr($sTmp,".");
            if($sTmp!="") {
                $sTmp=substr($sTmp,1);
                $sExt=$sTmp;
            }
        }
        $pos=stristr($sFileName, "php");
        if($pos === false) return strtolower($sExt);
    }

    /**
     * Очистка строк от [/]["][']
     * @param string $str текст для проверки
     * @return string
     */
    function CleanStr($str) {
        $str=str_replace("/","",$str);
        $a= str_replace("\"", "", $str);
        return str_replace("'", "", $a);
    }

    /**
     * Очистка тегов и переводов строк  [\r\n\t]
     * @param string $str текст для анализа
     * @return string
     */
    function CleanOut($str) {
        $str = preg_replace('([\r\n\t])', '', $str);
        $str = @html_entity_decode($str);
        return $str;
    }

    /**
     * Проверка почтового адреса
     * @param string $email адрес
     * @return bool
     */
    function true_email($email) {
        if(strlen($email)>100) return FALSE;
        return preg_match("/^([a-z0-9_\.-]+@[a-z0-9_\.\-]+\.[a-z0-9_-]{2,6})$/i",$email);
    }

    /**
     * Проверка логина
     * @param string $login логин
     * @return bool
     */
    function true_login($login) {
        return preg_match("/^[a-zA-Z0-9_\.]{2,20}$/",$login);
    }

    /**
     * Проверка номера
     * @param int $num номер
     * @return bool
     */
    function true_num($num) {
        return preg_match("/^[0-9]{1,5}$/",$num);
    }

    /**
     * Проверка пароля
     * @param string $passw пароль
     * @return bool
     */
    function true_passw($passw) {
        return preg_match("/^[a-zA-Z0-9_]{4,20}$/",$passw);
    }

    /**
     * Универсальная проверка
     * @param string $str строка
     * @param int $flag параметр [1]-корзину,[2]-преобразует все в код html,[3]-почту,[4]-ввод с формы,[5]-цифры
     * @return mixed
     */

    function TotalClean($str,$flag=2) {

        switch ($flag) {
            case 1:
                if(!ereg ("([0-9])", $str)) $str="0";
                return abs($str);
                break;

            case 2:
                return htmlspecialchars(stripslashes($str));
                break;

            case 3:
                if(!preg_match("/^([a-z0-9_\.-]+@[a-z0-9_\.\-]+\.[a-z0-9_-]{2,6})$/i",$str)) $str="";
                return $str;
                break;

            case 4:
                if(preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$str)) $str="";
                return  htmlspecialchars(stripslashes($str));
                break;

            case 5:
                if(preg_match("/[^(0-9)|(\-)|(\.]/",$str))  $str=0;
                return $str;
                break;
        }

    }

    /**
     * Проверка Request переменных на запрещенные команды
     * @param string $search
     */
    function RequestSearch($search) {
        $pathinfo=pathinfo($_SERVER['PHP_SELF']);
        $f=$pathinfo['basename'];
        if(empty($_SESSION['theme'])) $_SESSION['theme']='classic';
        $com=array("union","select","insert","update","delete");
        $mes='<h3>Внимание</h3>Работа скрипта '.$_SERVER['PHP_SELF'].' прервана из-за использования запрещенной команды';
        $mes2="<br>Удалите все вхождения этой команды в водимой информации.";
        foreach($com as $v)
            if(@preg_match("/".$v."/i", $search)) exit($mes.' <b style="color:red">'.$v.'</b>'.$mes2);
    }

}

?>