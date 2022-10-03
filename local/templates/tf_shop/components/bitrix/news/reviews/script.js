document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('.seo-text')) {
        new ShowMore('.seo-text_top', {
            config: {
                type: 'text',
                limit: 256,
                element: 'div',
                more: BX.message('DEFAULT_SEO_TEXT_MORE_BTN_TEXT'),
                less: BX.message('DEFAULT_SEO_TEXT_LESS_BTN_TEXT'),
                btnClass: 'btn',
                btnClassAppend: 'link-primary',
            }
        });

        new ShowMore('.seo-text_bottom', {
            config: {
                type: 'text',
                limit: 1024,
                element: 'div',
                more: BX.message('DEFAULT_SEO_TEXT_MORE_BTN_TEXT'),
                less: BX.message('DEFAULT_SEO_TEXT_LESS_BTN_TEXT'),
                btnClass: 'btn',
                btnClassAppend: 'link-primary',
            }
        });
    }
});