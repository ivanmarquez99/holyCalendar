window.addEventListener("load", function () {

    tinymce.init({
        language: 'es',
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
        toolbar: 'undo redo | blocks fontsize | bold italic underline strikethrough | link image media table | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name'
    });
})

var minDate, maxDate;

$.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date(data[4]);

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

$(document).ready(function () {

    // Create date inputs
    minDate = new DateTime($('#min'), {
        format: 'YYYY-MM-DD'
    });
    maxDate = new DateTime($('#max'), {
        format: 'YYYY-MM-DD',
    });

    // DataTables initialisation
    var table = $('#myTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        scrollY: '30vh',
        scrollCollapse: true
    });

    // Refilter the table
    $('#min, #max').on('change', function () {
        table.draw();
    });
});

function verificarPasswords() {


    // Ontenemos los valores de los campos de contraseñas 
    pass1 = document.getElementById('pass1');
    pass2 = document.getElementById('pass2');

    // Verificamos si las constraseñas no coinciden 
    if (pass1.value != pass2.value) {

        // Si las constraseñas no coinciden mostramos un mensaje 
        document.getElementById("error").classList.add("mostrar");

        return false;
    } else {

        // Si las contraseñas coinciden ocultamos el mensaje de error
        document.getElementById("error").classList.remove("mostrar");

        // Mostramos un mensaje mencionando que las Contraseñas coinciden 
        document.getElementById("ok").classList.remove("ocultar");

        // Desabilitamos el botón de login 
        document.getElementById("login").disabled = true;

        // Refrescamos la página (Simulación de envío del formulario) 
        setTimeout(function () {
            location.reload();
        }, 3000);

        return true;
    }

}


function descriptionModal(id) {

    var description = document.querySelector("#" + id).getAttribute('data-description');
    document.querySelector("#eventDescription").innerHTML = description;

    let myModal = new bootstrap.Modal('#modalDescription', {
        keyboard: false
    });
    myModal.show();
}


function loadParticipants(eventId) {
    $.ajax({
        url: 'admin/asistentes',
        type: 'POST',
        data: { eventId: eventId },
        success: function (response) {
            var participantes = JSON.parse(response);
            // Actualiza el contenido del modal con los participantes

            var table = $('#participants');
            var template = $('template').html();

            // Limpia el contenido existente de la tabla
            table.find('tbody').empty();

            // Itera sobre los participantes y crea una fila por cada uno
            for (var i = 0; i < participantes.length; i++) {
                var participante = participantes[i];

                // Crea una nueva fila y añade las celdas correspondientes
                var tr = $('<tr>').appendTo(table);
                $('<td>').text(participante.nombre_usuario).appendTo(tr);
                $('<td>').text(participante.email).appendTo(tr);
                $('<td>').text(participante.rol).appendTo(tr);
                var newCell = $('<td>').html(template);
                tr.append(newCell);
                newCell.find('input:eq(1)').val(participante.id);
                newCell.find('input:eq(2)').val(eventId);

                if (participante.asistencia=="0") {
                    newCell.find('input:first').val("true");
                    newCell.find('#no-asistio').attr("disabled", true);
                } else {
                    newCell.find('input:first').val("false");
                    newCell.find('#si-asistio').attr("disabled", true);
                }
            }
        },
        error: function () {
            // Maneja los errores en caso de que la solicitud falle
            console.log('Error al cargar los participantes');
        }
    });
}

// Función para abrir el modal y cargar los participantes al hacer clic en un evento
function descriptionModal(eventId) {
    // Obtiene el ID del evento desde el botón
    var eventId = eventId.replace('descriptionModal', '');

    // Carga los participantes del evento
    loadParticipants(eventId);

    // Abre el modal
    $('#participantsModal').modal('show');
}