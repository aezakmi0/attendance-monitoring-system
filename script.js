// Include navbar
document.addEventListener("DOMContentLoaded", function () {
  fetch("navbar.html")
      .then(response => response.text())
      .then(data => {
          document.body.insertAdjacentHTML("afterbegin", data);
      });
});

  // Function to fetch and create buttons dynamically
// Function to fetch and create buttons dynamically
function fetchAndCreateButtons() {
    fetch('class-buttons.php')
        .then(response => response.json())
        .then(data => {
            const buttonsContainer = document.getElementById('dynamicButtonsContainer');
            data.forEach(classData => {
                // Fetch the number of students for the class
                fetch(`get_students_count.php?class_id=${classData.class_ID}`)
                    .then(response => response.json())
                    .then(studentData => {
                        const buttonContainer = document.createElement('div');
                        buttonContainer.classList.add('class-container', 'border', 'm-2');
                        buttonContainer.style.cursor = 'pointer';

                        // Assuming classData.time_start and classData.time_end are in HH:mm:ss format
                        const startTime = new Date(`1970-01-01T${classData.time_start}`);
                        const endTime = new Date(`1970-01-01T${classData.time_end}`);

                        const formattedStartTime = startTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit'}).replace(/\s/g, '');
                        const formattedEndTime = endTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit'}).replace(/\s/g, '');

                        const buttonContent = `
                            <div class="container-fluid p-3">
                                <div class="row">
                                    <a class="col class-code">${classData.class_code}</a>
                                </div>
                                <div class="row">
                                    <a class="col mb-3 class-name" href="#">${classData.class_name}</a>
                                </div>
                                <div class="row d-flex justify-content-between">
                                    <div class="col-auto d-flex justify-content-center align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 256 256"><path fill="currentColor" d="M128 24a104 104 0 1 0 104 104A104.11 104.11 0 0 0 128 24Zm0 192a88 88 0 1 1 88-88a88.1 88.1 0 0 1-88 88Zm64-88a8 8 0 0 1-8 8h-56a8 8 0 0 1-8-8V72a8 8 0 0 1 16 0v48h48a8 8 0 0 1 8 8Z"/></svg>
                                        <span class="p-1" style="font-size: 12px;">${formattedStartTime}-${formattedEndTime} ${classData.day}</span>
                                    </div>
                                    <div class="col-auto d-flex justify-content-center align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 256 256"><path fill="currentColor" d="m218.83 103.77l-80-75.48a1.14 1.14 0 0 1-.11-.11a16 16 0 0 0-21.53 0l-.11.11l-79.91 75.48A16 16 0 0 0 32 115.55V208a16 16 0 0 0 16 16h160a16 16 0 0 0 16-16v-92.45a16 16 0 0 0-5.17-11.78ZM208 208H48v-92.45l.11-.1L128 40l79.9 75.43l.11.1Z"/></svg>
                                        <span class="p-1" style="font-size: 12px;">${classData.room}</span>
                                    </div>
                                    <div class="col-auto d-flex justify-content-center align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 256 256"><path fill="currentColor" d="m226.53 56.41l-96-32a8 8 0 0 0-5.06 0l-96 32A8 8 0 0 0 24 64v80a8 8 0 0 0 16 0V75.1l33.59 11.19a64 64 0 0 0 20.65 88.05c-18 7.06-33.56 19.83-44.94 37.29a8 8 0 1 0 13.4 8.74C77.77 197.25 101.57 184 128 184s50.23 13.25 65.3 36.37a8 8 0 0 0 13.4-8.74c-11.38-17.46-27-30.23-44.94-37.29a64 64 0 0 0 20.65-88l44.12-14.7a8 8 0 0 0 0-15.18ZM176 120a48 48 0 1 1-86.65-28.45l36.12 12a8 8 0 0 0 5.06 0l36.12-12A47.89 47.89 0 0 1 176 120Zm-48-32.43L57.3 64L128 40.43L198.7 64Z"/></svg>
                                        <span class="p-1" style="font-size: 12px;">${studentData.total_students} Students</span>
                                    </div>
                                </div>
                            </div>
                        `;

                        buttonContainer.innerHTML = buttonContent;
                        buttonContainer.setAttribute('onclick', `redirectToClassPage(${classData.class_ID});`);
                        buttonsContainer.appendChild(buttonContainer);
                    })
                    .catch(error => console.error('Error fetching student data:', error));
            });
        })
        .catch(error => console.error('Error fetching data:', error));
}


