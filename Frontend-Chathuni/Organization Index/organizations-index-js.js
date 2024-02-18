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

(function(e){"use strict";e.fn.counterUp=function(t){var n=e.extend({time:400,delay:10},t);return this.each(function(){var t=e(this),r=n,i=function(){var e=[],n=r.time/r.delay,i=t.text(),s=/[0-9]+,[0-9]+/.test(i);i=i.replace(/,/g,"");var o=/^[0-9]+$/.test(i),u=/^[0-9]+\.[0-9]+$/.test(i),a=u?(i.split(".")[1]||[]).length:0;for(var f=n;f>=1;f--){var l=parseInt(i/n*f);u&&(l=parseFloat(i/n*f).toFixed(a));if(s)while(/(\d+)(\d{3})/.test(l.toString()))l=l.toString().replace(/(\d+)(\d{3})/,"$1,$2");e.unshift(l)}t.data("counterup-nums",e);t.text("0");var c=function(){t.text(t.data("counterup-nums").shift());if(t.data("counterup-nums").length)setTimeout(t.data("counterup-func"),r.delay);else{delete t.data("counterup-nums");t.data("counterup-nums",null);t.data("counterup-func",null)}};t.data("counterup-func",c);setTimeout(t.data("counterup-func"),r.delay)};t.waypoint(i,{offset:"100%",triggerOnce:!0})})}})(jQuery);
//membership number