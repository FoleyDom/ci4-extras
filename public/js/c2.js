document.addEventListener("DOMContentLoaded", function() {
   const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
   const DAYS = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

   let month = '';
   let year = '';
   let no_of_days = [];
   let blankdays = [];
   let events = [];

   const app = document.getElementById('app');
   const currentMonthElement = document.getElementById('currentMonth');
   const calendarBody = document.getElementById('calendarBody');
   const eventModal = document.getElementById('eventModal');
   const eventTitleInput = document.getElementById('eventTitle');
   const eventDateInput = document.getElementById('eventDate');
   const eventThemeInput = document.getElementById('eventTheme');

   function initDate() {
      let today = new Date();
      month = today.getMonth();
      year = today.getFullYear();
      currentMonthElement.textContent = `${MONTH_NAMES[month]} ${year}`;
   }

   function isToday(date) {
      const today = new Date();
      const d = new Date(year, month, date);
      return today.toDateString() === d.toDateString();
   }

   function showEventModal(date) {
      eventDateInput.value = new Date(year, month, date).toISOString().slice(0, 10);
      eventModal.style.display = 'block';
   }

   function closeEventModal() {
      eventModal.style.display = 'none';
   }

   function addEvent(event) {
      event.preventDefault();
      const eventTitle = eventTitleInput.value;
      const eventDate = new Date(eventDateInput.value);
      const eventTheme = eventThemeInput.value;

      if (eventTitle === '') {
         alert("Event Title cannot be empty.");
         return;
      }

      const newEvent = {
         event_date: eventDate,
         event_title: eventTitle,
         event_theme: eventTheme
      };

      saveEventToDatabase(newEvent);
      events.push(newEvent);

      closeEventModal();
      renderCalendar();
   }

   function saveEventToDatabase(eventData) {
      // Replace this with your actual API endpoint and AJAX code to save data to the server
      fetch('your-api-endpoint-url', {
         method: 'POST',
         headers: {
            'Content-Type': 'application/json'
         },
         body: JSON.stringify(eventData)
      }).then(response => {
         if (response.ok) {
            console.log('Event saved successfully to the database.');
         } else {
            console.error('Failed to save event to the database.');
         }
      }).catch(error => {
         console.error('Error occurred while saving event to the database:', error);
      });
   }
   function getNoOfDays() {
      let daysInMonth = new Date(year, month + 1, 0).getDate();
      let dayOfWeek = new Date(year, month).getDay();
      let blankdaysArray = [];
      for (let i = 1; i <= dayOfWeek; i++) {
        blankdaysArray.push(i);
      }
      let daysArray = [];
      for (let i = 1; i <= daysInMonth; i++) {
        daysArray.push(i);
      }
      blankdays = blankdaysArray;
      no_of_days = daysArray;
    }
  
    function renderCalendar() {
      initDate();
      getNoOfDays();
  
      let daysInMonth = new Date(year, month + 1, 0).getDate();
      let dayOfWeek = new Date(year, month).getDay();
      let prevMonthDays = new Date(year, month, 0).getDate();
      let days = [...Array(daysInMonth + 1).keys()].slice(1);
      let prevMonthDaysArr = [...Array(dayOfWeek).keys()].map((i) => prevMonthDays - i);
      days = [...prevMonthDaysArr, ...days];
      let weeks = [];
      let week = [];
      days.forEach((day, index) => {
        if (index % 7 === 0 && index > 0) {
          weeks.push(week);
          week = [];
        }
        week.push(day);
        if (index === days.length - 1) {
          weeks.push(week);
        }
      });
  
      calendarBody.innerHTML = '';
      weeks.forEach((week) => {
        const row = document.createElement('tr');
        week.forEach((day) => {
          const cell = document.createElement('td');
          if (day) {
            const dayElement = document.createElement('span');
            dayElement.textContent = day;
            cell.appendChild(dayElement);
            if (isToday(day)) {
              cell.classList.add('today');
            }
            events.forEach((event) => {
              const eventDate = new Date(event.event_date);
              if (eventDate.getDate() === day && eventDate.getMonth() === month && eventDate.getFullYear() === year) {
                const eventDiv = document.createElement('div');
                eventDiv.textContent = event.event_title;
                eventDiv.style.backgroundColor = event.event_theme;
                eventDiv.classList.add('event');
                cell.appendChild(eventDiv);
              }
            });
            cell.addEventListener('click', () => showEventModal(day));
          }
          row.appendChild(cell);
        });
        calendarBody.appendChild(row);
      });
    }
  
    renderCalendar();
  });