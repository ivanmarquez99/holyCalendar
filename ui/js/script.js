var rol =  document.querySelector('header').getAttribute('data-json');

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
    //Traemos la información de la descripción
    var description = document.getElementById(id).getAttribute('data-description');

    // La insertamos en eventDescription
    document.querySelector("#eventDescription").innerHTML = description;

    // Mostramos el modal
    let myModal = new bootstrap.Modal('#modalDescription', {
        keyboard: false
    });
    myModal.show();
}


function loadParticipants(eventId) {

    // Petición ajax
    $.ajax({
        url: 'admin/asistentes',
        type: 'POST',
        data: { eventId: eventId },
        success: function (response) {
            var participantes = JSON.parse(response);
            // Actualiza el contenido del modal con los participantes

            var table = $('.participantsTable');
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

                // Añadimos a los inputs la información de participante y evento
                newCell.find('input:eq(1)').val(participante.id);
                newCell.find('input:eq(2)').val(eventId);

                //Comprobamos si el usuario asistió y marcamos los botones
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
function participantsModal(eventId) {
    // Obtiene el ID del evento desde el botón
    var eventoId = eventId.replace('participantsModal', '');

    // Carga los participantes del evento
    loadParticipants(eventoId);

    // Abre el modal
    $('#participantsModal').modal('show');
}