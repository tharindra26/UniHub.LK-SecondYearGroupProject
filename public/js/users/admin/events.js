// Counter starts
function initializeCount() {
    totalValue = document.querySelectorAll(".tot");
    let timeinterval = 1000;

    totalValue.forEach((valueDisplay) => {
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

// filters======================================================================

// Get the value inside the urlRootValue div
//var URLROOT = document.querySelector('.urlRootValue').textContent.trim();

$(document).ready(function () {
  function updateContent() {
    var keyword = document.getElementById("search-bar-input").value;
    var university =
      selectBtn.firstElementChild.innerText != "Select University"
        ? selectBtn.firstElementChild.innerText
        : "";

    // Send an AJAX request with the filter value
    $.ajax({
      url: "http://localhost/unihub/events/filterEvents",
      //url: URLROOT + "/events/searchEvents",
      method: "POST",
      data: {
        keyword: keyword,
        date: '',
        university: university,
        categories: [],
      },
      success: function (data) {
        // Update the content section with the retrieved data
        $("#events-filter-table").html(data);
      },
    });
  }

  // Attach keyup event listener to the search bar input
  document
    .getElementById("search-bar-input")
    .addEventListener("keyup", updateContent);

  // Trigger the initial update when the page loads
  updateContent();

 });



//university filter
const uniFilter = document.querySelector(".uni-filter"),
  selectBtn = uniFilter.querySelector(".select-btn"),
  searchInput = uniFilter.querySelector("input"),
  uniResetBtn = uniFilter.querySelector(".uni-reset-btn");
uniFilterOptions = uniFilter.querySelector(".uni-filter-options");
var searchBarInput = document.getElementById("search-bar-input").value;

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
  var university =
    selectedLi.innerTex != "Select University" ? selectedLi.innerText : "";
  
  // Send an AJAX request with the filter value
  $.ajax({
    url: "http://localhost/unihub/events/filterEvents",
    //url: URLROOT +"/events/searchEvents",
    method: "POST",
    data: {
      keyword: keyword,
      date: '',
      university: university,
      categories: [],
    },
    success: function (data) {
      // Update the content section with the retrieved data
      $("#events-filter-table").html(data);
    },
  });
}

searchInput.addEventListener("keyup", () => {
  // console.log(searchInput.value);
  let arr = []; //creating empty array
  let searchedVal = searchInput.value.toLowerCase();
  //returning all universities from array which are start with user search value
  //and mapping returned university with li and joining them
  arr = universities
    .filter((data) => {
      return data.toLowerCase().startsWith(searchedVal);
    })
    .map((data) => `<li onclick="updateName(this)" > ${data} </li>`)
    .join("");
  console.log(arr);
  uniFilterOptions.innerHTML = arr ? arr : `<p>Oops! University not found</p>`;
});

selectBtn.addEventListener("click", () => {
  uniFilter.classList.toggle("uni-filter-active");
});

uniResetBtn.addEventListener("click", () => {
  searchInput.value = "";
  addUniversity();
  uniFilter.classList.remove("uni-filter-active");
  selectBtn.firstElementChild.innerText = `Select University`;

  var keyword = document.getElementById("search-bar-input").value;
  var university = "";
 
  $.ajax({
    url: "http://localhost/unihub/events/filterEvents",
    //url: URLROOT +"/events/searchEvents",
    method: "POST",
    data: {
      keyword: keyword,
      date: '',
      university: university,
      categories: [],
    },
    success: function (data) {
      // Update the content section with the retrieved data
      $("#events-filter-table").html(data);
    },
  });
});
//university filter






