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

  
  // const sortable = Sortable.create(document.getElementById('sortable-container'));

  var grid1 = new Muuri('.grid-1', {
    dragEnabled: true,
    dragContainer: document.body,
    dragSort: function () {
      return [grid1, grid2]
    }
  });
  
  var grid2 = new Muuri('.grid-2', {
    dragEnabled: true,
    dragContainer: document.body,
    dragSort: function () {
      return [grid1, grid2]
    }
  });

  // Prompt the user to check at least one day for create-class.html
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