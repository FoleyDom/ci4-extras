<!-- component -->
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<script defer src="https://unpkg.com/alpinejs@3.2.1/dist/cdn.min.js"></script>
<div class="w-full p-2 m-2 bg-gray-100 rounded-lg shadow">
   <div class="flex flex-wrap justify-center" x-data="genCalendar()" x-init="hozirgivaqt()" x-cloak>
      <div class="flex flex-wrap w-full h-12 p-1 m-1 text-xl font-bold bg-white rounded-lg shadow-lg">
         <p class="w-1/3 p-1 text-center text-green-900 shadow-md cursor-pointer hover:text-green-600 hover:shadow-inner bg-gray-50 rounded-l-md" @click="year-=1 "><svg xmlns="http://www.w3.org/2000/svg" class="block w-6 h-8 m-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
            </svg></p>
         <p class="w-1/3 p-1 text-center text-green-900 shadow-md cursor-pointer hover:text-green-600 hover:shadow-inner bg-gray-50" x-text="year"></p>
         <p class="w-1/3 p-1 text-center text-green-900 shadow-md cursor-pointer hover:text-green-600 hover:shadow-inner bg-gray-50 rounded-r-md" @click="year+=1 "><svg xmlns="http://www.w3.org/2000/svg" class="block w-6 h-8 m-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg></p>
      </div>
      <template x-for="(month,index) in month_names">
         <div class="p-1 m-1 font-sans bg-white rounded shadow-md lg:w-72 w-80 bg-blend-luminosity bg-gradient-to-b from-green-50 via-white to-green-50">
            <p class="p-1 text-xl font-semibold text-center text-indigo-800" x-text="month"></p>
            <div class="p-1 m-1">
               <div class="grid grid-cols-7 font-semibold text-green-800 border-b-2">
                  <template x-for="days in day_names">
                     <div class="grid place-items-center" :class="{'text-red-600': days == 'Ya'}">
                        <p x-text="days"></p>
                     </div>
                  </template>
               </div>
               <!-- calendar raqamlari bloki-->
               <div class="grid grid-cols-7 gap-1 font-semibold text-center text-gray-800 ">
                  <template x-for="kun in daysgenerater()[index]">
                     <div :class="{' ring-green-400 ring-4 rounded-full': isbugun(kun,index) == true, 'text-red-600': isyakshanba(kun,index) == true , ' hover:bg-green-100': isbugun(kun,index) == false }">
                        <p x-text="kun"></p>
                     </div>
                  </template>
               </div>
               <!-- calendar raqamlari bloki oxiri-->
            </div>
         </div>
      </template>
   </div>
</div>
<script>
   function genCalendar() {

      return {
         month_names: ['January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
         day_names: ['Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat'],
         year: '',
         days_of_month() {
            kabisa = (yearin) => {
               return (yearin % 4 === 0 && yearin % 100 !== 0 && yearin % 400 !== 0) || (yearin % 100 === 0 && yearin % 400 === 0)
            };
            fevral = (yearin) => {
               return kabisa(yearin) ? 29 : 28
            };
            return [31, fevral(this.year), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
         },
         hafta(sol, ma) {
            let haftakuni = new Date(sol, ma).getDay();
            switch (haftakuni) { // hafta kuni Dushanbadan boshlangani uchun hak)
               case 0:
                  haftakuni = 6;
                  break;
               case 1:
                  haftakuni = 0;
                  break;
               case 2:
                  haftakuni = 1;
                  break;
               case 3:
                  haftakuni = 2;
                  break;
               case 4:
                  haftakuni = 3;
                  break;
               case 5:
                  haftakuni = 4;
                  break;
               case 6:
                  haftakuni = 5;
                  break;
               default:
                  haftakuni = new Date(sol, ma).getDay()
                  break;
            }
            return haftakuni;
         },
         daysgenerater() {
            let days = [];
            for (let k = 0; k < this.days_of_month().length; k++) {
               days.push([]);
               for (let i = 1; i <= this.days_of_month()[k]; i++) {
                  if (days[k].length < this.hafta(this.year, k)) {
                     i -= i;
                     days[k].push('');
                     continue;
                  };
                  days[k].push(i);
               }
            }
            return days;
         },
         hozirgivaqt() {
            let today = new Date();
            this.year = today.getFullYear();
         },
         isbugun(kun, oy) {
            const today = new Date();
            const dayintable = new Date(this.year, oy, kun);
            return today.toDateString() === dayintable.toDateString() ? true : false;
         },
         isyakshanba(kun, oy) {
            const dayintable = new Date(this.year, oy, kun);
            return dayintable.getDay() == 0 ? true : false;
         }

      }
   }
</script>
