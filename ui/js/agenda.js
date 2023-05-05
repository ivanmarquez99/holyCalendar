document.addEventListener('DOMContentLoaded', function () {

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: "95vh",
        locale: 'es',
        firstDay: 1,
        selectable: true,
        events: events,
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

            let myModal = new bootstrap.Modal('#eventModal', {
                keyboard: false
              });
              myModal.show();
        },
        eventTimeFormat: { // like '14:30'
            hour: '2-digit',
            minute: '2-digit',
            meridiem: false
          }
    });
    calendar.render();
});