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
 * @var COption $siteparam_telegram_link
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
<header class="main-header sticky-top">
    <nav class="navbar navbar-expand-xl bg-white">
        <div class="container-fluid">
            <a class="logo logo_header"
               title="<?= htmlspecialchars($siteparam_logo_name . ' - ' . custom_lcfirst($siteparam_logo_description)); ?>"
                <?php if ($CurDir !== '/'): ?> href="/"<?php endif; ?>>
                <img src="<?= $siteparam_main_logo; ?>"
                     class="logo__img"
                     width="75"
                     height="75"
                     alt="<?= htmlspecialchars($siteparam_logo_name . ' - ' . custom_lcfirst($siteparam_logo_description)); ?>">
                <span class="logo__wrapper">
                        <span class="logo__name"><?= htmlspecialchars($siteparam_logo_name); ?></span>
                        <span class="logo__description"><?= htmlspecialchars($siteparam_logo_description); ?></span>
                    </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" aria-expanded="false"
                    data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-label="<?= Loc::getMessage('HEADER_NAVBAR_ARIA_LABEL'); ?>">
                <span class="navbar-toggler__text"><?= Loc::getMessage('HEADER_NAVBAR_TOGGLER_TEXT'); ?></span>
                <span class="navbar-toggler__icon"><i class="fa-solid fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <div class="ms-auto me-auto">
                    <?php
                    $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "main_menu",
                        array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "main_submenu",
                            "COMPOSITE_FRAME_MODE" => "A",
                            "COMPOSITE_FRAME_TYPE" => "AUTO",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "2",
                            "MENU_CACHE_GET_VARS" => array(
                            ),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "main_menu",
                            "USE_EXT" => "Y",
                            "COMPONENT_TEMPLATE" => "main_menu"
                        ),
                        false
                    ); ?>
                </div>
                <div class="header-contacts">
                    <?php if ($siteparam_telegram_link): ?>
                    <a href="<?= $siteparam_telegram_link; ?>"
                       class="messengers__link"
                       target="_blank"
                       title="<?= Loc::getMessage('HEADER_MESSENGERS_TELEGRAM_TITLE'); ?>"><i class="fa-brands fa-telegram"></i></a>
                    <?php endif; ?>
                    <a href="tel:<?= $siteparam_main_phone_tel; ?>"
                       class="header-contacts__phone-link"
                       title="<?= Loc::getMessage('HEADER_MAIN_PHONE_TITLE'); ?>"><?= $siteparam_main_phone; ?></a>
                </div>
            </div>
        </div>
    </nav>
</header>
<main class="main-area<?php if ($CurDir === '/'): ?> main-area_page-index<?php endif; ?>">
    <div class="container">
        <?php if ($CurDir !== '/'): ?>
        <header class="page-header">
            <?php
            $APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "breadcrumb",
                Array(
                    "START_FROM" => "0",
                    "PATH" => "",
                    "SITE_ID" => SITE_ID,
                ),
                false
            ); ?>
            <h1 class="page-header__title"><?php $APPLICATION->ShowTitle(false); ?></h1>
            <?php $APPLICATION->ShowViewContent('MAIN_SUBTITLE'); ?>
        </header>
        <?php endif; ?>