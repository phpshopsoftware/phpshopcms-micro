<?php

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "xhtml11.dtd">
<html>
    <head>
        <title>Редактор</title>
    </head>
    <body>
';

// Редактор
include_once('tiny_mce/editor.php');

$Editor = new Editor('wiswyg_content','./tiny_mce/');
$Editor->Value = '';
$Editor->Height	= '400' ;
$Editor->Width	= '100%' ;
$Editor->Css = '/phpshop/templates/'.$_GET['template'].'/style.css';
echo $Editor->AddGUI();
echo "
<script>
document.getElementById('wiswyg_content').value = parent.window.editor['".$_GET['page']."'].getValue();

function save(){
var ed = tinyMCE.get('wiswyg_content');
parent.window.editor['".$_GET['page']."'].setValue(ed.getContent());
parent.window.hs.close();
}

</script>
<p align='right'>
<input type='button' value='Отмена' onclick='parent.window.hs.close()'>
<input type='button' name='save' value='Сохранить' onclick='save()'>
</p>
</body>
<html>";
?>