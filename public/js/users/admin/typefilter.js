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

  