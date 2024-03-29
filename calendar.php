<?php
require_once 'includes/check_session.inc.php';
?>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Calendar</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/calendar.css">
  <script src="calendar.js" defer></script>
  <script src="script.js" defer></script>
</head>

<body>
  <div class="calendar-container">
    <div class="calendar">
      <div class="calendar-header d-flex align-items-center">
        <span class="month-picker" id="month-picker"> May </span>
        <div class="year-picker d-flex align-items-center" id="year-picker">
          <span class="year-change" id="pre-year">
            <pre><</pre>
          </span>
          <span id="year">2020 </span>
          <span class="year-change" id="next-year">
            <pre>></pre>
          </span>
        </div>
      </div>

      <div class="calendar-body">
        <div class="calendar-week-days">
          <div>Sun</div>
          <div>Mon</div>
          <div>Tue</div>
          <div>Wed</div>
          <div>Thu</div>
          <div>Fri</div>
          <div>Sat</div>
        </div>
        <div class="calendar-days">
        </div>
      </div>
      <div class="month-list"></div>
    </div>
  </div>
</body>

</html>