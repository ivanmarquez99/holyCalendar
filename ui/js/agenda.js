document.addEventListener('DOMContentLoaded', function () {

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: "95vh",
        locale: 'es',
        firstDay: 1,
        selectable: true,
        events: events,
        dateClick: function (info) {
            alert('Date: ' + info.dateStr);
        },
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridDay'
        },
        eventDidMount: function (info) {
            console.log(info.event.extendedProps);
            // {description: "Lecture", department: "BioChemistry"}
        },
        buttonText: {
            today: 'Hoy',
            dayGridMonth: 'Mes',
            timeGridDay: 'Día'
        },
        eventClick: function(info) {
            alert('Event: ' + info.event.title);
            alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
            alert('View: ' + info.view.type);
          }
    });
    calendar.render();
});
