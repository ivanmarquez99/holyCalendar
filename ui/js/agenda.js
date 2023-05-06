document.addEventListener('DOMContentLoaded', function () {

     var events = document.getElementById('prodId').value;
     var arrEvents = JSON.parse(events)
     console.log(arrEvents)

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
        eventClick: function(info) {
            document.getElementById('eventTitle').innerHTML = info.event.title;
            document.getElementById('eventDate').innerHTML = moment(info.event.start).format('DD/MM/YYYY');
            document.getElementById('eventStart').innerHTML = moment(info.event.start).format('HH:mm');
            document.getElementById('eventEnd').innerHTML = moment(info.event.end).format('HH:mm');
            document.getElementById('eventDescription').innerHTML = info.event.extendedProps.description;
            document.getElementById('deleteEvent').setAttribute('formaction', 'agenda/eliminar/' + info.event.id);
            document.getElementById('editEvent').setAttribute('formaction', 'agenda/editar/' + info.event.id);
            document.getElementById('id-event').value = info.event.id;

            let myModal = new bootstrap.Modal('#eventModal', {
                keyboard: false
              });
              myModal.show();
        },
        navLinks: true,
        navLinkDayClick: function(date, jsEvent) {
            calendar.changeView('timeGridDay', date);
        },
        eventTimeFormat: { // like '14:30'
            hour: '2-digit',
            minute: '2-digit',
            meridiem: false
        }
    });
    calendar.render();
    
});