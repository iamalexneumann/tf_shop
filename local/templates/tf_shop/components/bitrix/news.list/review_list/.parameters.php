<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
use Bitrix\Main\Localization\Loc;

CModule::IncludeModule("iblock");

$iblock_type = [];
$iblock_type_list = CIBlockType::GetList(
    ["sort" => "asc"],
    ["ACTIVE" => "Y"],
);
while ($arr_iblock_type = $iblock_type_list->Fetch()) {
    if ($arr_iblock_type_lang = CIBlockType::GetByIDLang($arr_iblock_type["ID"], LANGUAGE_ID)) {
        $iblock_type[$arr_iblock_type["ID"]] = '[' . $arr_iblock_type["ID"] . '] ' . $arr_iblock_type_lang["NAME"];
    }
}

$iblock_id = [];
$iblock_id_list = CIBlock::GetList(
    [
        "SORT" => "ASC"
    ],
    [
        "TYPE" => $arCurrentValues["FORM_IBLOCK_TYPE"],
        "ACTIVE"=>"Y"
    ],
);
while ($arr_iblock_id = $iblock_id_list->Fetch()) {
    $iblock_id[$arr_iblock_id["ID"]] = '[' . $arr_iblock_id["ID"] . '] ' . $arr_iblock_id["NAME"];
}

$iblock_element = [];
$iblock_element_list = CIBlockElement::GetList(
    [],
    [
        "IBLOCK_ID" => $arCurrentValues['FORM_IBLOCK_ID'],
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y",
    ],
    false,
    [
        "nPageSize" => 50
    ],
    [
        "ID",
        "NAME",
    ]
);
while ($arr_iblock_element = $iblock_element_list->Fetch()) {
    $iblock_element[$arr_iblock_element["ID"]] = '[' . $arr_iblock_element["ID"] . '] ' . $arr_iblock_element["NAME"];
}

$arTemplateParameters = [
    "SMALL_CARD_TAG_TITLE" => [
        "NAME" => Loc::getMessage('NEWS_SMALL_CARD_TAG_TITLE'),
        "TYPE" => "LIST",
        "VALUES" => [
            "2" => "<h2>",
            "3" => "<h3>",
            "4" => "<h4>",
            "5" => "<h5>",
            "6" => "<h6>"
        ],
        "DEFAULT" => "2",
    ],
    "SHOW_FORM_BLOCK" => [
        "NAME" => Loc::getMessage('NEWS_SHOW_FORM_BLOCK'),
        "TYPE" => "CHECKBOX",
        "DEFAULT" =>"N",
        "REFRESH" => "Y",
    ],
];

if ($arCurrentValues['SHOW_FORM_BLOCK'] === 'Y') {
    $arTemplateParameters['FORM_IBLOCK_TYPE'] = [
        "NAME" => Loc::getMessage('NEWS_FORM_IBLOCK_TYPE'),
        "TYPE" => "LIST",
        "VALUES" => $iblock_type,
        "REFRESH" => "Y",
    ];
    $arTemplateParameters['FORM_IBLOCK_ID'] = [
        "NAME" => Loc::getMessage('NEWS_FORM_IBLOCK_ID'),
        "TYPE" => "LIST",
        "VALUES" => $iblock_id,
        "REFRESH" => "Y",
        "ADDITIONAL_VALUES" => "Y",
    ];
    $arTemplateParameters['FORM_ELEMENT_ID'] = [
        "NAME" => Loc::getMessage('NEWS_FORM_ELEMENT_ID'),
        "TYPE" => "LIST",
        "VALUES" => $iblock_element,
        "ADDITIONAL_VALUES" => "Y",
    ];
    $arTemplateParameters['FORM_BACKGROUND_COLOR'] = [
        "NAME" => Loc::getMessage('NEWS_FORM_BACKGROUND_COLOR'),
        "TYPE" => "LIST",
        "VALUES" => [
            "primary" => Loc::getMessage('NEWS_FORM_BACKGROUND_COLOR_OPTION_PRIMARY'),
            "danger" => Loc::getMessage('NEWS_FORM_BACKGROUND_COLOR_OPTION_DANGER'),
        ],
        "DEFAULT" => "1",
    ];
    $arTemplateParameters['FORM_POSITION'] = [
        "NAME" => Loc::getMessage('NEWS_FORM_POSITION'),
        "TYPE" => "LIST",
        "VALUES" => [
            "1" => "1",
            "2" => "2",
            "3" => "3",
            "4" => "4",
            "5" => "5"
        ],
        "DEFAULT" => "3",
    ];
}