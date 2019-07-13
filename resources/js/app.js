/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(function() {
    // DataTables
    if ($('#datatable').length) {
        $("#datatable").DataTable({
            searching: true,
            "lengthChange": false,
            "order": [], // disable ordering on init
            "ordering": true,
            columnDefs: [{
                orderable: false,
                targets: "no-sort"
            }]
        });
    }
});
