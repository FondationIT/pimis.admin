document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 350,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: ''
        },
        events: [
            // Fetch Data from DB
            { title: 'Fondation Day', start: '2026-01-10' },
            { title: 'Another one', start: '2026-01-17' }
        ]
    });

    calendar.render();
});