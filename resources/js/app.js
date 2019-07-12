/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

const jQuery = require('./vendor/jquery.min.js');
window.$ = window.jQuery = jQuery;

require('./vendor/bootstrap.bundle.min.js');
//require('./vendor/moment.min.js');
require('./vendor/chart.min.js');
require('./vendor/dragula.min.js');
require('./vendor/select2.full.min.js');
window.Dropzone = require('./vendor/dropzone.min.js');
require('./vendor/jquery.dataTables.js');
//require('./vendor/fullcalendar.js');
require('./vendor/datepicker.min.js');
require('./vendor/jquery.vmap.min.js');
require('./vendor/jquery.vmap.world.js');
require('./vendor/jquery.matchHeight-min.js');

//require('./fullcalendar-custom.js');
require('./chart-custom.js');
require('./sidebar.js');
require('./switch.js');
require('./toggle.js');
require('./todo.js');
require('./chat-dialogue.js');
require('./main.js');
