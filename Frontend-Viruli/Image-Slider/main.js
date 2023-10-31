let slider = document.querySelector('.slider');
let list = document.querySelector('.slider .list');
const firstCardWidth = slider.querySelector(".item").offsetWidth;
let items = document.querySelectorAll('.slider .list .item');
let dots = document.querySelectorAll('.slider .dots li');

items = Array.from(items);

let active = 0;
let lengthItems = items.length - 1;
let refreshSlider;

let imagePreview = Math.round(slider.offsetWidth / firstCardWidth);

items.slice(-imagePreview).reverse().forEach(item => {
    let newItem = document.createElement('div');
    newItem.className = 'item';
    newItem.innerHTML = item.innerHTML;
    list.insertAdjacentElement("afterbegin", newItem);
});

items.slice(0, imagePreview).reverse().forEach(item => {
    let newItem = document.createElement('div');
    newItem.className = 'item';
    newItem.innerHTML = item.innerHTML;
    list.insertAdjacentElement("beforeend", newItem);
});

function next() {
    active = (active + 1) % items.length;
    reloadSlider();
}

function reloadSlider(){
    let checkLeft = items[active].offsetLeft;
    list.style.left = -checkLeft + 'px';
    
    let lastActiveDot = document.querySelector('.slider .dots li.active');
    lastActiveDot.classList.remove('active');
    dots[active].classList.add('active');
    //clearInterval(refreshSlider);
    //refreshSlider = setInterval(() => {next.click()}, 3000);
}

dots.forEach((li, key) => {
    li.addEventListener('click', function(){
        active = key;
        reloadSlider();
    })
})

refreshSlider = setInterval(next, 3000);

// Add an event listener to stop the slider when the user hovers over it
list.addEventListener('mouseenter', function () {
    clearInterval(refreshSlider);
});

// Add an event listener to resume the slider when the user leaves the slider
list.addEventListener('mouseleave', function () {
    refreshSlider = setInterval(next, 3000);
});

const infiniteScroll = () => {
    if(slider.scrollLeft == 0){
        slider.classList.add("no-transition");
        slider.scrollLeft = slider.scrollWidth - (2 * slider.offsetWidth);
        slider.classList.remove("no-transition");
    }
    else if(slider.scrollLeft == slider.scrollWidth - slider.offsetWidth){
        slider.classList.add("no-transition");
        slider.scrollLeft = slider.offsetWidth;
        slider.classList.remove("no-transition");
    }
}

slider.addEventListener("scroll", infiniteScroll);