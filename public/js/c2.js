var gcObject = {
   options: options = {
       dayNames: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
       dayBegin: 1,
       monthNames: [],
       onPrevMonth: function(e) {},
       onNextMonth: function(e) {},
       events: [{
           date: null,
           eventName: null,
           className: null,
           onclick: function(e, t) {},
           dateColor: "#38385c"
       }],
       onclickDate: function(e, t) {},
       nextIcon: "&gt;",
       prevIcon: "&lt;"
   },
   el: "",
   eventAnimate: "none",
   pickedDate: new Date,
   setDate(e) {
       const t = new Date(e);
       t != this.pickedDate && (t > this.pickedDate ? this.eventAnimate = "next" : this.eventAnimate = "prev",
       this.pickedDate = t,
       this.render())
   },
   setEvents(e) {
       this.options.events = e,
       this.render()
   },
   prevMonth() {
       this.pickedDate = new Date(this.pickedDate.getFullYear(),this.pickedDate.getMonth() - 2,1),
       this.options.onPrevMonth(this.pickedDate),
       this.eventAnimate = "prev",
       this.render()
   },
   nextMonth() {
       this.pickedDate = new Date(this.pickedDate.getFullYear(),this.pickedDate.getMonth(),1),
       this.options.onNextMonth(this.pickedDate),
       this.eventAnimate = "next",
       this.render()
   },
   render() {
       const e = $(this.el);
       e.html("");
       const t = $('<div class="gc-calendar"></div>');
       e.append(t);
       const n = $('<div class="gc-calendar-header"></div>');
       n.appendTo(t);
       const a = $('<span class="gc-calendar-month-year"></span>');
       a.appendTo(n);
       $(`<span class='month'>${this.options.monthNames[this.pickedDate.getMonth()]}</span>`).appendTo(a);
       $(`<span class='year'> ${this.pickedDate.getFullYear()}</span>`).appendTo(a);
       const o = $(`<button type="button" class='prev'>${this.options.prevIcon}</button>`);
       o.appendTo(n),
       o.on("click", (function(e) {
           gcObject.prevMonth()
       }
       ));
       const s = $(`<button type="button" class='next'>${this.options.nextIcon}</button>`);
       s.appendTo(n),
       s.on("click", (function(e) {
           gcObject.nextMonth()
       }
       ));
       const i = $('<table class="calendar"></table>');
       i.removeClass("slide-in-left slide-in-right slide-out-left slide-out-right"),
       "none" == this.eventAnimate ? i.hide().addClass("slide-in-left").show() : "prev" == this.eventAnimate ? i.hide().addClass("slide-out-right").show().delay(200).hide().removeClass("slide-out-right").addClass("slide-in-left").show() : i.hide().addClass("slide-out-left").show().delay(200).hide().removeClass("slide-out-left").addClass("slide-in-right").show(),
       i.appendTo(t);
       const c = $("<thead></thead>");
       c.appendTo(i);
       const d = $("<tr></tr>");
       d.appendTo(c);
       const l = this.options.dayNames.length;
       for (let e = 0; e < l; e++) {
           var h = e + gcObject.options.dayBegin;
           h >= l && (h -= l);
           const t = gcObject.options.dayNames[h];
           $('<th class="dayname">' + t + "</th>").appendTo(d)
       }
       var r = $("<tbody></tbody>");
       r.appendTo(i);
       const p = this.getCalendarArray()
         , g = new Date;
       p.forEach((function(e) {
           var t = $("<tr></tr>");
           e.forEach((function(e) {
               var n = $('<td class="day"></td>');
               n.appendTo(t);
               var a = $('<a type="button" class="btn-gc-cell"></a>');
               n.append(a),
               a.click((function(t) {
                   gcObject.options.onclickDate(t, e)
               }
               ));
               var o = $(`<span class="day-number">${e.date}</span>`);
               n.addClass(e.class),
               o.appendTo(a),
               g.getFullYear() == e.datejs.getFullYear() && g.getMonth() == e.datejs.getMonth() && g.getDate() == e.datejs.getDate() && a.addClass("today");
               var s = "";
               gcObject.options.events.forEach((function(t) {
                   if (t.date.getFullYear() == e.datejs.getFullYear() && t.date.getMonth() == e.datejs.getMonth() && t.date.getDate() == e.datejs.getDate()) {
                       n.addClass("event");
                       var a = $(`<div class="gc-event ${t.className}">${t.eventName}</div>`);
                       s = "color:" + (t.dateColor || "inherit"),
                       a.on("click", (function(e) {
                           t.onclick(e, t)
                       }
                       )),
                       n.append(a)
                   }
               }
               )),
               o.attr("style", s)
           }
           )),
           t.appendTo(r)
       }
       ))
   },
   getCalendarArray() {
       var e = new Date(this.pickedDate.getFullYear(),this.pickedDate.getMonth(),1).getDay()
         , t = new Date(this.pickedDate.getFullYear(),this.pickedDate.getMonth() + 1,0).getDate()
         , n = new Date(this.pickedDate.getFullYear(),this.pickedDate.getMonth(),0).getDate()
         , a = []
         , o = e - gcObject.options.dayBegin;
       o < 0 && (o = 7 + o);
       for (let e = 0; e < o; e++)
           a.push({
               datejs: new Date(this.pickedDate.getFullYear(),this.pickedDate.getMonth() - 1,n),
               date: n,
               class: "prev-month"
           }),
           n--;
       a.reverse();
       var s = 1;
       for (let e = a.length; e < 7; e++)
           a.push({
               datejs: new Date(this.pickedDate.getFullYear(),this.pickedDate.getMonth(),s),
               date: s,
               class: "current-month"
           }),
           s++;
       var i = [a]
         , c = !1
         , d = this.pickedDate
         , l = "current-month";
       for (let e = 1; e < 6; e++) {
           var h = [];
           for (let e = 0; e < 7; e++)
               h.push({
                   datejs: new Date(d.getFullYear(),d.getMonth(),s),
                   date: s,
                   class: l
               }),
               ++s > t && (s = 1,
               d.setDate(1),
               d.setMonth(d.getMonth() + 1),
               c = !0,
               l = "next-month");
           if (i.push(h),
           c)
               break
       }
       return i
   }
};
jQuery.fn.calendarGC = function(e={
   dayNames: dayNames,
   dayBegin: dayBegin,
   monthNames: monthNames,
   onPrevMonth: onPrevMonth,
   onNextMonth: onNextMonth,
   events: events,
   onclickDate: onclickDate,
   nextIcon: "&gt;",
   prevIcon: "&lt;"
}) {
   return gcObject.options.dayNames = e.dayNames || ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
   gcObject.options.dayBegin = void 0 === e.dayBegin || null === e.dayBegin ? 1 : e.dayBegin,
   gcObject.options.monthNames = e.monthNames || ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
   gcObject.options.onPrevMonth = e.onPrevMonth || function(e) {}
   ,
   gcObject.options.onNextMonth = e.onNextMonth || function(e) {}
   ,
   gcObject.options.events = e.events || [{
       date: null,
       eventName: null,
       className: null,
       onclick: function(e, t) {},
       dateColor: "#38385c"
   }],
   gcObject.options.onclickDate = e.onclickDate || function(e, t) {}
   ,
   gcObject.options.nextIcon = e.nextIcon || "&gt;",
   gcObject.options.prevIcon = e.prevIcon || "&lt;",
   gcObject.el = this,
   gcObject.render(),
   gcObject
}
;

$(document).ready(function() {
   console.log('c2.js loaded');
});