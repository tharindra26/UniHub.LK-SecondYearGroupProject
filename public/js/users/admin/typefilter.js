  
  function updateUser(confirm) {
    // // Your AJAX function here
    $.ajax({
      url: "http://localhost/unihub/users/updateUser",
      type: "POST", // or 'GET' depending on your needs
      data: {
        user_id: confirm,
      },
      success: function (response) {
        // Handle the success response
        //console.log("AJAX request successful:", response);
  
        $("#main-id").html(response);
      },
      error: function (error) {
        // Handle the error response
        console.error("AJAX request failed:", error);
      },
    });
    // if (popup) popup.classList.remove("open-popup");
  }