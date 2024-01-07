let next = document.querySelector('.next')
let prev = document.querySelector('.prev')

next.addEventListener('click', function () {
    let items = document.querySelectorAll('.item')
    document.querySelector('.slider').appendChild(items[0])
})

prev.addEventListener('click', function () {
    let items = document.querySelectorAll('.item')
    document.querySelector('.slider').prepend(items[items.length - 1])
})

//university filter
const uniFilter =document.querySelector(".uni-filter"),
selectBtn = uniFilter.querySelector(".select-btn"),
searchInput = uniFilter.querySelector("input"),
uniResetBtn = uniFilter.querySelector(".uni-reset-btn");
uniFilterOptions= uniFilter.querySelector(".uni-filter-options");


let universities = ["University of Colombo","University of Moratuwa", "University of Sri Jayawardenapura", "University of Ruhuna", "University of Jaffna", "SLIIT", "IIT", "KDU"];


function addUniversity(selectedUniversity){
    uniFilterOptions.innerHTML= "";
    universities.forEach(university=> {
        //if selected university and university value is asame then add selected class
        let isSelected = university == selectedUniversity ? "selected" : "";
        //adding each university inside li and inserting all li inside uni-filter-options
        let li = `<li onclick="updateName(this)" class="${isSelected}"> ${university} </li>`;
        uniFilterOptions.insertAdjacentHTML("beforeend", li);
    });
}
addUniversity();

function updateName(selectedLi){
    searchInput.value= "";
    addUniversity(selectedLi.innerText);
    uniFilter.classList.remove("uni-filter-active");
    selectBtn.firstElementChild.innerText = selectedLi.innerText;
}
searchInput.addEventListener("keyup", ()=>{
    // console.log(searchInput.value);
    let arr =[]; //creating empty array
    let searchedVal= searchInput.value.toLowerCase();
    //returning all universities from array which are start with user search value
    //and mapping returned university with li and joining them
    arr = universities.filter(data=>{
        return data.toLowerCase().startsWith(searchedVal);
    }).map(data=>
        `<li onclick="updateName(this)" > ${data} </li>`
    ).join("");
    console.log(arr);
    uniFilterOptions.innerHTML = arr ? arr : `<p>Oops! University not found</p>`;
})

selectBtn.addEventListener("click", () => {
    uniFilter.classList.toggle("uni-filter-active");
});

uniResetBtn.addEventListener("click", () => {
    searchInput.value= "";
    addUniversity();
    uniFilter.classList.remove("uni-filter-active");
    selectBtn.firstElementChild.innerText = `Select University`;
});
//university filter

//category filter
const categoryFilter = document.querySelector(".category-filter"),
    selectBtnCategory = categoryFilter.querySelector(".select-btn"),
    categoryResetBtn = categoryFilter.querySelector(".reset-btn"),
    categoryFilterOptions = categoryFilter.querySelector(".category-filter-options");

let categories = ["Academics", "Community Service", "Media", "Multi Cultural", "Sports", "Performing Arts", "Religious", "Other"];

function addCategories() {
    const categoryCheckboxes = categoryFilterOptions.querySelector(".category-checkboxes");
    categories.forEach(category => {
        let listItem = `<li><label><input type="checkbox" value="${category}" onclick="updateCategories()">${category}</label></li>`;
        categoryCheckboxes.insertAdjacentHTML("beforeend", listItem);
    });
}

addCategories();

function updateCategories() {
    let selectedCategories = Array.from(categoryFilterOptions.querySelectorAll('input:checked')).map(checkbox => checkbox.value);
    selectBtnCategory.firstElementChild.innerText = selectedCategories.length > 0 ? selectedCategories.join(", ") : "Select Category";
}

selectBtnCategory.addEventListener("click", () => {
    categoryFilter.classList.toggle("category-filter-active");
});

categoryResetBtn.addEventListener("click", () => {
    categoryFilterOptions.querySelectorAll('input:checked').forEach(checkbox => checkbox.checked = false);
    selectBtnCategory.firstElementChild.innerText = "Select Category";
    categoryFilter.classList.remove("category-filter-active");
});
//category filter

//membership number
const counts = document.querySelectorAll('.number')
const speed = 97

counts.forEach((counter) => {
    function upData() {
        const target = Number(counter.getAttribute('.m-number'))
        const count = Number(counter.innerText)
        const inc = target / speed
        if (count < target) {
            counter.innerText = Math.floor(inc + count)
            setTimeout(upData,1)
        }
        else {
            counter.innerText = target
        }
    }
    upData()
})
//membership number