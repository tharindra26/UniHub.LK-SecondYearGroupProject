//university filter
const uniFilter =document.querySelector(".uni-filter"),
selectBtn = uniFilter.querySelector(".select-btn"),
searchInput = uniFilter.querySelector("input"),
uniResetBtn = uniFilter.querySelector(".uni-reset-btnuni-reset-btn");
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
const categorySelectBtn = document.querySelector(".category-select-btn"),
items = document.querySelectorAll(".item"),
categoryResetBtn= document.querySelector(".category-reset-btn");

categorySelectBtn.addEventListener("click", () => {
    categorySelectBtn.classList.toggle("category-filter-active");
});

items.forEach(item => {
    item.addEventListener("click", () => {
        item.classList.toggle("category-checked");

        let checked =document.querySelectorAll(".category-checked"),
        categoryBtnText = document.querySelector(".category-btn-txt");

        if(checked && checked.length > 0) {
            categoryBtnText.innerText = `${checked.length} Categories Selected`;
        }else{
            categoryBtnText.innerText = `Select Category`;
        }

    });
    
});

categoryResetBtn.addEventListener("click", () => {
    items.forEach(item => {
        item.classList.remove("category-checked");
    });

    // Reset the category button text
    document.querySelector(".category-btn-txt").innerText = `Select Category`;
});
//category filter