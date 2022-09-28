<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/**
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */
use Bitrix\Main\Localization\Loc;

if (empty($arResult)) {
    return '';
}

$strReturn = '<nav aria-label="' . Loc::getMessage('BREADCRUMB_ARIA_LABEL') . '"><ol class="breadcrumb">';
$itemSize = count($arResult);

for ($index = 0; $index < $itemSize; $index++) {
	$title = htmlspecialcharsex($arResult[$index]['TITLE']);

	if ($arResult[$index]['LINK'] <> '' && $index !== $itemSize - 1) {
		$strReturn .= '<li class="breadcrumb-item"><a href="' . $arResult[$index]['LINK'] . '">' . $title . '</a></li>';
	} else {
		$strReturn .= '<li class="breadcrumb-item active" aria-current="page">' . $title . '</li>';
	}
}
$strReturn .= '</ol></nav>';

$arItems = [];
for ($index = 0; $index < $itemSize; $index++) {
    $title = htmlspecialcharsex($arResult[$index]['TITLE']);
    $arItems[] = [
        '@type'=>'ListItem',
        'position'=>$index,
        'item'=>[
            '@id'=>$arResult[$index]['LINK'],
            'name'=>$title
        ]
    ];
}
$microData = '<script type="application/ld+json">
	{
		"@context": "http://schema.org",
		"@type": "BreadcrumbList",
		"itemListElement": ' . \Bitrix\Main\Web\Json::encode($arItems) . '
	}
</script>';

return $strReturn . $microData;
