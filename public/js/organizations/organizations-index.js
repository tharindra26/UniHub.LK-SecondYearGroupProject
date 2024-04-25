let next = document.querySelector(".next");
let prev = document.querySelector(".prev");

function clickNext() {
  next.click();
}

next.addEventListener("click", function () {
  let items = document.querySelectorAll(".item");
  document.querySelector(".slider").appendChild(items[0]);
});

prev.addEventListener("click", function () {
  let items = document.querySelectorAll(".item");
  document.querySelector(".slider").prepend(items[items.length - 1]);
});

setInterval(clickNext, 3000);

// Get the value inside the urlRootValue div
var URLROOT = document.querySelector(".urlRootValue").textContent.trim();

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
  searchInput.value = ""; //athule value eka
  addUniversity(selectedLi.innerText);
  uniFilter.classList.remove("uni-filter-active");
  selectBtn.firstElementChild.innerText = selectedLi.innerText;

  var keyword = document.getElementById("search-bar-input").value;
  var university =
    selectedLi.innerTex != "Select University" ? selectedLi.innerText : "";
  const checkedCategories = Array.from(items)
    .filter((item) => item.classList.contains("category-checked"))
    .map((item) => item.querySelector(".checkbox + span").innerText);

  // Send an AJAX request with the filter value
  $.ajax({
    url: URLROOT + "/organizations/searchOrganizations",
    method: "POST",
    data: {
      keyword: keyword,
      university: university,
      categories: checkedCategories,
    },
    success: function (data) {
      // Update the content section with the retrieved data
      $("#content-section").html(data);
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
  const checkedCategories = Array.from(items)
    .filter((item) => item.classList.contains("category-checked"))
    .map((item) => item.querySelector(".checkbox + span").innerText);

  $.ajax({
    url: URLROOT + "/events/searchEvents",
    method: "POST",
    data: {
      keyword: keyword,
      university: university,
      categories: checkedCategories,
    },
    success: function (data) {
      // Update the content section with the retrieved data
      $("#content-section").html(data);
    },
  });
});

//category filter
const categorySelectBtn = document.querySelector(".category-select-btn"),
  items = document.querySelectorAll(".item"),
  categoryResetBtn = document.querySelector(".category-reset-btn");
const categoryCheckboxes = document.querySelectorAll(".list-items .checkbox");

categorySelectBtn.addEventListener("click", () => {
  categorySelectBtn.classList.toggle("category-filter-active");
});

function updateCategoryFilter() {
  const checkedCategories = Array.from(items)
    .filter((item) => item.classList.contains("category-checked"))
    .map((item) => item.querySelector(".checkbox + span").innerText);

  // Get other filter values
  const keyword = document.getElementById("search-bar-input").value;
  const university =
    selectBtn.firstElementChild.innerText != "Select University"
      ? selectBtn.firstElementChild.innerText
      : "";

  // Send an AJAX request with the filter values
  $.ajax({
    url: URLROOT + "/organizations/searchOrganizations",
    method: "POST",
    data: {
      keyword: keyword,
      university: university,
      categories: checkedCategories,
    },
    success: function (data) {
      // Update the content section with the retrieved data
      $("#content-section").html(data);
    },
  });
}

items.forEach((item) => {
  item.addEventListener("click", () => {
    item.classList.toggle("category-checked");

    let checked = document.querySelectorAll(".category-checked"),
      categoryBtnText = document.querySelector(".category-btn-txt");

    if (checked && checked.length > 0) {
      categoryBtnText.innerText = `${checked.length} Categories Selected`;
    } else {
      categoryBtnText.innerText = `Select Category`;
    }
    updateCategoryFilter();
  });
});

categoryResetBtn.addEventListener("click", () => {
  items.forEach((item) => {
    item.classList.remove("category-checked");
  });

  // Reset the category button text
  document.querySelector(".category-btn-txt").innerText = `Select Category`;

  updateCategoryFilter();
});





$(document).ready(function () {
  function updateContent() {
    var keyword = document.getElementById("search-bar-input").value;
    var university =
      selectBtn.firstElementChild.innerText != "Select University"
        ? selectBtn.firstElementChild.innerText
        : "";
    const checkedCategories = Array.from(items)
      .filter((item) => item.classList.contains("category-checked"))
      .map((item) => item.querySelector(".checkbox + span").innerText);

    // Send an AJAX request with the filter value
    $.ajax({
      // url: "http://localhost/unihub/events/searchEvents",
      url: URLROOT + "/organizations/searchOrganizations",
      method: "POST",
      data: {
        keyword: keyword,
        university: university,
        categories: checkedCategories
      },
      success: function (response) {
        console.log(response);
        // Update the content section with the retrieved data
        $("#content-section").html(response);
      },
    });
  }

  document
    .getElementById("search-bar-input")
    .addEventListener("keyup", updateContent);

  updateContent();
});
