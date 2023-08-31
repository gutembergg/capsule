import './bootstrap';
import Alpine from 'alpinejs';

import { Calendar } from '@fullcalendar/core';
import timeGridPlugin from '@fullcalendar/timegrid';


window.Alpine = Alpine;

Alpine.start();


document.addEventListener('DOMContentLoaded', async function() {
    const calendarEl = document.querySelector('#calendar');

    const eventsFake = [
        {
            id: 1,
            title: 'Event one',
            color: 'DarkSlateBlue',
            start: '2023-08-22 09:00:00',
            end: '2023-08-22 10:00:00',
            borderColor: "green"
        },
        {
            id: 2,
            title: 'Event two',
            color: 'Teal',
            start: '2023-08-22 10:00:00',
            end: '2023-08-22 11:00:00',
            borderColor: "green"
        }, {
            id: 3,
            title: 'Event three',
            color: 'LightCoral',
            start: '2023-08-22 14:00:00',
            end: '2023-08-22 16:00:00',
            borderColor: "green"
        }
    ];

    if (calendarEl == null) return;

    const { data } = await axios.get('/api/events');

    const calendar = new Calendar(calendarEl, {
        plugins: [ timeGridPlugin ],
        initialView: 'timeGridWeek',
        slotMinTime: "08:00:00",
        slotMaxTime: "20:00:00",
        eventClick: async function(info) {
            let { data } = await axios.put('/api/subscribe', {
                id: info.event.id,
            });

            info.el.style.borderColor = data.attached === true ? 'green' : 'yellow';
        },
        events: data.events,
    });

    calendar.setOption('locale', 'fr');
    calendar.render();
});