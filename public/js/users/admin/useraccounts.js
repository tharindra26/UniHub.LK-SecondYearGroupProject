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

function updateUser(confirm) {
  // // Your AJAX function here
  $.ajax({
    url: "http://localhost/unihub/users/updateUser",
    type: "POST", // or 'GET' depending on your needs
    data: {
      user_id: confirm,
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

// // filters======================================================================
$(document).ready(function () {
  function updateContent() {
    var keyword = document.getElementById("search-bar-input").value;
    // var date = document.getElementById("date-input").value;
    // var university =
    //   selectBtn.firstElementChild.innerText != "Select University"
    //     ? selectBtn.firstElementChild.innerText
    //     : "";
    // const checkedCategories = Array.from(items)
    //   .filter((item) => item.classList.contains("category-checked"))
    //   .map((item) => item.querySelector(".checkbox + span").innerText);

    // Send an AJAX request with the filter value
    $.ajax({
      url: "http://localhost/unihub/users/filterUsers",
      method: "POST",
      data: {
        keyword: keyword,
        // date: date,
        // university: university,
        // categories: checkedCategories,
      },
      success: function (response) {
        $("#filter-table").html(response);
      },
      error: function (error) {
        console.error("Error:", error);
      },
    });
  }

  // Attach keyup event listener to the search bar input
  document
    .getElementById("search-bar-input")
    .addEventListener("keyup", updateContent);

  // Attach change event listener to date input
  // document
  //   .getElementById("date-input")
  //   .addEventListener("change", updateContent);

  // document
  //   .getElementById("date-reset-btn")
  //   .addEventListener("click", updateContent);

  // Trigger the initial update when the page loads
  updateContent();
});
// // filters-end==================================================================



// university filter==============================================================
//university filter
const uniFilter = document.querySelector(".uni-filter"),
  selectBtn = uniFilter.querySelector(".select-btn"),
  searchInput = uniFilter.querySelector("input"),
  uniResetBtn = uniFilter.querySelector(".uni-reset-btn");
uniFilterOptions = uniFilter.querySelector(".uni-filter-options");

let universities = [
  "University of Colombo",
  "University of Peradeniya",
  "University of Moratuwa",
  "University of Kelaniya",
  "University of Sri Jayewardenepura",
  "University of Ruhuna",
  "University of Jaffna",
  "University of Sabaragamuwa",
  "Eastern University, Sri Lanka",
  "South Eastern University of Sri Lanka",
  "Rajarata University of Sri Lanka",
  "Wayamba University of Sri Lanka",
  "Uva Wellassa University",
  "University of the Visual and Performing Arts",
  "Sabaragamuwa University of Sri Lanka",
  "Open University of Sri Lanka",
  "General Sir John Kotelawala Defence University",
  "Sri Lanka Institute of Information Technology (SLIIT)",
  "Informatics Institute of Technology (IIT)",
  "General Sir John Kotelawala Defence University - Southern Campus",
];

function addUniversity(selectedUniversity) {
  // console.log("badu wada");
  console.log(uniFilterOptions);
  uniFilterOptions.innerHTML = "";
  universities.forEach((university) => {
    //if selected university and university value is asame then add selected class
    let isSelected = university == selectedUniversity ? "selected" : "";
    //adding each university inside li and inserting all li inside uni-filter-options
    let li = `<li onclick="updateName(this)" class="${isSelected}" > ${university} </li>`;
    uniFilterOptions.insertAdjacentHTML("beforeend", li);
  });
}
addUniversity();

function updateName(selectedLi) {
  searchInput.value = "";
  addUniversity(selectedLi.innerText);
  uniFilter.classList.remove("uni-filter-active");
  selectBtn.firstElementChild.innerText = selectedLi.innerText;

  var keyword = document.getElementById("search-bar-input").value;
  var date = document.getElementById("date-input").value;
  var university =
    selectedLi.innerTex != "Select University" ? selectedLi.innerText : "";
  const checkedCategories = Array.from(items)
    .filter((item) => item.classList.contains("category-checked"))
    .map((item) => item.querySelector(".checkbox + span").innerText);

  // Send an AJAX request with the filter value
  $.ajax({
    url: "http://localhost/unihub/events/searchEvents",
    method: "POST",
    data: {
      keyword: keyword,
      date: date,
      university: university,
      categories: checkedCategories,
    },
    success: function (data) {
      // Update the content section with the retrieved data
      $("#content-section").html(data);
    },
  });
}

// university filter==============================================================
