<?php
require_once 'includes/check_session.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
    <!-- for "online attendance" and date today -->
    <div class="mt-2 container d-flex justify-content-between align-items-center">
        <h1 class="class-code">Attendance</h1>
        <div class="date-today" id="dateToday">
            <h2 id="dayOfWeek"></h2>
            <h3 id="fullDate"></h3>
        </div>
    </div>
    
    <!-- for the filter form or create class -->
    <div class="container mt-3">
        <!-- Labels -->
        <div class="row g-3 ">
            <div class="col-md">
                <p class="label-text">SEARCH</p>
            </div>
            <div class="col-md">
                <p class="label-text">FILTER</p>
            </div>
            <div class="col-md invisible">
                <p class="label-text">FILTER2</p>
            </div>
            <div class="col-auto invisible">
                <p class="label-text">CLEAR</p>
            </div>
            <div class="col-md">
                <p class="label-text">CREATE</p>
            </div>
        </div>
        <div class="row g-3 ">
            <div class="col-md">
                <div class="form-floating w-100">
                    <!-- <input type="text" class="form-control input-border" id="floatingInputGrid" placeholder="Search class"> -->
                    <input type="text" class="form-control input-border" autocomplete="off" id="filterSearch" placeholder="Search class" oninput="searchClasses(this.value)">
                    <label for="filterSearch">Search class</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating w-100">
                    <input type="text" class="form-control input-border clockpicker" id="filterTime" autocomplete="off">
                    <label for="filterTime">Time</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating w-100">
                    <select class="form-select input-border" id="filterRoom" aria-label="Floating label select example">
                        <option selected>Select Room</option>
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
                    <label for="filterRoom">Room</label>
                </div>
            </div>
            <div class="col-auto d-flex align-items-center">
                <div class="text-center">
                    <a type="button" onclick="clearFilters()" class="p-2 btn-green btn-rounded"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="m14.088 11.263l-.713-.713L16.95 6H8.825l-1-1h10.156q.317 0 .467.28q.15.282-.052.55zM13 14.421v3.81q0 .329-.22.549q-.22.22-.55.22h-.46q-.33 0-.55-.22q-.22-.22-.22-.55v-5.809l-7.9-7.9q-.14-.14-.15-.341q-.01-.201.15-.367q.165-.165.357-.165t.356.165l16.38 16.38q.145.145.152.344q.007.198-.158.363q-.166.16-.354.163q-.189.002-.354-.163zm.375-3.871"/></svg></a>
                </div>
            </div>
            <div class="col-md">
                <a class="btn create-class-button w-100" href="create-class.php" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 28 28">
                        <path fill="currentColor" d="M14.5 13V3.754a.75.75 0 0 0-1.5 0V13H3.754a.75.75 0 0 0 0 1.5H13v9.253a.75.75 0 0 0 1.5 0V14.5l9.25.003a.75.75 0 0 0 0-1.5L14.5 13Z"/>
                    </svg>
                    <span>Create Class</span>
                </a>
            </div>
        </div><hr class="hr" />
    </div>
    
    <!-- CLASS BUTTON -->
    <div id="dynamicButtonsContainer" class="container d-flex flex-wrap"></div>
    

    <script>
        $(document).ready(function () {
            // Initialize ClockPicker when the input field is clicked
            $('#filterTime').clockpicker({
                placement: 'bottom',
                align: 'left',
                donetext: 'Done',
                autoclose: false,
                twelvehour: true // Set twelvehour to true for 12-hour format
            });

            // Listen to the 'change' event provided by ClockPicker
            $('#filterTime').on('change', function () {
                console.log('time is: ', $(this).val());
                filterClassesByTime($(this).val());
            });
        });
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('filterSearch');
            searchInput.addEventListener('input', function () {
                console.log('search is: ', filterTimeInput.value);
                searchClasses(searchInput.value);
            });
            
            const filterTimeInput = document.getElementById('filterTime');
            filterTimeInput.addEventListener('input', function () {
                console.log('time is: ', filterTimeInput.value);
                filterClassesByTime(filterTimeInput.value);
            });

            const roomInput = document.getElementById('filterRoom');
            roomInput.addEventListener('input', function () {
                console.log('room is: ', roomInput.value);
                filterClassesByRoom(roomInput.value);
            });

            fetchAndCreateButtons(); // Initial fetch without search term
            updateDate();
        });
    </script>
    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
