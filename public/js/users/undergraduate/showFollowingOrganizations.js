const overlay = document.querySelector(".overlay");
const modalBox = document.querySelector(".modal-box");

function openPopup(orgId) {
  let element = document.getElementById(orgId);
  if (element) {
    element.classList.add("active");
    overlay.classList.add("active");
  }
}

function closePopup(orgId) {
  let element = document.getElementById(orgId);
  if (element) {
    element.classList.remove("active");
    overlay.classList.remove("active");
  }
}
overlay.addEventListener("click", () => {
  modalBox.classList.remove("active");
  overlay.classList.remove("active");
});
//popup

function confirmDelete(orgId) {
    // // Your AJAX function here
    $.ajax({
      url: "http://localhost/unihub/users/removeFollowingOrganization",
      type: "POST", // or 'GET' depending on your needs
      data: {
        id: orgId,
      },
      success: function (response) {
        // Handle the success response
        console.log("AJAX request successful:", response);
  
        // Update the text content on success
        // interestedBtn.find('span').text(response);
        if (response === "1") {
            // let element = document.getElementById(edu_id);
            closePopup(orgId);
        }
        //else {
        //     confirmBtn.addClass("new-class");
        // }
      },
      error: function (error) {
        // Handle the error response
        console.error("AJAX request failed:", error);
      },
    });
    // if (popup) popup.classList.remove("open-popup");
  }