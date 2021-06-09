<?php

function seo_getMeta($content) {

    // Title
    $patern = "/<H1>(.*)<\/H1>/i";
    preg_match($patern, $content, $matches);
    $title = $matches[1];

    // Description
    $patern = "/<desc>(.*)<\/desc>/i";
    preg_match($patern, $content, $matches);
    $description = $matches[1];

    // Keywords
    $patern = "/<key>(.*?)<\/key>/i";
    preg_match_all($patern, $content, $matches, PREG_PATTERN_ORDER);
    $keywords = implode(', ', $matches[1]);

    // Cutted keywords
    $patern = "/<cut_key>(.*?)<\/cut_key>/i";
    preg_match_all($patern, $content, $matches, PREG_PATTERN_ORDER);
    $matches[1][] = $keywords;
    $keywords = implode(', ', $matches[1]);

    // Cutted description
    $patern = "/<cut_desc>(.*?)<\/cut_desc>/i";
    preg_match_all($patern, $content, $matches, PREG_PATTERN_ORDER);
    $matches[1][] = $description;
    $description = implode(' ', $matches[1]);

    return array('title' => $title, 'description' => $description, 'keywords' => $keywords);
}

function seo_cutTags($content, $tagName = false, $mode = 'cut') {

    if (!$tagName) {
        // Если не указан тег, маска по умолчанию - cut_*
        $patern = '/<(cut_[^>]+)>((?:(?!<\/\1>).)*)<\/\1>/i';
    } elseif (is_array($tagName)) {
        // если указан массив тегов, строим массив масок
        if (array_walk($tagName, create_function('&$tag,$k', '$tag = \'/<(\'.$tag.\')>((?:(?!<\/\1>).)*)<\/\1>/i\';'))) {
            $patern = $tagName;
        }
    } else {
        $patern = '/<(' . $tagName . ')>((?:(?!<\/\1>).)*)<\/\1>/i';
    }
    if ($mode == 'trim') {
        $replacement = "\2";
    } else {
        $replacement = "";
    }
    $content = preg_replace($patern, $replacement, $content);
    return $content;
}

function seo_cleanTag($content) {
    // Вычищаем теги cut_*
    $content = seo_cutTags($content);
    // Обрезаем desc и key
    $content = seo_cutTags($content, array('desc', 'key'), 'trim');

    return $content;
}

function page_seo_hook($obj, $dis) {

    // Мета
    $meta = seo_getMeta($dis);

    if (!empty($meta['title'])) {
        $meta['title'] .= ' - ';
    }

    $obj->title = $meta['title'] . $obj->PHPShopSystem->getValue("name");
    $obj->description = $meta['description'];
    $obj->keywords = $meta['keywords'];

    // Вычищаем служебные теги
    $obj->set('pageContent', seo_cleanTag($dis));
}

$addHandler = array
    (
    'page' => 'page_seo_hook',
);
?>