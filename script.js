// Include navbar
document.addEventListener("DOMContentLoaded", function () {
  fetch("navbar.html")
      .then(response => response.text())
      .then(data => {
          document.body.insertAdjacentHTML("afterbegin", data);
      });
});

// For edit-class drag and drop
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
