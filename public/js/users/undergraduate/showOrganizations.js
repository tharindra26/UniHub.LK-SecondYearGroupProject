const overlay = document.querySelector(".overlay");
const modalBox = document.querySelector(".modal-box");

function openPopup(organization_id) {
  let element = document.getElementById(organization_id);
  if (element) {
    element.classList.add("active");
    overlay.classList.add("active");
  }
}

function closePopup(organization_id) {
  let element = document.getElementById(organization_id);
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
function addOrganization(user_id) {
  let element = document.getElementById(user_id);
  let overlay = document.querySelector(".overlay");
  // // Your AJAX function here
  $.ajax({
    url: "http://localhost/unihub/users/addOrganization",
    type: "POST", // or 'GET' depending on your needs
    data: {
      user_id: user_id,
    },
    success: function (response) {
      // Handle the success response
      console.log("AJAX request successful:", response);
          element.classList.add("active");
          overlay.classList.add("active");
      
    },
    error: function (error) {
      // Handle the error response
      console.error("AJAX request failed:", error);

    },
  });
  // if (popup) popup.classList.remove("open-popup");
}


function updateOrganization(organization_id) {
    let element = document.getElementById(organization_id);
    let overlay = document.querySelector(".overlay");
    // // Your AJAX function here
    $.ajax({
      url: "http://localhost/unihub/users/editOrganization",
      type: "POST", // or 'GET' depending on your needs
      data: {
        organization_id: organization_id,
      },
      success: function (response) {
        // Handle the success response
        console.log("AJAX request successful:", response);
            element.classList.add("active");
            overlay.classList.add("active");
        
      },
      error: function (error) {
        // Handle the error response
        console.error("AJAX request failed:", error);

      },
    });
    // if (popup) popup.classList.remove("open-popup");
  }

  function confirmDelete(organization_id) {
    // // Your AJAX function here
    $.ajax({
      url: "http://localhost/unihub/users/deleteOrganization",
      type: "POST", // or 'GET' depending on your needs
      data: {
        organization_id: organization_id,
      },
      success: function (response) {
        // Handle the success response
        console.log("AJAX request successful:", response);
  
        // Update the text content on success
        // interestedBtn.find('span').text(response);
        if (response === "1") {
            // let element = document.getElementById(edu_id);
            closePopup(organization_id);
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