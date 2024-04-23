const overlay = document.querySelector(".overlay");
const modalBox = document.querySelector(".modal-box");

function openPopup(eventId) {
  let element = document.getElementById(eventId);
  if (element) {
    element.classList.add("active");
    overlay.classList.add("active");
  }
}

function closePopup(eventId) {
  let element = document.getElementById(eventId);
  if (element) {
    element.classList.remove("active");
    overlay.classList.remove("active");
  }
}
overlay.addEventListener("click", () => {
  modalBox.classList.remove("active");
  overlay.classList.remove("active");
});

function confirmDeactivate(eventId) {
    let confirmBtn = document.getElementById(eventId);
    // // Your AJAX function here
    $.ajax({
      url: "http://localhost/unihub/organizations/deactivateEvent",
      type: "POST", // or 'GET' depending on your needs
      data: {
        event_id: eventId,
      },
      success: function (response) {
        // Handle the success response
        console.log("AJAX request successful:", response);
        if (response === "1") {
            closePopup(eventId);
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
  
  function confirmActivate(eventId) {
    let confirmBtn = document.getElementById(eventId);
    // // Your AJAX function here
    $.ajax({
      url: "http://localhost/unihub/events/activateEvent",
      type: "POST", // or 'GET' depending on your needs
      data: {
        event_id: eventId,
      },
      success: function (response) {
        // Handle the success response
        console.log("AJAX request successful:", response);
  
        if (response === "1") {
            closePopup(eventId);
        }
      },
      error: function (error) {
        // Handle the error response
        console.error("AJAX request failed:", error);
      },
    });
    // if (popup) popup.classList.remove("open-popup");
  }