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
 * @var string $parentTemplateFolder
 * @var string $componentPath
 * @var array $templateData
 * @var CBitrixComponent $component
 */
use Bitrix\Main\Localization\Loc;
?>

<?php if (!empty($arResult)): ?>
<ul class="navbar-nav">
<?php
$previousLevel = 0;
foreach ($arResult as $arItem):
    if ($previousLevel && $arItem['DEPTH_LEVEL'] < $previousLevel) {
        echo str_repeat('</ul></li>', ($previousLevel - $arItem['DEPTH_LEVEL']));
    }
    if ($arItem['IS_PARENT']):
        if ($arItem['DEPTH_LEVEL'] === 1):
            $dropdown_label = \CUtil::translit(
                $arItem['TEXT'],
                'ru',
                [
                    'replace_space'=>'',
                    'replace_other'=>''
                ]
            );
?>
    <li class="nav-item dropdown">
        <a<?php if (!($arItem['SELECTED'])): ?> href="<?= $arItem['LINK']; ?>"<?php endif; ?>
            class="nav-link dropdown-toggle<?php if ($arItem['SELECTED']): ?> active<?php endif; ?>"
            id="navbar<?= ucfirst($dropdown_label); ?>"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            <?php if ($arItem['SELECTED']): ?>
            aria-current="page"
            <?php endif; ?>><?= $arItem['TEXT']; ?></a>
        <ul class="dropdown-menu"
            aria-labelledby="navbar<?= ucfirst($dropdown_label); ?>">
<?php
        else:
?>
    <li class="nav-item">
        <a<?php if (!($arItem['SELECTED'])): ?> href="<?= $arItem['LINK']; ?>"<?php endif; ?>
            class="nav-link<?php if ($arItem['SELECTED']): ?> active<?php endif; ?>"
            <?php if ($arItem['SELECTED']): ?>
            aria-current="page"
            <?php endif; ?>><?= $arItem['TEXT'] ?></a>
        <ul>
<?php
        endif;
    elseif ($arItem['PERMISSION'] > 'D'):
        if ($arItem['DEPTH_LEVEL'] === 1):
?>
    <li class="nav-item">
        <a<?php if (!($arItem['SELECTED'])): ?> href="<?= $arItem['LINK']; ?>"<?php endif; ?>
            class="nav-link<?php if ($arItem['SELECTED']): ?> active<?php endif; ?>"
            <?php if ($arItem['SELECTED']): ?>
            aria-current="page"
            <?php endif; ?>><?= $arItem['TEXT']; ?></a>
    </li>
<?php
        else:
?>
    <li>
        <a<?php if (!($arItem['SELECTED'])): ?> href="<?= $arItem['LINK']; ?>"<?php endif; ?>
            class="dropdown-item<?php if ($arItem['SELECTED']): ?> active<?php endif; ?>"
            <?php if ($arItem['SELECTED']): ?>
            aria-current="page"
            <?php endif; ?>><?= $arItem['TEXT']; ?></a>
    </li>
<?php
        endif;
    elseif ($arItem['DEPTH_LEVEL'] === 1):
?>
    <li class="nav-item">
        <a class="nav-link disabled<?php if ($arItem['SELECTED']): ?> active<?php endif; ?>"
           title="<?= Loc::getMessage('MENU_ITEM_ACCESS_DENIED'); ?>"><?= $arItem['TEXT']; ?></a>
    </li>
<?php
    else:
?>
    <li class="nav-item">
        <a class="nav-link disabled<?php if ($arItem['SELECTED']): ?> active<?php endif; ?>"
           title="<?= Loc::getMessage('MENU_ITEM_ACCESS_DENIED'); ?>"><?= $arItem['TEXT']; ?></a>
    </li>
<?php
    endif;
    $previousLevel = $arItem['DEPTH_LEVEL'];
endforeach;

if ($previousLevel > 1) {
    echo str_repeat('</ul></li>', ($previousLevel - 1));
}
?>
</ul>
<?php endif;?>
