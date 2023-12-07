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

  const draggables = document.querySelectorAll('.seatplan-seat');
  const containers = document.querySelectorAll('.seatplan-container');

  draggables.forEach(draggable => {
    draggable.addEventListener('dragstart', () =>{
      draggable.classList.add('dragging')
    })
    draggable.addEventListener('dragend', () => {
      draggable.classList.remove('dragging')
    })
  })

  containers.forEach(container => {
    container.addEventListener('dragover', e => {
      e.preventDefault()
      const afterElement = getDragAfterElement(container, e.clientY)
      console.log(afterElement)
      const draggable = document.querySelector('.dragging')
      if(afterElement == null){
        container.appendChild(draggable)
      } else{
        container.insertBefore(draggable, afterElement)
      }
    })
  })

  function getDragAfterElement(container, y){
    const draggableElements = [...container.querySelectorAll('.seatplan-seat:not(.dragging)')]
    
    return draggableElements.reduce((closest, child) => {
      const box = child.getBoundingClientRect()
      const offset = y - box.top - box.height / 2
      if (offset < 0 && offset > closest.offset) {
        return { offset: offset, element: child };
    } else {
        return closest;
    }
    }, { offset: Number.NEGATIVE_INFINITY }).element
  }

  // 16:40 https://www.youtube.com/watch?v=jfYWwQrtzzY