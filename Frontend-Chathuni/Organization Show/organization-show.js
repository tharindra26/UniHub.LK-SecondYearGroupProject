// university filter
const uniFilter = document.querySelector(".uni-filter"),
    selectBtn = uniFilter.querySelector(".select-btn"),
    searchInput = uniFilter.querySelector("input"),
    uniResetBtn = uniFilter.querySelector(".reset-btn"),
    uniFilterOptions = uniFilter.querySelector(".uni-filter-options");

let universities = ["University of Colombo", "University of Moratuwa", "University of Sri Jayawardenapura", "University of Ruhuna", "University of Jaffna", "SLIIT", "IIT", "KDU"];

function addUniversity(selectedUniversity) {
    uniFilterOptions.innerHTML = "";
    universities.forEach(university => {
        let isSelected = university == selectedUniversity ? "selected" : "";
        let li = `<li onclick="updateName(this)" class="${isSelected}"> ${university} </li>`;
        uniFilterOptions.insertAdjacentHTML("beforeend", li);
    });
}
addUniversity();

function updateName(selectedLi) {
    searchInput.value = "";
    addUniversity(selectedLi.innerText);
    uniFilter.classList.remove("uni-filter-active");
    selectBtn.firstElementChild.innerText = selectedLi.innerText;
}

searchInput.addEventListener("keyup", () => {
    let arr = [];
    let searchedVal = searchInput.value.toLowerCase();
    arr = universities.filter(data => {
        return data.toLowerCase().startsWith(searchedVal);
    }).map(data =>
        `<li onclick="updateName(this)" > ${data} </li>`
    ).join("");
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
});
// university filter

// category filter
const categorySelectBtn = document.querySelector(".category-select-btn"),
    items = document.querySelectorAll(".item"),
    categoryResetBtn = document.querySelector(".category-reset-btn");

categorySelectBtn.addEventListener("click", () => {
    categorySelectBtn.classList.toggle("category-filter-active");
});

items.forEach(item => {
    item.addEventListener("click", () => {
        item.classList.toggle("category-checked");

        let checked = document.querySelectorAll(".category-checked"),
            categoryBtnText = categorySelectBtn.querySelector(".btn-txt");

        if (checked && checked.length > 0) {
            categoryBtnText.innerText = `${checked.length} Categories Selected`;
        } else {
            categoryBtnText.innerText = `Select Category`;
        }

    });

});

categoryResetBtn.addEventListener("click", () => {
    items.forEach(item => {
        item.classList.remove("category-checked");
    });

    // Reset the category button text
    categorySelectBtn.querySelector(".btn-txt").innerText = `Select Category`;
});
// category filter