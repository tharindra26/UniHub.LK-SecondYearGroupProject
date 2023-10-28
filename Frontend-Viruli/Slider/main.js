const material_slider = document.querySelector(".material-slider");
const carousel = document.querySelector(".carousel");
const arrowBtns = document.querySelectorAll(".material-slider i");
const firstCardWidth = carousel.querySelector(".card").offsetWidth;


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
    // AUtoplay the carousel after every 2500 ms
    timeoutId = setTimeout(() => carousel.scrollLeft += firstCardWidth, 2500);
}

autoPlay();

//Clear existing timeout and start autoplay if mouse is not hovering over carousel
clearTimeout(timeoutId);
if(!material_slider.matches(":hover")) autoPlay();

carousel.addEventListener("mousedown", dragStart);
carousel.addEventListener("mousemove", dragging);
carousel.addEventListener("mouseup", dragStop);
material_slider.addEventListener("mouseenter", () => clearTimeout(timeoutId));
material_slider.addEventListener("mouseleave", autoPlay);

