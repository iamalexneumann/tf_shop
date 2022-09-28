<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/**
 * @var CMain $APPLICATION
 * @var CMain $CurDir
 * @var CSite $arSite
 * @var COption $siteparam_footer_logo
 * @var COption $siteparam_logo_name
 * @var COption $siteparam_logo_description
 * @var COption $siteparam_main_phone
 * @var COption $siteparam_main_phone_tel
 * @var COption $siteparam_schedule
 * @var COption $siteparam_email
 * @var COption $siteparam_address
 * @var COption $siteparam_telegram_link
 * @var COption $siteparam_scripts_body_after
 */
use Bitrix\Main\Localization\Loc;
?>
        </div>
    </main>
    <footer class="main-footer">
        <div class="main-footer__content">
            <div class="container">

            </div>
        </div>
        <div class="main-footer__copyright">
            <div class="container">

            </div>
        </div>
    </footer>
    <?= $siteparam_scripts_body_after; ?>
    </body>
</html>