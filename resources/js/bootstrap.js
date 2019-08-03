window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
    require('datatables');
    require('@chenfengyuan/datepicker');
    require('@chenfengyuan/datepicker/i18n/datepicker.ru-RU');
    //require('@fortawesome/fontawesome-free/js/fontawesome');
} catch (e) {}
