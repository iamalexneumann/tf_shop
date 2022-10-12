<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/**
 * @var CMain $APPLICATION
 * @var CMain $CurDir
 * @var CSite $arSite
 * @var COption $siteparam_scripts_head
 * @var COption $siteparam_scripts_body_before
 * @var COption $siteparam_main_logo
 * @var COption $siteparam_main_phone
 * @var COption $siteparam_main_phone_tel
 * @var COption $siteparam_logo_name
 * @var COption $siteparam_logo_description
 * @var COption $siteparam_telegram_chanell
 */
use Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
?>
<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID; ?>">
<head>
    <title><?php $APPLICATION->ShowTitle(); ?> | <?= $siteparam_logo_name; ?></title>
    <?php
    echo $siteparam_scripts_head;
    use Bitrix\Main\UI\Extension;
    use Bitrix\Main\Page\Asset;
    Extension::load(
        [
            'ui.bootstrap5',
            'ui.fonts.font-awesome',
            'ui.fonts.montserrat',
            'ui.lazysizes',
        ]
    );
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/main.js');
    $APPLICATION->ShowHead();
    ?>
    <link rel="apple-touch-icon" sizes="180x180" href="/price/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/price/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/price/favicon-16x16.png">
    <link rel="manifest" href="/price/site.webmanifest">
    <link rel="mask-icon" href="/price/safari-pinned-tab.svg" color="#d90429">
    <link rel="shortcut icon" href="/price/favicon.ico">
    <meta name="msapplication-TileColor" content="#d90429">
    <meta name="msapplication-config" content="/price/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?= $siteparam_scripts_body_before; ?>
<?php $APPLICATION->ShowPanel(); ?>
<?php
$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "message_list",
    Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "N",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array(0=>"",1=>"",),
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "4",
        "IBLOCK_TYPE" => "secondary_content",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "Y",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "5",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_TITLE" => "",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array(0=>"ATT_BTN_SHOW",1=>"ATT_BTN_LINK",2=>"ATT_BTN_TEXT",3=>"",),
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SORT_BY1" => "SORT",
        "SORT_BY2" => "ACTIVE_FROM",
        "SORT_ORDER1" => "ASC",
        "SORT_ORDER2" => "DESC",
        "STRICT_SECTION_CHECK" => "Y"
    )
); ?>
<header class="main-header">
    <div class="container">
        <div class="logo">
            <div class="logo__name"><?= $siteparam_logo_name; ?></div>
            <div class="logo__description"><?= $siteparam_logo_description; ?></div>
        </div>

        <?php if ($siteparam_telegram_chanell): ?>
        <a href="<?= $siteparam_telegram_chanell; ?>"
           class="btn btn-primary telegram-chanell"
           target="_blank"
           title="<?= Loc::getMessage('HEADER_MESSENGERS_TELEGRAM_CHANELL_TITLE'); ?>">
            <?= Loc::getMessage('HEADER_MESSENGERS_TELEGRAM_CHANELL_TITLE'); ?>
            <i class="fa-brands fa-telegram telegram-chanell__icon"></i>
        </a>
        <?php endif; ?>
    </div>
</header>
<main>