// Counter starts
function initializeCount() {
  let value = document.querySelectorAll(".num");
  let timeinterval = 1000;

  value.forEach((valueDisplay) => {
    let startValue = 0;
    let endValue = parseInt(valueDisplay.getAttribute("data-val"));
    let duration = Math.floor(timeinterval / endValue);
    let counter = setInterval(() => {
      startValue += 1;
      valueDisplay.textContent = startValue;
      if (startValue === endValue) {
        clearInterval(counter);
      }
    }, duration);
  });
}

initializeCount();

function updateUser(userId) {
  // // Your AJAX function here
  $.ajax({
    url: "http://localhost/unihub/users/updateUser",
    type: "POST", // or 'GET' depending on your needs
    data: {
      user_id: userId,
    },
    success: function (response) {
      // Handle the success response
      //console.log("AJAX request successful:", response);

      $("#main-id").html(response);
    },
    error: function (error) {
      // Handle the error response
      console.error("AJAX request failed:", error);
    },
  });
  
}

// filters======================================================================

function updateContent() {
  var keyword = document.getElementById("search-bar-input").value;
  console.log(keyword );
  $.ajax({
    url: "http://localhost/unihub/users/filterUsers",
    method: "POST",
    data: {
      keyword: keyword
    },
    success: function (response) {
      //console.log(response);
      $("#filter-table").html(response);
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });
}

// Attach keyup event listener to the search bar input
document.getElementById("search-bar-input").addEventListener("keyup", updateContent);

updateContent();

// filters-end==================================================================

//Type filter
function typefilter(type) {
  // console.log(type);

  $.ajax({
    url: "http://localhost/unihub/users/typefilter",
    type: "POST",
    data: {
      value: type,
    },
    success: function (response) {
      $("#filter-table").html(response);
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });
}

var arr_length = 60;
var table_size = 10;
var start_index = 1;
var end_index = 10;
var current_index = 1;
var max_index = 2;

function displayIndexButtons() {
  $(".index-buttons button").remove();
  $(".index-buttons").append("<button>Previuos</button>");
  for (var i = 1; i <= max_index; i++) {
    $(".index-buttons").append('<button index="' + i + '">' + i + "</button>");
  }
  $(".index-buttons").append("<button>Next</button>");
  highlightIndexButton();
}

displayIndexButtons();

function highlightIndexButton() {
  start_index = (current_index - 1) * table_size + 1;
  end_index = start_index + table_size - 1;
  if (end_index > arr_length) {
    end_index = arr_length;
  }

  $(".paging span").text(
    "Showing " +
      start_index +
      " to " +
      end_index +
      " of " +
      arr_length +
      " entries"
  );
  $(".index-buttons button").removeClass("active");
  $(".index-buttons button[index = '" + current_index + "']").addClass(
    "active"
  );
}
