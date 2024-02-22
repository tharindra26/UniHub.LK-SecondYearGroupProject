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


//popup

function openPopup(confirm) {
  let popup = document.getElementById(confirm);
  if (popup) popup.classList.add("open-popup");
}

function closePopup(confirm) {
  let popup = document.getElementById(confirm);
  if (popup) popup.classList.remove("open-popup");
}

function confirmDeactivate(confirm) {
  let confirmBtn = document.getElementById(confirm);
  // // Your AJAX function here
  $.ajax({
    url: "http://localhost/unihub/users/deactivateUser",
    type: "POST", // or 'GET' depending on your needs
    data: {
      user_id: confirm,
    },
    success: function (response) {
      // Handle the success response
      console.log("AJAX request successful:", response);

      // Update the text content on success
      // interestedBtn.find('span').text(response);
      if (response === "1") {
        confirmBtn.classList.remove("open-popup");
      }
      //else {
      //     confirmBtn.addClass("new-class");
      // }
    },
    error: function (error) {
      // Handle the error response
      console.error("AJAX request failed:", error);
    },
  });
  // if (popup) popup.classList.remove("open-popup");
}

function confirmActivate(confirm) {
  let confirmBtn = document.getElementById(confirm);
  // // Your AJAX function here
  $.ajax({
    url: "http://localhost/unihub/users/activateUser",
    type: "POST", // or 'GET' depending on your needs
    data: {
      user_id: confirm,
    },
    success: function (response) {
      // Handle the success response
      console.log("AJAX request successful:", response);

      // Update the text content on success
      // interestedBtn.find('span').text(response);
      if (response === "1") {
        confirmBtn.classList.remove("open-popup");
      }
      //else {
      //     confirmBtn.addClass("new-class");
      // }
    },
    error: function (error) {
      // Handle the error response
      console.error("AJAX request failed:", error);
    },
  });
  // if (popup) popup.classList.remove("open-popup");
}

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
      console.log("AJAX request successful:", response);

      $("#main-id").html(response);
    },
    error: function (error) {
      // Handle the error response
      console.error("AJAX request failed:", error);
    },
  });
  // if (popup) popup.classList.remove("open-popup");
}

// filters======================================================================
// $(document).ready(function () {
//   function updateContent() {
//     var keyword = document.getElementById("search-bar-input").value;
//     // var date = document.getElementById("date-input").value;
//     // var university =
//     //   selectBtn.firstElementChild.innerText != "Select University"
//     //     ? selectBtn.firstElementChild.innerText
//     //     : "";
//     // const checkedCategories = Array.from(items)
//     //   .filter((item) => item.classList.contains("category-checked"))
//     //   .map((item) => item.querySelector(".checkbox + span").innerText);

//     // Send an AJAX request with the filter value
//     $.ajax({
//       url: "http://localhost/unihub/users/filterUsers",
//       method: "POST",
//       data: {
//         keyword: keyword,
//         // date: date,
//         // university: university,
//         // categories: checkedCategories,
//       },
//       success: function (response) {
//         $("#filter-table").html(response);
//       },
//       error: function (error) {
//         console.error("Error:", error);
//       },
//     });
//   }

//   // Attach keyup event listener to the search bar input
//   document
//     .getElementById("search-bar-input")
//     .addEventListener("keyup", updateContent);

//   // Attach change event listener to date input
//   // document
//   //   .getElementById("date-input")
//   //   .addEventListener("change", updateContent);

//   // document
//   //   .getElementById("date-reset-btn")
//   //   .addEventListener("click", updateContent);

//   // Trigger the initial update when the page loads
//   updateContent();
// });
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
var max_index = 6;

function displayIndexButtons(){
  $(".index-buttons button").remove();
  $(".index-buttons").append('<button>Previuos</button>');
  for(var i=1; i<=max_index; i++){
    $(".index-buttons").append('<button index="'+i+'">'+i+'</button>');
  }
  $(".index-buttons").append('<button>Next</button>');
  highlightIndexButton();
}

displayIndexButtons();

function highlightIndexButton(){
  start_index = ((current_index - 1)* table_size) + 1;
  end_index = (start_index + table_size) - 1;
  if (end_index > arr_length){
    end_index = arr_length;
  }

  $(".paging span").text('Showing '+start_index+' to '+end_index+' of '+arr_length+' entries')
  $(".index-buttons button").removeClass('active');
  $(".index-buttons button[index = '"+current_index+"']").addClass('active');

}
