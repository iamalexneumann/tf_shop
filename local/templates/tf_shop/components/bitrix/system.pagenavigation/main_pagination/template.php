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
$this->setFrameMode(true);
use Bitrix\Main\Localization\Loc;
?>

<?php
if (!$arResult['NavShowAlways']) {
    if ((int)$arResult['NavRecordCount'] === 0 || ((int)$arResult['NavPageCount'] === 1 && $arResult['NavShowAll'] === false)) {
        return;
    }
}
?>
<ul class="pagination" aria-label="<?= Loc::getMessage('MAIN_PAGINATION_ARIA_LABEL'); ?>">
    <?php
    $strNavQueryString = ($arResult['NavQueryString'] !== '' ? $arResult['NavQueryString'] . '&amp;' : '');
    $strNavQueryStringFull = ($arResult['NavQueryString'] !== '' ? '?' . $arResult['NavQueryString'] : '');

    $bFirst = true;
    if ($arResult['bDescPageNumbering'] === true):
        if ($arResult['NavPageNomer'] < $arResult['NavPageCount']):
            if ($arResult['bSavePage']): ?>
                <li class="page-item">
                    <a href="<?= $arResult['sUrlPath']; ?>?<?= $strNavQueryString; ?>PAGEN_<?= $arResult['NavNum']; ?>=<?= ($arResult['NavPageNomer'] + 1); ?>"
                       class="page-link"
                       aria-label="<?= Loc::getMessage('MAIN_PAGINATION_PREV_BTN_ARIA_LABEL'); ?>">
                        <span aria-hidden="true"><?= Loc::getMessage('MAIN_PAGINATION_PREV_BTN_TEXT'); ?></span>
                    </a>
                </li>
            <?php
            elseif ($arResult['NavPageCount'] === ($arResult['NavPageNomer'] + 1)):
                    ?>
                    <li class="page-item">
                        <a href="<?= $arResult['sUrlPath']; ?><?= $strNavQueryStringFull; ?>"
                           class="page-link"
                           aria-label="<?= Loc::getMessage('MAIN_PAGINATION_PREV_BTN_ARIA_LABEL'); ?>">
                            <span aria-hidden="true"><?= Loc::getMessage('MAIN_PAGINATION_PREV_BTN_TEXT'); ?></span>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="page-item">
                        <a href="<?= $arResult['sUrlPath']; ?>?<?= $strNavQueryString; ?>PAGEN_<?= $arResult['NavNum']; ?>=<?= ($arResult['NavPageNomer'] + 1); ?>"
                           class="page-link"
                           aria-label="<?= Loc::getMessage('MAIN_PAGINATION_PREV_BTN_ARIA_LABEL'); ?>">
                            <span aria-hidden="true"><?= Loc::getMessage('MAIN_PAGINATION_PREV_BTN_TEXT'); ?></span>
                        </a>
                    </li>
                <?php
            endif;

            if ($arResult['nStartPage'] < $arResult['NavPageCount']):
                $bFirst = false;
                if ($arResult['bSavePage']): ?>
                    <li class="page-item">
                        <a href="<?= $arResult['sUrlPath']; ?>?<?= $strNavQueryString; ?>PAGEN_<?= $arResult['NavNum']; ?>=<?= $arResult['NavPageCount']; ?>"
                           class="page-link">1</a>
                    </li>
                <?php else: ?>
                    <li class="page-item">
                        <a href="<?= $arResult['sUrlPath']; ?><?= $strNavQueryStringFull; ?>"
                           class="page-link">1</a>
                    </li>
                <?php
                endif;
                if ($arResult['nStartPage'] < ($arResult['NavPageCount'] - 1)): ?>
                    <li class="page-item">
                        <a href="<?= $arResult['sUrlPath']; ?>?<?= $strNavQueryString; ?>PAGEN_<?= $arResult['NavNum']; ?>=<?= intval($arResult['nStartPage'] + ($arResult['NavPageCount'] - $arResult['nStartPage']) / 2); ?>"
                           class="page-link">...</a>
                    </li>
                <?php
                endif;
            endif;
        endif;
        do {
            $NavRecordGroupPrint = $arResult['NavPageCount'] - $arResult['nStartPage'] + 1;

            if ($arResult['nStartPage'] == $arResult['NavPageNomer']): ?>
                <li class="page-item active" aria-current="page">
                    <span class="page-link"><?= $NavRecordGroupPrint; ?></span>
                </li>
            <?php
            elseif ($arResult['nStartPage'] == $arResult['NavPageCount'] && $arResult['bSavePage'] == false): ?>
                <li class="page-item">
                    <a href="<?= $arResult['sUrlPath']; ?><?= $strNavQueryStringFull; ?>"
                       class="page-link"><?= $NavRecordGroupPrint; ?></a>
                </li>
            <?php else: ?>
                <li class="page-item">
                    <a href="<?= $arResult['sUrlPath']; ?>?<?= $strNavQueryString; ?>PAGEN_<?= $arResult['NavNum']; ?>=<?= $arResult['nStartPage']; ?>"
                       class="page-link"><?= $NavRecordGroupPrint; ?></a>
                </li>
            <?php
            endif;

            $arResult['nStartPage']--;
            $bFirst = false;
        } while ($arResult['nStartPage'] >= $arResult['nEndPage']);

        if ($arResult['NavPageNomer'] > 1):
            if ($arResult['nEndPage'] > 1):
                if ($arResult['nEndPage'] > 2):
                    ?>
                    <li class="page-item">
                        <a href="<?= $arResult['sUrlPath']; ?>?<?= $strNavQueryString; ?>PAGEN_<?= $arResult['NavNum']; ?>=<?= round($arResult['nEndPage'] / 2); ?>"
                           class="page-link">...</a>
                    </li>
                <?php
                endif;
                ?>
                <li class="page-item">
                    <a href="<?= $arResult['sUrlPath']; ?>?<?= $strNavQueryString; ?>PAGEN_<?= $arResult['NavNum']; ?>=1"
                       class="page-link"><?= $arResult['NavPageCount']; ?></a>
                </li>
            <?php
            endif;
            ?>
            <li class="page-item">
                <a href="<?= $arResult['sUrlPath']; ?>?<?= $strNavQueryString; ?>PAGEN_<?= $arResult['NavNum']; ?>=<?= ($arResult['NavPageNomer']-1); ?>"
                   class="page-link"
                   aria-label="<?= Loc::getMessage('MAIN_PAGINATION_NEXT_BTN_ARIA_LABEL'); ?>">
                    <span aria-hidden="true"><?= Loc::getMessage('MAIN_PAGINATION_NEXT_BTN_TEXT'); ?></span>
                </a>
            </li>
        <?php
        endif;

    else:

        if ($arResult['NavPageNomer'] > 1):
            if ($arResult['bSavePage']):
                ?>
                <li class="page-item">
                    <a href="<?= $arResult['sUrlPath']; ?>?<?= $strNavQueryString; ?>PAGEN_<?= $arResult['NavNum']; ?>=<?= ($arResult['NavPageNomer']-1); ?>"
                       class="page-link"
                       aria-label="<?= Loc::getMessage('MAIN_PAGINATION_PREV_BTN_ARIA_LABEL'); ?>">
                        <span aria-hidden="true"><?= Loc::getMessage('MAIN_PAGINATION_PREV_BTN_TEXT'); ?></span>
                    </a>
                </li>
            <?php
            elseif ($arResult['NavPageNomer'] > 2):
                    ?>
                    <li class="page-item">
                        <a href="<?= $arResult['sUrlPath']; ?>?<?= $strNavQueryString; ?>PAGEN_<?= $arResult['NavNum']; ?>=<?= ($arResult['NavPageNomer']-1); ?>"
                           class="page-link"
                           aria-label="<?= Loc::getMessage('MAIN_PAGINATION_PREV_BTN_ARIA_LABEL'); ?>">
                            <span aria-hidden="true"><?= Loc::getMessage('MAIN_PAGINATION_PREV_BTN_TEXT'); ?></span>
                        </a>
                    </li>
                <?php
                else:
                    ?>
                    <li class="page-item">
                        <a href="<?= $arResult['sUrlPath']; ?><?= $strNavQueryStringFull; ?>"
                           class="page-link"
                           aria-label="<?= Loc::getMessage('MAIN_PAGINATION_PREV_BTN_ARIA_LABEL'); ?>">
                            <span aria-hidden="true"><?= Loc::getMessage('MAIN_PAGINATION_PREV_BTN_TEXT'); ?></span>
                        </a>
                    </li>
                <?php
            endif;

            if ($arResult['nStartPage'] > 1):
                $bFirst = false;
                if ($arResult['bSavePage']):
                    ?>
                    <li class="page-item">
                        <a href="<?= $arResult['sUrlPath']; ?>?<?= $strNavQueryString; ?>PAGEN_<?= $arResult['NavNum']; ?>=1"
                           class="page-link">1</a>
                    </li>
                <?php
                else:
                    ?>
                    <li class="page-item">
                        <a href="<?= $arResult['sUrlPath']; ?><?= $strNavQueryStringFull; ?>"
                           class="page-link">1</a>
                    </li>
                <?php
                endif;
                if ($arResult['nStartPage'] > 2):
                    ?>
                    <li class="page-item">
                        <a href="<?= $arResult['sUrlPath']; ?>?<?= $strNavQueryString; ?>PAGEN_<?= $arResult['NavNum']; ?>=<?= round($arResult['nStartPage'] / 2); ?>"
                           class="page-link">...</a>
                    </li>
                <?php
                endif;
            endif;
        endif;

        do
        {
            if ($arResult['nStartPage'] == $arResult['NavPageNomer']):
                ?>
                <li class="page-item active" aria-current="page">
                    <span class="page-link"><?= $arResult['nStartPage']; ?></span>
                </li>
            <?php
            elseif ($arResult['nStartPage'] == 1 && $arResult['bSavePage'] == false):
                ?>
                <li class="page-item">
                    <a href="<?= $arResult['sUrlPath']; ?><?= $strNavQueryStringFull; ?>"
                       class="page-link"><?= $arResult['nStartPage']; ?></a>
                </li>
            <?php
            else:
                ?>
                <li class="page-item">
                    <a href="<?= $arResult['sUrlPath']; ?>?<?= $strNavQueryString; ?>PAGEN_<?= $arResult['NavNum']; ?>=<?= $arResult['nStartPage']; ?>"
                       class="page-link"><?= $arResult['nStartPage']; ?></a>
                </li>
            <?php
            endif;
            $arResult['nStartPage']++;
            $bFirst = false;
        } while($arResult['nStartPage'] <= $arResult['nEndPage']);

        if ($arResult['NavPageNomer'] < $arResult['NavPageCount']):
            if ($arResult['nEndPage'] < $arResult['NavPageCount']):
                if ($arResult['nEndPage'] < ($arResult['NavPageCount'] - 1)):
                    ?>
                    <li class="page-item">
                        <a href="<?= $arResult['sUrlPath']; ?>?<?= $strNavQueryString; ?>PAGEN_<?= $arResult['NavNum']; ?>=<?= round($arResult['nEndPage'] + ($arResult['NavPageCount'] - $arResult['nEndPage']) / 2); ?>"
                           class="page-link">...</a>
                    </li>
                <?php
                endif;
                ?>
                <li class="page-item">
                    <a href="<?= $arResult['sUrlPath']; ?>?<?= $strNavQueryString; ?>PAGEN_<?= $arResult['NavNum']; ?>=<?= $arResult['NavPageCount']; ?>"
                       class="page-link"><?= $arResult['NavPageCount']; ?></a>
                </li>
            <?php
            endif;
            ?>
            <li class="page-item">
                <a href="<?= $arResult['sUrlPath']; ?>?<?= $strNavQueryString; ?>PAGEN_<?= $arResult['NavNum']; ?>=<?= ($arResult['NavPageNomer']+1); ?>"
                   class="page-link"
                   aria-label="<?= Loc::getMessage('MAIN_PAGINATION_NEXT_BTN_ARIA_LABEL'); ?>">
                    <span aria-hidden="true"><?= Loc::getMessage('MAIN_PAGINATION_NEXT_BTN_TEXT'); ?></span>
                </a>
            </li>
        <?php
        endif;
    endif;

    if ($arResult['bShowAll']):
        if ($arResult['NavShowAll']):
            ?>
            <li class="page-item">
                <a href="<?= $arResult['sUrlPath']; ?>?<?= $strNavQueryString; ?>SHOWALL_<?= $arResult['NavNum']; ?>=0"
                   class="page-link"><?= Loc::getMessage('MAIN_PAGINATION_SHOW_PAGED_BTN_TEXT'); ?></a>
            </li>
        <?php
        else:
            ?>
            <li class="page-item">
                <a href="<?= $arResult['sUrlPath']; ?>?<?= $strNavQueryString; ?>SHOWALL_<?= $arResult['NavNum']; ?>=1"
                   class="page-link"><?= Loc::getMessage('MAIN_PAGINATION_SHOW_ALL_BTN_TEXT'); ?></a>
            </li>
        <?php
        endif;
    endif; ?>
</ul>
