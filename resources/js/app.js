/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(function() {
    // DataTables
    if ($('#datatable').length) {
        function filterGlobal () {
            $('#datatable').DataTable().search(
                $('#search').val(),
                true
            ).draw();
        }
        $('#search').on( 'keyup click', function () {
            filterGlobal();
        } );

        $("#datatable").DataTable({
            "searching": true,
            "lengthChange": false,
            "order": [], // disable ordering on init
            "ordering": true,
            columnDefs: [{
                orderable: false,
                targets: "no-sort"
            }],
            language: {
                "processing": "Подождите...",
                "search": "Поиск:",
                "lengthMenu": "Показать _MENU_ записей",
                "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
                "infoEmpty": "Записи с 0 до 0 из 0 записей",
                "infoFiltered": "(отфильтровано из _MAX_ записей)",
                "infoPostFix": "",
                "loadingRecords": "Загрузка записей...",
                "zeroRecords": "Записи отсутствуют.",
                "emptyTable": "В таблице отсутствуют данные",
                "paginate": {
                    "first": "Первая",
                    "previous": "Предыдущая",
                    "next": "Следующая",
                    "last": "Последняя"
                },
                "aria": {
                    "sortAscending": ": активировать для сортировки столбца по возрастанию",
                    "sortDescending": ": активировать для сортировки столбца по убыванию"
                }
            }
        });
    }

    // Datepicker
    if($('[data-toggle="datepicker"]').length) {
        $('[data-toggle="datepicker"]').datepicker({
            language: 'ru-RU',
            format: 'dd.mm.yyyy',
            autoHide: true
        });
    }

    if($('[data-toggle="modal"]').length) {
        $('[data-toggle="modal"]').each(function (i, e) {
            if ($(e).attr('data-source')) {
                $(e).on('click', function(e) {
                    $( $(this).attr('data-target') ).find('.c-modal__content').load( $(this).attr('data-source') );
                });
            }
        });
    }
});
