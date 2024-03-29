<?php
require_once 'includes/check_session.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Class</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/clockpicker/dist/jquery-clockpicker.min.css">
    <script src="https://cdn.jsdelivr.net/npm/clockpicker/dist/jquery-clockpicker.min.js"></script>
  </head>
<body>
  <!-- Navbar -->
  <!-- <div id="navbar-container"></div> -->
    
  <div class="container mb-3 page-title">
    <form class="form-control p-5 bg-light" action="save-class.php" method="post">
      <h1 class="text-center">Create Class</h1>
      <div class="row">
        <!-- Class Code -->
        <div class="col-md-4">
            <p class="label-text mb-1 mt-3">CLASS CODE</p>
            <input type="text" class="form-control input-border" name="class_code" placeholder="Enter Class Code" autocomplete="off" required>
        </div>
        <!-- Class Name -->
        <div class="col-md-8">
          <p class="label-text mb-1 mt-3">CLASS NAME</p>
          <input type="text" class="form-control input-border" name="class_name" placeholder="Enter Class Name" autocomplete="off" required>
        </div>
      </div>
      
      <div class="row mb-3">
        <!-- Room -->
        <div class="col-md d-block">
          <p class="label-text mb-1 mt-3">ROOM</p>
          <select class="form-select input-border" id="floatingSelectGrid" name="room" aria-label="Floating label select example" autocomplete="off" required>
            <option value="G102">G102</option>
            <option value="G103">G103</option>
            <option value="G104">G104</option>
            <option value="G105">G105</option>
            <option value="G106">G106</option>
            <option value="G200">G200</option>
            <option value="G201">G201</option>
            <option value="G202">G202</option>
            <option value="G203">G203</option>
            <option value="G204">G204</option>
            <option value="G205">G205</option>
            <option value="G206">G206</option>
            <option value="G207">G207</option>
            <option value="G208">G208</option>
            <option value="G209">G209</option>
            <option value="G210">G210</option>
            <option value="G215">G215</option>
            <option value="G216">G216</option>
            <option value="G217">G217</option>
            <option value="G218">G218</option>
            <option value="G300">G300</option>
            <option value="G301">G301</option>
            <option value="G302">G302</option>
            <option value="G303">G303</option>
            <option value="G305">G305</option>
            <option value="G306">G306</option>
            <option value="G307">G307</option>
            <option value="G308">G308</option>
            <option value="G309">G309</option>
            <option value="G310">G310</option>
            <option value="G311">G311</option>
            <option value="G312">G312</option>
            <option value="G313">G313</option>
            <option value="G314">G314</option>
            <option value="G315">G315</option>
            <option value="G404">G404</option>
            <option value="G405">G405</option>
            <option value="G406">G406</option>
            <option value="G407">G407</option>
            <option value="G408">G408</option>
            <option value="G409">G409</option>
            <option value="G410">G410</option>
        </select>
        </div>
        <!-- Time Start -->
        <div class="col-md d-block">
          <p class="label-text mb-1 mt-3">START</p>
          <input type="text" class="form-control input-border" name="time_start" id="timeInputStart" placeholder="Starting Time" autocomplete="off" required>
        </div>
        <!-- Time End -->
        <div class="col-md d-block">
          <p class="label-text mb-1 mt-3">END</p>
          <input type="text" class="form-control input-border" name="time_end" id="timeInputEnd" placeholder="Ending Time" autocomplete="off" required>
        </div>
        <!-- Day -->
        <div class="col-md">
          <div class="d-flex flex-column align-items-start">
            <p class="label-text mb-1 mt-3">DAY</p>
            <div class="d-flex ms-auto">
              <!-- Monday -->
              <input type="checkbox" class="btn-check" id="btn-check-M" name="day[]" value="M" autocomplete="off">
              <label class="btn btn-outline-dark input-border day-button rounded-circle" for="btn-check-M">M</label>
              <!-- Tuesday -->
              <input type="checkbox" class="btn-check" id="btn-check-T" name="day[]" value="T" autocomplete="off">
              <label class="btn btn-outline-dark input-border day-button rounded-circle" for="btn-check-T">T</label>
              <!-- Monday -->
              <input type="checkbox" class="btn-check" id="btn-check-W" name="day[]" value="W" autocomplete="off">
              <label class="btn btn-outline-dark input-border day-button rounded-circle" for="btn-check-W">W</label>
              <!-- Wednesday -->
              <input type="checkbox" class="btn-check" id="btn-check-Th" name="day[]" value="Th" autocomplete="off">
              <label class="btn btn-outline-dark input-border day-button rounded-circle" for="btn-check-Th">Th</label>
              <!-- Thursday -->
              <input type="checkbox" class="btn-check" id="btn-check-F" name="day[]" value="F" autocomplete="off">
              <label class="btn btn-outline-dark input-border day-button rounded-circle" for="btn-check-F">F</label>
              <!-- Saturday -->
              <input type="checkbox" class="btn-check" id="btn-check-Sat" name="day[]" value="Sat" autocomplete="off">
              <label class="btn btn-outline-dark input-border day-button rounded-circle" for="btn-check-Sat">Sat</label>
            </div>

            <div class="invalid-feedback">Please select at least one day.</div>

          </div>
        </div>

        <div class="d-flex justify-content-center mt-5">
          <a type="button" class="btn btn-black btn-outline-dark m-1" href="index.php">Cancel</a>
          <button class="btn input-border create-class-button m-1" type="submit">Save</button>
        </div>
      </div>
    </form>


    <script>
        $(document).ready(function () {
          // Initialize ClockPicker when the input field is clicked
          $('#timeInputStart, #timeInputEnd').clockpicker({
            placement: 'bottom',
            align: 'left',
            donetext: 'Done',
            autoclose: false,
            twelvehour: true // Set twelvehour to true for 12-hour format
          });

          // Listen to the 'change' event provided by ClockPicker
          $('#timeInputStart, #timeInputEnd').on('change', function () {
            console.log('time is: ', $(this).val());
            // filterClassesByTime($(this).val());
          });
        });
        document.addEventListener('DOMContentLoaded', function () {
            var form = document.querySelector('form');
            var invalidFeedback = document.querySelector('.invalid-feedback');

            form.addEventListener('submit', function (event) {
                var checkboxes = document.querySelectorAll('input[name="day[]"]');
                var checked = Array.from(checkboxes).some(function (checkbox) {
                    return checkbox.checked;
                });

                if (!checked) {
                    event.preventDefault();
                    invalidFeedback.style.display = 'block';
                } else {
                    invalidFeedback.style.display = 'none';
                }
            });
        });
    </script>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>