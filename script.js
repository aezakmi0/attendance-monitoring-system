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





initGrid();

function initGrid() {
    var grid = new Muuri('.grid', {
        dragEnabled: true,
        layoutOnInit: false
    }).on('move', function () {
        saveLayout(grid);
    });

    var layout = window.localStorage.getItem('layout');
    if (layout) {
        loadLayout(grid, layout);
    } else {
        grid.layout(true);
    }
}

function serializeLayout(grid) {
    var itemIds = grid.getItems().map(function (item) {
        return item.getElement().getAttribute('data-id');
    });
    return JSON.stringify(itemIds);
}

function saveLayout(grid) {
    var layout = serializeLayout(grid);
    window.localStorage.setItem('layout', layout);

    // Send the layout data to the server to save in the database
    // Use Ajax or fetch API to send data to the server
    // Example using fetch:
    fetch('save_layout.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ layout: layout }),
    })
        .then(response => response.json())
        .then(data => console.log('Layout saved:', data))
        .catch(error => console.error('Error saving layout:', error));
}

function loadLayout(grid, serializedLayout) {
    var layout = JSON.parse(serializedLayout);
    var currentItems = grid.getItems();
    var currentItemIds = currentItems.map(function (item) {
        return item.getElement().getAttribute('data-id')
    });
    var newItems = [];
    var itemId;
    var itemIndex;

    for (var i = 0; i < layout.length; i++) {
        itemId = layout[i];
        itemIndex = currentItemIds.indexOf(itemId);
        if (itemIndex > -1) {
            newItems.push(currentItems[itemIndex])
        }
    }

    grid.sort(newItems, { layout: 'instant' });
}
