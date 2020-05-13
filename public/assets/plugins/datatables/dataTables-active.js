$(document).ready(function () {
    "use strict"; // Start of use strict

    $('#dataTableExample1, #dataTableExample2').DataTable({
        dom: "<'row dataTableInner'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
        "lengthMenu": [[50,100,150,200, -1], [50,100,150,200, "All"]],
        buttons: [
            {extend: 'copy', className: 'btn-sm'},
            {extend: 'csv', title: 'PharmacyDataFile', className: 'btn-sm'},
            {extend: 'excel', title: 'PharmacyDataFile', className: 'btn-sm'},
            {extend: 'pdf', title: 'PharmacyDataFile', className: 'btn-sm'},
            {extend: 'print', className: 'btn-sm'}
        ]
    });

});