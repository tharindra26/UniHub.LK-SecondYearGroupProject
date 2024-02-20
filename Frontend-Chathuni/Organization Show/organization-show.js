//social media section

// social media section

//recent events slider//
const initSlider = () => {
    const imageList = document.querySelector(".slider-wrapper .image-list");
    const slideButton = document.querySelectorAll(".slider-wrapper .slide-button");
    const sliderScrollbar = document.querySelector(".recent-events .slider-scrollbar");
    const scrollbarThumb = document.querySelector(".scrollbar-thumb");
    const maxScrollLeft = imageList.scrollWidth - imageList.clientWidth;

    //handle scrollbar thumb drag
    scrollbarThumb.addEventListener("mousedown", (e) => {
        const startX = e.clientX;
        const thumbPosition = scrollbarThumb.offsetLeft;

        //updtae the thumb position on mouse move
        const handleMouseMove = (e) => {
            const deltaX = e.clientX - startX;
            const newThumbPosition = thumbPosition + deltaX;
            const maxThumbposition = sliderScrollbar.getBoundingClientRect().width - scrollbarThumb.offsetWidth;

            const boudedPosition = Math.max(0, Math.min(maxThumbposition, newThumbPosition));
            const scrollPosition = (boudedPosition / maxThumbposition) * maxScrollLeft;

            scrollbarThumb.style.left = `${boudedPosition}px`;
            imageList.scrollLeft = scrollPosition;
        }

        //remove event listenerson the mouse up
        const handleMouseUp = () => {
            document.removeEventListener("mousemove", handleMouseMove);
            document.removeEventListener("mouseup", handleMouseUp);
        }

        //add event listeners for drag interaction
        document.addEventListener("mousemove", handleMouseMove);
        document.addEventListener("mouseup", handleMouseUp);
    });

    //slide images according to the slide button clicks
    slideButton.forEach(button => {
        button.addEventListener("click", () => {
            const direction = button.id === "prev-slide" ? -1 : 1;
            const scrollAmount = imageList.clientWidth * direction;
            imageList.scrollBy({ left: scrollAmount, behavior: "smooth" });
        });
    });

    const handleSlideButtons = () => {
        slideButton[0].style.display = imageList.scrollLeft <= 0 ? "none" : "block";
        slideButton[1].style.display = imageList.scrollLeft >= maxScrollLeft ? "none" : "block";
    }

    //update scrollbar thumb position based on image scroll
    const updateScrollThumbPosition = () => {
        const scrollPosition = imageList.scrollLeft;
        const thumbPosition = (scrollPosition / maxScrollLeft) * (sliderScrollbar.clientWidth - scrollbarThumb.offsetWidth);
        scrollbarThumb.style.left = `${thumbPosition}px`;
    }

    imageList.addEventListener("scroll", () => {
        handleSlideButtons();
        updateScrollThumbPosition();
    });
}

window.addEventListener("load", initSlider);
//recent events slider//