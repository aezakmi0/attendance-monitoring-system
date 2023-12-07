function includeHTML() {
    var element = document.getElementById('navbar-container');
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            element.innerHTML = this.responseText;
        }
    };

    // Specify the path to your navbar.html file
    xhttp.open('GET', 'navbar.html', true);
    xhttp.send();
}

// Call the includeHTML function
includeHTML();

let selectedDays = [];

function toggleDay(day) {
  const index = selectedDays.indexOf(day);

  if (index === -1) {
    // Add the day to the array if it's not already present
    selectedDays.push(day);
  } else {
    // Remove the day from the array if it's already present
    selectedDays.splice(index, 1);
  }
}

// Assuming you have a function to make an AJAX request to your server
function saveSelectedDays() {
    // Make an AJAX request to your server with the selectedDays data
    // Example using jQuery
    $.ajax({
      type: 'POST',
      url: 'save-class.php',
      data: { days: selectedDays },
      success: function(response) {
        console.log('Data saved successfully');
      },
      error: function(error) {
        console.error('Error saving data:', error);
      } 
    });
  }
  
  // const sortable = Sortable.create(document.getElementById('sortable-container'));

  $(document).ready(function() {
    // Make seatplan-seat elements draggable
    $('.seatplan-seat').draggable({
      snap: '.seatplan-seat-behind', // Snap to other seatplan-seat elements
      snapMode: 'inner', // Snap to the outer edges of other elements
      snapTolerance: 85, // Tolerance for snapping (adjust as needed)
      stack: '.seatplan-seat', // Stack elements on top of each other when dragged
      containment: '.seatplan-main-container' // Restrict dragging within the .container
    });

    // Make the container droppable
    $('.container').droppable();

    // Handle the drop event
    $('.seatplan-seat').on('dragstop', function(event, ui) {
      // You can handle additional logic here if needed
    });
  });