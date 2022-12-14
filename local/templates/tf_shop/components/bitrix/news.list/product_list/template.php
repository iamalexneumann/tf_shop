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

$param_small_card_tag_title = $arParams['SMALL_CARD_TAG_TITLE'] ?? '2';
?>
<?php if (count($arResult['ITEMS']) > 0): ?>
<div class="product-list row">
    <?php
    foreach ($arResult['ITEMS'] as $arItem_key => $arItem):
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'),
            [
                'CONFIRM' => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'),
            ]
        );
    ?>
    <div class="col-xl-4 col-lg-6 product-list__col">
        <article class="product-item<?= $arItem['DISPLAY_PROPERTIES']['ATT_LABEL']['VALUE_XML_ID'] ? ' product-item_' . $arItem['DISPLAY_PROPERTIES']['ATT_LABEL']['VALUE_XML_ID']: ''; ?>" id="<?= $this->GetEditAreaId($arItem['ID']) ;?>">
            <a href="<?= $arItem['DETAIL_PAGE_URL']; ?>" class="product-item__img-link" rel="nofollow">
                <img src="<?= $arItem['PICTURE_LQIP']['SRC']; ?>"
                     data-src="<?= $arItem['PICTURE']['SRC']; ?>"
                     class="product-item__img lazyload blur-up"
                     alt="<?= $arItem['NAME']; ?>"
                     width="<?= $arItem['PICTURE']['WIDTH']; ?>"
                     height="<?= $arItem['PICTURE']['HEIGHT']; ?>">
            </a>
            <div class="product-item__wrapper">
                <h<?=$param_small_card_tag_title; ?> class="product-item__title">
                    <a href="<?= $arItem['DETAIL_PAGE_URL']; ?>" class="product-item__link"><?= $arItem['NAME']; ?></a>
                </h<?=$param_small_card_tag_title; ?>>
                <?php if ($arItem['PREVIEW_TEXT']): ?>
                <div class="product-item__preview-text">
                    <?= $arItem['PREVIEW_TEXT']; ?>
                </div>
                <?php endif; ?>
                <table class="table product-item__characteristics">
                    <tbody>
                        <?php
                        foreach ($arItem['DISPLAY_PROPERTIES'] as $property_key => $property):
                            if ($property_key !== 'ATT_PRICE' && $property_key !== 'ATT_PRICE_OLD' && $property_key !== 'ATT_LABEL'):
                        ?>
                        <tr>
                            <th scope="row"><?= $property['NAME']; ?></th>
                            <td><?= $property['VALUE']; ?></td>
                        </tr>
                        <?php
                            endif;
                        endforeach; ?>
                    </tbody>
                </table>
                <div class="product-item__bottom-wrapper">
                    <div class="product-item__prices">
                        <div class="product-item__price"><?= number_format($arItem['DISPLAY_PROPERTIES']['ATT_PRICE']['VALUE'], 0, '', ' ') . ' ' . Loc::getMessage('PRODUCTS_LIST_PRICE_CURRENCY'); ?></div>
                        <?php if ($arItem['DISPLAY_PROPERTIES']['ATT_PRICE_OLD']['VALUE']): ?>
                        <div class="product-item__old-price"><?= number_format($arItem['DISPLAY_PROPERTIES']['ATT_PRICE_OLD']['VALUE'], 0, '', ' ') . ' ' . Loc::getMessage('PRODUCTS_LIST_PRICE_CURRENCY'); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="product-item__btns">
                        <a href="<?= $arItem['DETAIL_PAGE_URL']; ?>" class="btn btn-outline-danger product-item__btn product-item__btn_action-more" rel="nofollow">
                            <?= Loc::getMessage('PRODUCTS_LIST_MORE_BTN_TEXT'); ?>
                        </a>
                        <a href="<?= $arItem['DETAIL_PAGE_URL']; ?>" class="btn btn-danger product-item__btn product-item__btn_action-add" rel="nofollow">
                            <?= Loc::getMessage('PRODUCTS_LIST_CART_BTN_TEXT'); ?>
                            <i class="fa-solid fa-cart-shopping product-item__btn-icon"></i>
                        </a>
                    </div>
                </div>
            </div>
        </article>
    </div>
    <?php endforeach; ?>
</div>
<?php
if ($arParams['DISPLAY_BOTTOM_PAGER']) {
    echo $arResult['NAV_STRING'];
} ?>
<?php endif; ?>