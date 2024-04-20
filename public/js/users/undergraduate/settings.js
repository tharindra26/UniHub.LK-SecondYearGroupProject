//Friend Requests handle
const overlay = document.querySelector(".overlay");

function openPopup(user_id) {
  let element = document.getElementById(user_id);
  if (element) {
    element.classList.add("active");
    overlay.classList.add("active");
  }
}

function closePopup(user_id) {
  let element = document.getElementById(user_id);
  if (element) {
    element.classList.remove("active");
    overlay.classList.remove("active");
  }
}
overlay.addEventListener("click", () => {
  const modalBox = document.querySelector(".modal-box.active");
  if (modalBox) {
    modalBox.classList.remove("active");
  }
  overlay.classList.remove("active");
});

function deleteAccount(user_id) {
    // // Your AJAX function here
    $.ajax({
      url: "http://localhost/unihub/users/deactivateUser",
      type: "POST", // or 'GET' depending on your needs
      data: {
        user_id: user_id, // Changed from friend_id to user_id
      },
      success: function (response) {
        // Handle the success response
        console.log("AJAX request successful:");
        if (response === "1") {
            closePopup(user_id);
            console.log("Ajax request successfull");
            
        }
      },
      error: function (error) {
        // Handle the error response
        console.error("AJAX request failed:", error);
      },
    });
    // if (popup) popup.classList.remove("open-popup");
}
