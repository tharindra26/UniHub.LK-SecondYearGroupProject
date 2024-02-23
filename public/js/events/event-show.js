// Get the value inside the urlRootValue div
var URLROOT = document.querySelector('.urlRootValue').textContent.trim();


//Read More section
const description = document.querySelector(".description");
description.addEventListener("click", (event) => {
  const current = event.target;

  const isReadMoreBtn = current.className.includes("read-more-btn");

  if (!isReadMoreBtn) return;

  const currentText = event.target.parentNode.querySelector(".read-more-text");

  currentText.classList.toggle("read-more-text--show");
  console.log(currentText.textContent.includes("Read More"));
  current.textContent = currentText.classList.contains("read-more-text--show")
    ? "Read Less"
    : "Read More";
});
//Read More section

$(document).ready(function () {
  function checkEventParticipation() {
    $.ajax({
      url: "http://localhost/unihub/events/checkEventParticipation",
      type: "POST",
      data: {},
      success: function (response) {
        // Handle the success response
        console.log(
          "Check Event Participation - AJAX request successful:",
          response
        );

        var interestedBtn = $("#interested-btn-id");

        if (response === "1") {
          interestedBtn.addClass("new-class");
        } else {
          interestedBtn.removeClass("new-class");
        }
      },
      error: function (xhr, status, error) {
        // Handle the error response
        console.error(
          "Check Event Participation - AJAX request failed:",
          status,
          error
        );
      },
    });
  }
});

// popup modal script
const overlay = document.querySelector(".overlay");
const modalBox = document.querySelector(".modal-box");

function openPopup(popupId) {
  var element = document.getElementById(popupId);
  if (element) {
    element.classList.add("active");
    overlay.classList.add("active");
  }
}

function closePopup(popupId) {
  var element = document.getElementById(popupId);
  if (element) {
    element.classList.remove("active");
    overlay.classList.remove("active");
  }
}
overlay.addEventListener("click", () => {
  modalBox.classList.remove("active");
  overlay.classList.remove("active");
});


//rating-system
const btn = document.querySelector(".btn");
const post = document.querySelector(".post");
const widget = document.querySelector(".star-widget");
const editBtn = document.querySelector(".edit");
const closeBtn = document.querySelector(".close-btn");

btn.onclick = () => {
  widget.style.display = "none";
  post.style.display = "flex";
  // closeBtn.onclick = () => {
  //   // widget.style.display = "block";
  //   // post.style.display = "none";
  //   return false;
  // };
};

//rating-system

function addReview(id) {
  // Retrieve the value of the selected star

  var rating = $("input[name='rate']:checked").length;

  // Retrieve the text entered in the textarea
  var comment = $(".textarea textarea").val();

  

  // Make the AJAX request
  $.ajax({
      url: URLROOT +"/events/addReview/"+id, // Replace 'YOUR_ENDPOINT_URL' with the actual URL to which you want to send the data
      type: "POST",
      data: {
          rating: rating,
          comment: comment,
      },
      success: function (response) {
          // Handle the success response here
          console.log("AJAX request successful:", response);
      },
      error: function (xhr, status, error) {
          // Handle the error response here
          console.error("AJAX request failed:", status, error);
      },
  });
}
