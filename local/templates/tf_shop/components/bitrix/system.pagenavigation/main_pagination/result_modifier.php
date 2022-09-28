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
 * @var CBitrixComponentTemplate $this
 */
use Bitrix\Main\Page\Asset;

if (!function_exists('PaiGetSiteInfo')) {
    function PaiGetSiteInfo($siteId = SITE_ID)
    {
        if (empty($siteId)) {
            return '';
        }
        $arSite = false;
        $obCache = new \CPHPCache();
        if ($obCache->InitCache(36000, 'site_' . $siteId, '/')) {
            $arSite = $obCache->GetVars();
        } elseif ($obCache->StartDataCache()) {
            $arSite = \CSite::GetByID($siteId)->Fetch();
            $obCache->EndDataCache($arSite);
        }
        return $arSite;
    }
}

$context = \Bitrix\Main\Application::getInstance()->getContext();
$server = $context->getServer();
$curPage = $server->getRequestUri();
$arSiteInfo = PaiGetSiteInfo();
$arResult['PROTOCOL'] = CMain::IsHTTPS() ? 'https://' : 'http://';
$arResult['SERVER_NAME'] = $arSiteInfo['SERVER_NAME'];
$arResult['NEXT_NUM'] = $arResult['NavPageNomer'] + 1;
$arResult['PREV_NUM'] = $arResult['NavPageNomer'] - 1;
$arResult['NEXT_PAGE'] = $arResult['PROTOCOL'] . $arResult['SERVER_NAME'] . $arResult['sUrlPath'] .
    '?' . $strNavQueryString . 'PAGEN_' . $arResult['NavNum'] .'=' . $arResult['NEXT_NUM'];
$arResult['PREV_PAGE'] = $arResult['PROTOCOL'] . $arResult['SERVER_NAME'] . $arResult['sUrlPath'] .
    '?' . $strNavQueryString . 'PAGEN_' . $arResult['NavNum'] . '=' . $arResult['PREV_NUM'];

if (intval($arResult['NavPageCount']) > 1) {
    if ($arResult['PREV_NUM'] >= 1) {
        Asset::getInstance()->addString('<link rel="prev" href="' . $arResult['PREV_PAGE'] . '">');
    }
    if ($arResult['NEXT_NUM'] <= $arResult['NavPageCount']) {
        Asset::getInstance()->addString('<link rel="next" href="' . $arResult['NEXT_PAGE'] . '">');
    }
    if ($arResult['NavPageNomer'] > 1) {
        $APPLICATION->SetDirProperty('robots','noindex,follow');
    }
}