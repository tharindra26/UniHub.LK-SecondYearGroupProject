//Start About Section See more option
const parentContainer = document.querySelector('.about');

parentContainer.addEventListener('click', event => {
    const current = event.target;

    const isSeeMoreBtn = current.className.includes('see-more-btn');

    if(!isSeeMoreBtn) return;

    const currentText = event.target.parentNode.querySelector('.see-more-text');

    currentText.classList.toggle('see-more-text--show');

    current.textContent = current.textContent.includes('See more') ?
    "See less..." : "See more...";
})
// End About Section See more option

//Added event slider js starts

const carousel = document.querySelector('.carousel');
const arrowBtns = document.querySelectorAll('.wrapper i');
const firstCardWidth = carousel.querySelector(".card").offsetWidth;

let isDragging = false, startX, startScrollLeft;

//Add event listeners for the arrow buttons to scroll the carousel left and right
arrowBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        carousel.scrollLeft += btn.id === "left" ? - firstCardWidth : firstCardWidth;
    })
});

const dragStart = () => {
    isDragging = true;
    carousel.classList.add("dragging");
    //Records the initial cursor and scroll position position of the carousel
    startX = e.pageX; //not working
    startScrollLeft = carousel.scrollLeft; //not working
}

const dragging = (e) => {
    if(!isDragging) return; // if isDragging is false return from here.
    //Updates the scroll position of the carousel based on the cursor movement
    carousel.scrollLeft = startScrollLeft - (e.pageX - startX); //not working
}

const dragStop = () => {
    isDragging = false;
    carousel.classList.remove("dragging");
}

carousel.addEventListener("mousedown", dragStart);
carousel.addEventListener("mousemove", dragging);
document.addEventListener("mouseup", dragStop);

//Added event slider js starts