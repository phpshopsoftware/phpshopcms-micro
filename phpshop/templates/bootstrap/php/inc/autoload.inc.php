<?php

function create_theme_menu($file) {
    static $i;
    $return = null;
    $color = array(
        'cerulean' => '#178ACC',
        'cyborg' => '#000',
        'flatly' => '#D9230F',
        'spacelab' => '#46709D',
        'slate' => '#4E5D6C',
        'yeti' => '#008CBA',
        'simplex' => '#DF691A',
        'sardbirds' => '#45B3AF',
        'wordless' => '#468966',
        'wildspot' => '#564267',
        'loving' => '#FFCAEA'
    );
    if (preg_match("/^bootstrap-theme-([a-zA-Z0-9_]{1,30}).css$/", $file, $match)) {
        $icon = $color[$match[1]];
        if (empty($icon))
            $icon = $match[1];

        return '<div class="bootstrap-theme" style="background:' . $icon . '" title="' . $match[1] . '" data-skin="bootstrap-theme-' . $match[1] . '"></div>';
    }
}

// Редактор тем оформления
if ($GLOBALS['SysValue']['template_theme']['user'] == 'true' or !empty($_SESSION['logPHPSHOP'])) {
    $theme_menu = ' 
  
<div class="panel panel-success">
  <div class="panel-heading">
    <a href="http://faq.phpshop.ru/page/template-theme.html" target="_blank" title="Помощь" class="pull-right"><span class="glyphicon glyphicon-info-sign"></span></a>
    <h3 class="panel-title">Оформление</h3>
  </div>
  <div class="panel-body">
                    <div class="center-block">
                        <div class="bootstrap-theme" style="background:#CCC;" title="default" data-skin="bootstrap"></div>
                        ' . PHPShopFile::searchFile($GLOBALS['SysValue']['dir']['templates'] . chr(47) . $_SESSION['skin'] . '/css/', 'create_theme_menu') . '
                            </div>
                    <div class="clearfix"></div>';
    if (!empty($_SESSION['logPHPSHOP']))
        $theme_menu.='<br>
                <button class="btn btn-default btn-sm saveTheme" role="button"><span class="glyphicon glyphicon-floppy-disk"></span> Сохранить</button>';
    $theme_menu.='
                </div>
</div>
                            ';
    if(!empty($GLOBALS['SysValue']['other']['skinSelect']) or !empty($_SESSION['logPHPSHOP']))
    $GLOBALS['SysValue']['other']['skinSelect'].= $theme_menu;
}

// Мобильная навигация каталога
$menucatalog = null;
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name']);
$data = $PHPShopOrm->select(array('*'), array('parent_to' => '=0'), array('order' => 'num'), array("limit" => 100));
if (is_array($data))
    foreach ($data as $val)
        $menucatalog.='<li><a href="/page/CID_' . $val['id'] . '.html">' . $val['name'] . '</a></li>';
$GLOBALS['SysValue']['other']['menuCatal'] = $menucatalog;

// Личный кабинет
if ($PHPShopNav->getPath() == 'search') {
    $GLOBALS['SysValue']['other']['search_active'] = 'active';
} 

// Цветовые темы CSS
if (isset($_COOKIE['bootstrap_theme'])) {
    if (PHPShopSecurity::true_skin($_COOKIE['bootstrap_theme'])) {
        $GLOBALS['SysValue']['other']['bootstrap_theme'] = $_COOKIE['bootstrap_theme'];
    }
    else
        $GLOBALS['SysValue']['other']['bootstrap_theme'] = 'bootstrap';
} /* elseif (!empty($GLOBALS['SysValue']['other']['template_theme']))
  $GLOBALS['SysValue']['other']['bootstrap_theme'] = $GLOBALS['SysValue']['other']['template_theme']; */
elseif (empty($GLOBALS['SysValue']['other']['bootstrap_theme']))
    $GLOBALS['SysValue']['other']['bootstrap_theme'] = 'bootstrap';
?>