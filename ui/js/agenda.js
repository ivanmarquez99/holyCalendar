document.addEventListener('DOMContentLoaded', function () {

    var events = document.getElementById('prodId').value;
    var ListNextEvent = document.querySelector('.list-next-events')
    var arrEvents = JSON.parse(events);
    console.log(arrEvents);


    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: "95vh",
        locale: 'es',
        firstDay: 1,
        selectable: true,
        events: arrEvents,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek'
        },
        buttonText: {
            today: 'Hoy',
            dayGridMonth: 'Mes',
            dayGridWeek: 'Semana'
        },
        eventClick: function (info) {

            document.getElementById('eventTitle').innerHTML = info.event.title;
            document.getElementById('eventDate').innerHTML = moment(info.event.start).format('DD/MM/YYYY');
            document.getElementById('eventStart').innerHTML = moment(info.event.start).format('HH:mm');
            document.getElementById('eventEnd').innerHTML = moment(info.event.end).format('HH:mm');
            document.getElementById('eventDescription').innerHTML = info.event.extendedProps.description;
            document.getElementById('eventUbication').innerHTML = info.event.extendedProps.ubicacion;
            document.getElementById('id-event').value = info.event.id;
            var id_user = document.getElementById('id-user').value

            var data = {
                event: parseInt(info.event.id),
                user: parseInt(id_user)
            };

            fetch("agenda/comprobarasistencia", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
                .then(res => res.json())
                .then(
                    res => {
                        console.log(res);

                        document.querySelector("#apuntarse").disabled = res;

                        let myModal = new bootstrap.Modal('#eventModal', {
                            keyboard: false
                        });
                        myModal.show();
                    }
                )
                .catch(err => console.error(err))

            document.getElementById('deleteEvent').setAttribute('formaction', 'agenda/eliminar/' + info.event.id);
            document.getElementById('editEvent').setAttribute('formaction', 'agenda/editar/' + info.event.id);
        },
        navLinks: true,
        navLinkDayClick: function (date, jsEvent) {
            calendar.changeView('timeGridDay', date);
        },
        eventTimeFormat: { // like '14:30'
            hour: '2-digit',
            minute: '2-digit',
            meridiem: false
        }
    });
    calendar.render();

    var elementos = ListNextEvent.getElementsByTagName('li');

    var arregloElementos = Array.from(elementos);

    arregloElementos.forEach(element => {

        element.addEventListener('click', function () {
            var elementId = this.getAttribute('data-event');

            var encontrado = arrEvents.find(function (objeto) {
                return objeto.id == elementId;
            });

            console.log('Encontrado:', encontrado);

            document.getElementById('eventTitle').innerHTML = encontrado.title;
            document.getElementById('eventDate').innerHTML = moment(encontrado.start).format('DD/MM/YYYY');
            document.getElementById('eventStart').innerHTML = moment(encontrado.start).format('HH:mm');
            document.getElementById('eventEnd').innerHTML = moment(encontrado.end).format('HH:mm');
            document.getElementById('eventDescription').innerHTML = encontrado.description;
            document.getElementById('eventUbication').innerHTML = encontrado.ubicacion;
            document.getElementById('id-event').value = encontrado.id;

            document.getElementById('deleteEvent').setAttribute('formaction', 'agenda/eliminar/' + encontrado.id);
            document.getElementById('editEvent').setAttribute('formaction', 'agenda/editar/' + encontrado.id);

            let myModal = new bootstrap.Modal('#eventModal', {
                keyboard: false
            });
            myModal.show();
        })

    });

});

