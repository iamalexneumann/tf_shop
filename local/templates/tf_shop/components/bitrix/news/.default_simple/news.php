<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/**
 * @var array $arParams
 * @var array $arResult
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @global CDatabase $DB
 * @var array $arLangMessages
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $templateFile
 * @var string $templateFolder
 * @var string $componentPath
 * @var array $templateData
 * @var CBitrixComponent $component
 */
$this->setFrameMode(true);
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\UI\Extension;
$localization_messages = Loc::loadLanguageFile(__FILE__);

$uf_seo_text_top = '';
$uf_seo_text_bottom = '';
if (Cmodule::IncludeModule('asd.iblock')) {
	$iblock_ufs = CASDiblockTools::GetIBUF($arParams['IBLOCK_ID']);
	$uf_seo_text_top = $iblock_ufs['UF_SEO_TEXT_TOP'] ?? '';
	$uf_seo_text_bottom = $iblock_ufs['UF_SEO_TEXT_BOTTOM'] ?? '';
}
if ($uf_seo_text_top || $uf_seo_text_bottom):
    Extension::load('ui.show_more'); ?>
<script>
    BX.message(<?= CUtil::PhpToJSObject($localization_messages); ?>);
</script>
<?php endif; ?>

<?php if ($uf_seo_text_top): ?>
<div class="seo-text seo-text_top mb-5">
	<?php
	$APPLICATION->IncludeComponent(
		"sprint.editor:blocks",
		".default",
		Array(
			"JSON" => $uf_seo_text_top,
		),
		$component,
		Array(
			"HIDE_ICONS" => "Y"
		)
	); ?>
</div>
<?php endif; ?>

<?php
$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"NEWS_COUNT" => $arParams["NEWS_COUNT"],
		"SORT_BY1" => $arParams["SORT_BY1"],
		"SORT_ORDER1" => $arParams["SORT_ORDER1"],
		"SORT_BY2" => $arParams["SORT_BY2"],
		"SORT_ORDER2" => $arParams["SORT_ORDER2"],
		"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
		"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
		"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],

        "SMALL_CARD_TAG_TITLE" => $arParams["SMALL_CARD_TAG_TITLE"],
        "SHOW_FORM_BLOCK" => $arParams["SHOW_FORM_BLOCK"],
        "FORM_IBLOCK_TYPE" => $arParams["FORM_IBLOCK_TYPE"],
        "FORM_IBLOCK_ID" => $arParams["FORM_IBLOCK_ID"],
        "FORM_ELEMENT_ID" => $arParams["FORM_ELEMENT_ID"],
        "FORM_BACKGROUND_COLOR" => $arParams["FORM_BACKGROUND_COLOR"],
        "FORM_POSITION" => $arParams["FORM_POSITION"],
	),
	$component
); ?>

<?php if ($uf_seo_text_bottom): ?>
<div class="seo-text seo-text_bottom mt-5">
	<?php
	$APPLICATION->IncludeComponent(
		"sprint.editor:blocks",
		".default",
		Array(
			"JSON" => $uf_seo_text_bottom,
		),
		$component,
		Array(
			"HIDE_ICONS" => "Y"
		)
	); ?>
</div>
<?php endif; ?>