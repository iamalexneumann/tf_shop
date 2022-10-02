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
if ($arResult['VARIABLES']['ELEMENT_CODE']) {
    $section = '';
    if ($arResult['VARIABLES']['SECTION_CODE']) {
        $section = get_section_ufs_from_url($arParams['IBLOCK_ID'], $arResult['VARIABLES']['SECTION_CODE']);
    }
    $element = get_element_id_from_element_code($arResult['VARIABLES']['ELEMENT_CODE']);
    $items_prev = CIBlockElement::GetList(
        ['ID' => 'DESC'],
        [
            'ACTIVE' => 'Y',
            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
            '=IBLOCK_SECTION_ID' => $section['ID'],
            '<ID' => $element['ID'],
        ],
        false,
        ['nTopCount' => 1],
        [
            'DETAIL_PAGE_URL',
            'NAME'
        ]
    );
    $arResult['PREV_POST'] = $items_prev->GetNext();


    $items_next = CIBlockElement::GetList(
        ['ID' => 'ASC'],
        [
            'ACTIVE' => 'Y',
            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
            '=IBLOCK_SECTION_ID' => $section['ID'],
            '>ID' => $element['ID'],
        ],
        false,
        ['nTopCount' => 1],
        [
            'DETAIL_PAGE_URL',
            'NAME'
        ]
    );
    $arResult['NEXT_POST'] = $items_next->GetNext();
}