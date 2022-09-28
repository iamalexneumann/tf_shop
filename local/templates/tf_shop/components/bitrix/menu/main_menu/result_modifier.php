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
foreach ($arResult as $key => &$arItem) {
    if ($arItem['DEPTH_LEVEL'] > $arParams['MAX_LEVEL']) {
        unset($arResult[$key]);
    }
    if ($arItem['DEPTH_LEVEL'] === $arParams['MAX_LEVEL']) {
        if ($arItem['IS_PARENT'] == '1') {
            $arResult[$key]['IS_PARENT'] = '';
        }
    }
}