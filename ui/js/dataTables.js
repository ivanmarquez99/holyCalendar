var minDate, maxDate;

// Iniciamos el buscados de DataTables
$.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date(data[3]);

        if (
            (min === null && max === null) ||
            (min === null && date <= max) ||
            (min <= date && max === null) ||
            (min <= date && date <= max)
        ) {
            return true;
        }
        return false;
    }
);

// Cuando la página esté cargada crea los inputs y inicializa la tabla
$(document).ready(function () {

    // Creamos los inputs de fecha
    minDate = new DateTime($('#min'), {
        format: 'YYYY-MM-DD'
    });
    maxDate = new DateTime($('#max'), {
        format: 'YYYY-MM-DD',
    });

    // Inicializamos los dataTables
    var table = $('#myTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        scrollY: '30vh',
        scrollCollapse: true
    });

    // Filtramos la tabla
    $('#min, #max').on('change', function () {
        table.draw();
    });
});