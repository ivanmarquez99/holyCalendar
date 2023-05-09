document.addEventListener('DOMContentLoaded', function () {

     var events = document.getElementById('prodId').value;
     var participants = document.getElementById('signin').value;
     var arrParticipants = JSON.parse(participants);
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
        eventClick: function(info) {

            document.getElementById('eventTitle').innerHTML = info.event.title;
            document.getElementById('eventDate').innerHTML = moment(info.event.start).format('DD/MM/YYYY');
            document.getElementById('eventStart').innerHTML = moment(info.event.start).format('HH:mm');
            document.getElementById('eventEnd').innerHTML = moment(info.event.end).format('HH:mm');
            document.getElementById('eventDescription').innerHTML = info.event.extendedProps.description;
            document.getElementById('eventUbication').innerHTML = info.event.extendedProps.ubicacion;

            document.getElementById('deleteEvent').setAttribute('formaction', 'agenda/eliminar/' + info.event.id);
            document.getElementById('editEvent').setAttribute('formaction', 'agenda/editar/' + info.event.id);
            document.getElementById('id-event').value = info.event.id;
            
            var data = {
                method: "POST",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                  },                
                body: JSON.stringify( [{ event: info.event.id, user: "2"}] )
              }

            fetch("checkUsersinEvent?user=2&event="+info.event.id,)
            .then(res => res.json())
            .then(
                res => {
                    console.log(res);

                    document.querySelector("#apuntarse").disabled=res;

                    let myModal = new bootstrap.Modal('#eventModal', {
                        keyboard: false
                    });
                    myModal.show();
                }
            )
            .catch( err => console.error(err))
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