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

// const carousel = document.querySelector('.carousel');
// const arrowBtns = document.querySelectorAll('.wrapper i');
// const firstCardWidth = carousel.querySelector(".card").offsetWidth;

// let isDragging = false, startX, startScrollLeft;

// //Add event listeners for the arrow buttons to scroll the carousel left and right
// arrowBtns.forEach(btn => {
//     btn.addEventListener("click", () => {
//         carousel.scrollLeft += btn.id === "left" ? - firstCardWidth : firstCardWidth;
//     })
// });

// const dragStart = () => {
//     isDragging = true;
//     carousel.classList.add("dragging");
//     //Records the initial cursor and scroll position position of the carousel
//     startX = e.pageX; //not working
//     startScrollLeft = carousel.scrollLeft; //not working
// }

// const dragging = (e) => {
//     if(!isDragging) return; // if isDragging is false return from here.
//     //Updates the scroll position of the carousel based on the cursor movement
//     carousel.scrollLeft = startScrollLeft - (e.pageX - startX); //not working
// }

// const dragStop = () => {
//     isDragging = false;
//     carousel.classList.remove("dragging");
// }

// carousel.addEventListener("mousedown", dragStart);
// carousel.addEventListener("mousemove", dragging);
// document.addEventListener("mouseup", dragStop);

// //Added event slider js ends

//Friend Requests handle
const overlay = document.querySelector(".overlay");
const modalBox = document.querySelector(".modal-box");

function openPopup(friend_id) {
  let element = document.getElementById(friend_id);
  if (element) {
    element.classList.add("active");
    overlay.classList.add("active");
  }
}

function closePopup(friend_id) {
  let element = document.getElementById(friend_id);
  if (element) {
    element.classList.remove("active");
    overlay.classList.remove("active");
  }
  setTimeout(function () {
    window.location.reload();
}, 500);
}
overlay.addEventListener("click", () => {
  modalBox.classList.remove("active");
  overlay.classList.remove("active");
});

function acceptRequest(friend_id) {
    // // Your AJAX function here
    $.ajax({
      url: "http://localhost/unihub/users/acceptRequest",
      type: "POST", // or 'GET' depending on your needs
      data: {
        follower_relationship_id: friend_id,
      },
      success: function (response) {
        // Handle the success response
        console.log("AJAX request successful:", response);
        if (response === "1") {
            // let element = document.getElementById(edu_id);
            openPopup(friend_id);
        }
      },
      error: function (error) {
        // Handle the error response
        console.error("AJAX request failed:", error);
      },
    });
    // if (popup) popup.classList.remove("open-popup");
  }


function rejectRequest(friend_id,popup_id) {
    // // Your AJAX function here
    $.ajax({
      url: "http://localhost/unihub/users/rejectRequest",
      type: "POST", // or 'GET' depending on your needs
      data: {
        follower_relationship_id: friend_id,
      },
      success: function (response) {
        // Handle the success response
        console.log("AJAX request successful:", response);

        if (response === "1") {
            closePopup(popup_id);
        }
       
      },
      error: function (error) {
        // Handle the error response
        console.error("AJAX request failed:", error);
      },
    });
    // if (popup) popup.classList.remove("open-popup");
  }
