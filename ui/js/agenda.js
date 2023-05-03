document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: "95vh",
        locale: 'es',
        firstDay: 1,
        selectable: true,
        events: [
            {
                title: 'BCH237',
                start: '2023-05-01T10:30:00',
                end: '2023-05-01T11:30:00',
                extendedProps: {
                    department: 'BioChemistry'
                },
                description: 'Lecture'
            }
        ],
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
    });
    calendar.render();
});