function redirectToClassPage(class_ID) {
    window.location.href = `class.php?id=${class_ID}`;
    // window.location.href = `view_seats.php?id=${class_ID}`;
}

function reloadPage() {
    location.reload();
}

function updateDate() {
    var dateContainer = document.getElementById('dateToday');
    var dayOfWeekContainer = document.getElementById('dayOfWeek');
    var fullDateContainer = document.getElementById('fullDate');

    var daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    var currentDate = new Date();
    var dayOfWeek = daysOfWeek[currentDate.getDay()];

    // Use options to format the date as "21 December 2023"
    var options = { day: 'numeric', month: 'long', year: 'numeric' };
    var fullDate = currentDate.toLocaleDateString("en-US", options);

    dayOfWeekContainer.textContent = dayOfWeek;
    fullDateContainer.textContent = fullDate;

    // Update the date every 1 second (1000 milliseconds)
    setInterval(updateDate, 1000);
}



const isLeapYear = (year) => {
    return (
      (year % 4 === 0 && year % 100 !== 0 && year % 400 !== 0) ||
      (year % 100 === 0 && year % 400 === 0)
    );
  };
  const getFebDays = (year) => {
    return isLeapYear(year) ? 29 : 28;
  };
  let calendar = document.querySelector('.calendar');
  const month_names = [
      'January',
      'February',
      'March',
      'April',
      'May',
      'June',
      'July',
      'August',
      'September',
      'October',
      'November',
      'December',
    ];
  let month_picker = document.querySelector('#month-picker');
  const dayTextFormate = document.querySelector('.day-text-formate');
  const timeFormate = document.querySelector('.time-formate');
  const dateFormate = document.querySelector('.date-formate');
  
  month_picker.onclick = () => {
    month_list.classList.remove('hideonce');
    month_list.classList.remove('hide');
    month_list.classList.add('show');
    dayTextFormate.classList.remove('showtime');
    dayTextFormate.classList.add('hidetime');
    timeFormate.classList.remove('showtime');
    timeFormate.classList.add('hideTime');
    dateFormate.classList.remove('showtime');
    dateFormate.classList.add('hideTime');
  };
  
  const generateCalendar = (month, year) => {
    let calendar_days = document.querySelector('.calendar-days');
    calendar_days.innerHTML = '';
    let calendar_header_year = document.querySelector('#year');
    let days_of_month = [
        31,
        getFebDays(year),
        31,
        30,
        31,
        30,
        31,
        31,
        30,
        31,
        30,
        31,
      ];
  
    let currentDate = new Date();
  
    month_picker.innerHTML = month_names[month];
  
    calendar_header_year.innerHTML = year;
  
    let first_day = new Date(year, month);
  
  
    for (let i = 0; i <= days_of_month[month] + first_day.getDay() - 1; i++) {
  
      let day = document.createElement('div');
  
      if (i >= first_day.getDay()) {
        day.innerHTML = i - first_day.getDay() + 1;
  
        if (i - first_day.getDay() + 1 === currentDate.getDate() &&
          year === currentDate.getFullYear() &&
          month === currentDate.getMonth()
        ) {
          day.classList.add('current-date');
        }
      }
      calendar_days.appendChild(day);
    }
  };
  
  let month_list = calendar.querySelector('.month-list');
  month_names.forEach((e, index) => {
    let month = document.createElement('div');
    month.innerHTML = `<div>${e}</div>`;
  
    month_list.append(month);
    month.onclick = () => {
      currentMonth.value = index;
      generateCalendar(currentMonth.value, currentYear.value);
      month_list.classList.replace('show', 'hide');
      dayTextFormate.classList.remove('hideTime');
      dayTextFormate.classList.add('showtime');
      timeFormate.classList.remove('hideTime');
      timeFormate.classList.add('showtime');
      dateFormate.classList.remove('hideTime');
      dateFormate.classList.add('showtime');
    };
  });
  
  (function() {
    month_list.classList.add('hideonce');
  })();
  document.querySelector('#pre-year').onclick = () => {
    --currentYear.value;
    generateCalendar(currentMonth.value, currentYear.value);
  };
  document.querySelector('#next-year').onclick = () => {
    ++currentYear.value;
    generateCalendar(currentMonth.value, currentYear.value);
  };
  
  let currentDate = new Date();
  let currentMonth = { value: currentDate.getMonth() };
  let currentYear = { value: currentDate.getFullYear() };
  generateCalendar(currentMonth.value, currentYear.value);
  
