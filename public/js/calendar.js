const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
const DAYS = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

function app() {
   return {
      month: '',
      year: '',
      no_of_days: [],
      blankdays: [],
      days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
      events: [],
      event_title: '',
      event_date: '',
      event_theme: 'blue',
      themes: [{
         value: "blue",
         label: "Blue Theme"
      },
      {
         value: "red",
         label: "Red Theme"
      },
      {
         value: "yellow",
         label: "Yellow Theme"
      },
      {
         value: "green",
         label: "Green Theme"
      },
      {
         value: "purple",
         label: "Purple Theme"
      }
      ],

      openEventModal: false,

      initDate() {
         let today = new Date();
         this.month = today.getMonth();
         this.year = today.getFullYear();
         this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
      },

      isToday(date) {
         const today = new Date();
         const d = new Date(this.year, this.month, date);
         return today.toDateString() === d.toDateString() ? true : false;
      },

      showEventModal(date) {
         // open the modal
         this.openEventModal = true;
         this.event_date = new Date(this.year, this.month, date).toDateString();
      },

      addEvent() {
         event.preventDefault();
         if (this.event_title == '') {
            alert("Event Title cannot be empty.");
            return;
         }
         this.events.push({
            event_date: this.event_date,
            event_title: this.event_title,
            event_theme: this.event_theme
         });
         console.log(this.events);
         // clear the form data
         this.event_title = '';
         this.event_date = '';
         this.event_theme = 'blue';
         //close the modal
         this.openEventModal = false;

         saveEventToDatabase(
            this.events[0]
         );
      },

      getNoOfDays() {
         let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
         // find where to start calendar day of week
         let dayOfWeek = new Date(this.year, this.month).getDay();
         let blankdaysArray = [];
         for (var i = 1; i <= dayOfWeek; i++) {
            blankdaysArray.push(i);
         }
         let daysArray = [];
         for (var i = 1; i <= daysInMonth; i++) {
            daysArray.push(i);
         }
         this.blankdays = blankdaysArray;
         this.no_of_days = daysArray;
      },
   }

   function saveEventToDatabase(event_data) 
   {
      fetch('mood/ajax/calendar/', 
      {
         method: 'POST',
         headers: 
         {
            'Content-Type': 'application/json',
         },
         body: JSON.stringify(event_data),
      })
         .then(response => 
         {
            if (!response.ok) 
            {
               throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
         })
         .then(data => 
         {
            // Handle the response from the server
            alert('Success');
            $("input[name='input-text']").val(data.csrf);
         })
         .catch(error => 
         {
            console.error('Error:', error);
            alert('Error');
         });


      // $.ajax({
      //    url: 'http://dev.blog-space.local/mood/ajax/calendar/',
      //    type: 'post',
      //    cache: false,
      //    dataType: 'json',
      //    data: {
      //       'event_date': eventData.event_date,
      //       'event_title': eventData.event_title,
      //       'event_theme': eventData.event_theme,
      //    },
      //    success: function (data) {
      //       var result = JSON.parse(data);
      //       alert('Success');
      //       $("input[name='input-text']").val(result['csrf']);
      //    },
      //    error: function () {
      //       alert('Error');
      //    }
      // });


      // Replace this with your actual API endpoint and AJAX code to save data to the server
      //    $.ajax('/mood/ajax/calendar/', {
      //       method: 'POST',
      //       headers: {
      //          'Content-Type': 'application/json'
      //       },
      //       body: JSON.stringify(eventData)
      //    }).then(response => {
      //       if (response.ok) {
      //          console.log('Event saved successfully to the database.');
      //       } else {
      //          console.error('Failed to save event to the database.');
      //       }
      //    }).catch(error => {
      //       console.error('Error occurred while saving event to the database:', error);
      //    });
   }
}