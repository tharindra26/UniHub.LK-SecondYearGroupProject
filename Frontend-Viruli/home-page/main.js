let slider = document.querySelector('.slider');
let list = document.querySelector('.slider .list');
const firstImgWidth = slider.querySelector(".item").offsetWidth;
let items = document.querySelectorAll('.slider .list .item');
let dots = document.querySelectorAll('.slider .dots li');
const material_slider = document.querySelector(".material-slider");
const carousel = document.querySelector(".carousel");
const arrowBtns = document.querySelectorAll(".material-slider i");
const firstCardWidth = carousel.querySelector(".card").offsetWidth;


items = Array.from(items);

let active = 0;
let lengthItems = items.length - 1;
let refreshSlider;

let imagePreview = Math.round(slider.offsetWidth / firstImgWidth);

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

refreshSlider = setInterval(next, 2500);

// Add an event listener to stop the slider when the user hovers over it
list.addEventListener('mouseenter', function () {
    clearInterval(refreshSlider);
});

// Add an event listener to resume the slider when the user leaves the slider
list.addEventListener('mouseleave', function () {
    refreshSlider = setInterval(next, 2500);
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




let isDragging = false, startX, startScrollLeft, timeoutId;

//Add event listeners for the arrow buttons to scroll the carousel left and right
arrowBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        carousel.scrollLeft += btn.id === "left" ? -firstCardWidth : firstCardWidth;
    })
}); 

const dragStart = (e) => {
    isDragging = true;
    carousel.classList.add("dragging");
    //Records the initial cursor and scroll position of the carousel
    startX = e.pageX;
    startScrollLeft = carousel.scrollLeft;
}

const dragging = (e) => {
    if(!isDragging) return; // if isDragging is false return from here
    // Update the scroll position of the carousel based on the cursor movement
    carousel.scrollLeft = startScrollLeft - (e.pageX - startX);
}

const dragStop = () => {
    isDragging = false;
    carousel.classList.remove("dragging");
}



const autoPlay = () => {
    // Autoplay the carousel after every 2500 ms
    timeoutId = setInterval(() => {
        carousel.scrollLeft += firstCardWidth;
    }, 2500);
}


autoPlay();

material_slider.addEventListener("mouseenter", () => {
    clearInterval(timeoutId);
});

material_slider.addEventListener("mouseleave", () => {
    autoPlay();
});



carousel.addEventListener("mousedown", dragStart);
carousel.addEventListener("mousemove", dragging);
carousel.addEventListener("mouseup", dragStop);
//material_slider.addEventListener("mouseenter", () => clearTimeout(timeoutId));
//material_slider.addEventListener("mouseleave", autoPlay);

