//university filter
const uniFilter =document.querySelector(".uni-filter"),
selectBtn = uniFilter.querySelector(".select-btn"),
searchInput = uniFilter.querySelector("input"),
uniFilterOptions= uniFilter.querySelector(".uni-filter-options");


let universities = ["Colombo","Moratuwa", "Jaffna", "SLIIT", "IIT", "UWU", "KDU", "USJP"];


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
//university filter

//category filter
const categorySelectBtn = document.querySelector(".category-select-btn"),
items = document.querySelectorAll(".item");

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
//category filter