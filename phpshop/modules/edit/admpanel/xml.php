<?php

include("../../../class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("xml");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("modules");

include_once('../class/basexml.class.php');

// Подключаем БД
$PHPShopBase=new PHPShopBase("../../../inc/config.ini");

// Настройка модулей
$PHPShopModules = new PHPShopModules("../../");


class PHPShopEdit extends PHPShopBaseXml {

    function PHPShopEdit() {
        $this->debug=false;
        $this->true_method=array('update');
        $this->true_from=array('table_name');

        parent::PHPShopBaseXml();
    }

    function admin() {
        global $PHPShopModules;
        if($_POST['log'] == $PHPShopModules->getParam('system.edit.admin_log') and $_POST['pas'] == $PHPShopModules->getParam('system.edit.admin_pas'))
            return true;
    }


    function update() {

        // Массив данных для обновления
        $vars=readDatabase($this->sql,"vars",false);
        //$var=$this->clean($vars[0]);

        // Попытка изменить атрибуты
        @chmod('../../../../pageHTML/'.$vars[0]['name'].'.html', 0775);

        fwrite(fopen('../../../../pageHTML/'.$vars[0]['name'].'.html',"w+"), $vars[0]['content']);
    }
}

$PHPShopEdit = new PHPShopEdit();
?>