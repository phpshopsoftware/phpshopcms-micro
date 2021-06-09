<?php

// ѕроверка прав пользовател€ и авторизации
function edit_check_rules($obj,$page) {
    if(PHPShopSecurity::true_param($_SESSION['userNamePath'],$_SESSION['userName'])) {

        if($_SESSION['userNamePath'] == '*')
            return true;

        else if(!strstr($_SESSION['userNamePath'], ',')) {
            $path[]=$_SESSION['userNamePath'];
        }else {
            $path = explode(",",$_SESSION['userNamePath']);
        }

        foreach($path as $file) {
            if($file == $page) {
                return true;
            }
        }
        return false;
    }
    else return false;
}

function edit_menu_hook($obj,&$dis) {
    $pages='menu';
    if(edit_check_rules($obj,$pages)) {
        $dis='<div id="'.$pages.'">'.$dis.'</div><div align="right"><div name="tmp_'.$pages.'" id="tmp_'.$pages.'" style="display:none"></div>
            <a id="cancelButton_'.$pages.'" href="javascript:PHPShopMicro.cancel(\''.$pages.'\')"></a>
<a id="editButton_'.$pages.'" href="javascript:PHPShopMicro.edit(\''.$pages.'\',true)">[edit]</a>
    </div>';
    }
}

function edit_catalog_hook($obj,&$dis) {
    $pages='catalog';
    if(edit_check_rules($obj,$pages)) {
        $pages='catalog';
        $dis=edit_icon_panel($pages,$dis);
    }
}

function edit_index_hook($obj,$str) {
    $pages='index';
    if(edit_check_rules($obj,$pages)) {
        $obj->set('pageContent',edit_icon_panel($pages,$str));
    }
}

function edit_page_hook($obj,$str) {
    $pages=PHPShopSecurity::TotalClean($obj->PHPShopNav->getName(),2);
    if(edit_check_rules($obj,$pages)) {
        $obj->set('pageContent',edit_icon_panel($pages,$str));
    }
}

function edit_icon_panel($pages,$str) {
    $dis='<div id="'.$pages.'">'.$str.'</div><div align="right"><div name="tmp_'.$pages.'" id="tmp_'.$pages.'" style="display:none"></div>
<img id="editButtonIconCancel_'.$pages.'" src="phpshop/modules/edit/templates/blank.gif" align="absmiddle" >
<a id="cancelButton_'.$pages.'" href="javascript:PHPShopMicro.cancel(\''.$pages.'\')"></a>
<img id="editButtonIconWiswyg_'.$pages.'" src="phpshop/modules/edit/templates/blank.gif" align="absmiddle">
<a id="wiswygButton_'.$pages.'" href="javascript:PHPShopMicro.wiswyg(\''.$pages.'\')"></a>
<img id="editButtonIcon_'.$pages.'" src="phpshop/modules/edit/templates/edit.png" align="absmiddle">
<a id="editButton_'.$pages.'" href="javascript:PHPShopMicro.edit(\''.$pages.'\')">[edit]</a>
            </div>';
    return $dis;
}

function edit_other_hook($obj,$str) {
    $pages = str_replace ("phpshop", "", get_class($obj));
    if(edit_check_rules($obj,$pages)) {
        $obj->set('pageContent',edit_icon_panel($pages,$str));
    }

}

$addHandler=array(
        'indexpage'=>'edit_index_hook',
        'page'=>'edit_page_hook',
        'topMenu'=>'edit_menu_hook',
        'mainMenuPage'=>'edit_catalog_hook',
        'index'=>'edit_other_hook'
);
?>