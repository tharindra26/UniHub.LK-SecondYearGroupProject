const uniFilter =document.querySelector(".uni-filter"),
selectBtn = uniFilter.querySelector(".select-btn");

selectBtn.addEventListener("click", () => {
    uniFilter.classList.toggle("uni-filter-active");
});