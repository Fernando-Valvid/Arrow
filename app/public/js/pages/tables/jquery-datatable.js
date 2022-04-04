$(function () {
    $('.js-basic-example').DataTable({
        "language":{
            "url":"//cdn.datatables.net/plug-ins/1.10.22/i18n/Spanish.json"
        },
    });

    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});