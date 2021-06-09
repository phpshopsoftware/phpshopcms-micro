<?php

function template_index_cloud_hook($obj, $array) {
    $disp = null;

    foreach ($array as $key => $val)
        $disp.="<a href='/page/" . $val . ".html' class='btn btn-default btn-xs'>$key</a>";

    $obj->set('leftMenuContent', '<div class="product-tags">' . $disp . '</div>');
}

$addHandler = array
    (
    'index' => 'template_index_cloud_hook',
);
?>