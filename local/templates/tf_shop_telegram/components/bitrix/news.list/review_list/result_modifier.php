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
if ($arResult['ITEMS']) {
    foreach ($arResult['ITEMS'] as $key => &$arItem) {
        $item_picture = $arItem['PREVIEW_PICTURE'];
        if ($item_picture) {
            $arItemPictureFileTmp = \CFile::ResizeImageGet(
                $item_picture,
                [
                    'width' => 75,
                    'height' => 75,
                ],
                BX_RESIZE_IMAGE_EXACT,
                true
            );

            $arItemPictureLqipFileTmp = \CFile::ResizeImageGet(
                $item_picture,
                [
                    'width' => 50,
                    'height' => 50,
                ],
                BX_RESIZE_IMAGE_EXACT,
                true
            );

            if ($arItemPictureFileTmp['src']) {
                $arItemPictureFileTmp['src'] = \CUtil::GetAdditionalFileURL($arItemPictureFileTmp['src'], true);
            }

            if ($arItemPictureLqipFileTmp['src']) {
                $arItemPictureLqipFileTmp['src'] = \CUtil::GetAdditionalFileURL($arItemPictureLqipFileTmp['src'], true);
            }

            $arItem['PICTURE'] = array_change_key_case($arItemPictureFileTmp, CASE_UPPER);
            $arItem['PICTURE_LQIP'] = array_change_key_case($arItemPictureLqipFileTmp, CASE_UPPER);
        }
        $arItem['DATE'] = FormatDate('j F Y', MakeTimeStamp($arItem['DISPLAY_PROPERTIES']['ATT_DATE']['VALUE']));
        $arItem['DATETIME'] = FormatDate('Y-m-d', MakeTimeStamp($arItem['DISPLAY_PROPERTIES']['ATT_DATE']['VALUE']));
        $arItem['TAGS'] = explode(', ', $arItem['TAGS']);
    }
}