<?php
AddEventHandler('main', 'OnEndBufferContent', 'removeType');
$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler('main', 'OnEndBufferContent', 'deleteKernelCss');
$eventManager->addEventHandler('main', 'OnEndBufferContent', 'removeSpacesAndTabs');

function removeType(&$content)
{
    $content = replace_output($content);
}
function replace_output($d)
{
    return str_replace(' type="text/javascript"', "", $d);
}

function deleteKernelCss(&$content) {
    global $USER;

    if (!$USER->IsAuthorized()) {
        $arPatternsToRemove = Array(
            '/<link.+?href=".+?kernel_main\/kernel_main_v1\.css\?\d+"[^>]+>/',
            '/<link.+?href=".+?bitrix\/js\/main\/core\/css\/core[^"]+"[^>]+>/',
            '/<script.+?>if\(\!window\.BX\)window\.BX.+?<\/script>/',
            '/<script[^>]+?>\(window\.BX\|\|top\.BX\)\.message[^<]+<\/script>/',
            // '/<script.+?src=".+?bitrix\/js\/main\/core\/core[^"]+"><\/script\>/',
            '/<script.+?>BX\.(setCSSList|setJSList)\(\[.+?\]\).*?<\/script>/',
            '/BX\.(setCSSList|setJSList)\(\[.+?\]\);/',
            '/\s{2,}/'
        );

        $content = preg_replace($arPatternsToRemove, ' ', $content);

    }
}

function removeSpacesAndTabs(&$content) {
    global $APPLICATION;
    $page = $APPLICATION->GetCurPage();

    if ($page != '/bitrix/tools/captcha.php' && $page != '/bitrix/admin/captcha.php') {
        $content = preg_replace('/[ \t]+/', ' ', $content);
        $content = str_replace(['\n \n'], '\n', $content);
    }
}