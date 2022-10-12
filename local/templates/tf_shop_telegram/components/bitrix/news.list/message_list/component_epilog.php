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
 * @var string $templateName
 * @var string $templateFile
 * @var string $templateFolder
 * @var string $componentPath
 * @var string $epilogFile
 * @var array $templateData
 * @var CBitrixComponent $component
 */
?>

<?php if (count($arResult['ELEMENTS']) > 0): ?>
<script data-skip-moving="true">
    if (sessionStorage.getItem('hideMainMessagesList') === 'true') {
        document.querySelector('#main-messages-list').classList.add('d-none');
    }

    document.querySelector('#main-messages-list .btn-close').addEventListener('click', function() {
        sessionStorage.setItem('hideMainMessagesList', 'true');
    });
</script>
<?php endif; ?>