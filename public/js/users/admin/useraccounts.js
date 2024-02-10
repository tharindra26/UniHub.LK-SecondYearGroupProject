// Counter starts
function initializeCount(){
    let value = document.querySelectorAll(".num");
    let timeinterval = 1000;
    
    value.forEach((valueDisplay) => {
        let startValue = 0;
        let endValue = parseInt(valueDisplay.getAttribute("data-val"));
        let duration = Math.floor(timeinterval / endValue);
        let counter = setInterval(() => {
            startValue += 1;
            valueDisplay.textContent = startValue;
            if (startValue === endValue) {
                clearInterval(counter);
            }
        }, duration);
    });
}

initializeCount();
//Type filter
function typefilter(type) {
    // console.log(type);
  
    $.ajax({
      url: "http://localhost/unihub/users/typefilter",
      type: "POST", 
      data: {
  
        value: type,
  
      },
      success: function (response) {
       
        $("#main-id").html(response);
      },
      error: function (error) {
  
        console.error("Error:", error);
      },
    });
  }

//popup

function openPopup(confirm){
    let popup = document.getElementById(confirm);
    if (popup) popup.classList.add("open-popup");
}

function closePopup(confirm){
  let popup = document.getElementById(confirm);
  if (popup) popup.classList.remove("open-popup");
}

function confirmDeactivate(confirm){
    let confirmBtn = document.getElementById(confirm);
                // // Your AJAX function here
                $.ajax({
                  url: 'http://localhost/unihub/users/deactivateUser',
                  type: 'POST', // or 'GET' depending on your needs
                  data: {
                      user_id: confirm,
                  },
                  success: function (response) {
                      // Handle the success response
                      console.log("AJAX request successful:", response);
  
                      // Update the text content on success
                      // interestedBtn.find('span').text(response);   
                      if (response === '1') {
                        confirmBtn.classList.remove("open-popup")
                       } 
                      //else {
                      //     confirmBtn.addClass("new-class");
                      // }
  
  
                  },
                  error: function (error) {
                      // Handle the error response
                      console.error("AJAX request failed:", error);
                  }
              });
    // if (popup) popup.classList.remove("open-popup");
}

function confirmActivate(confirm){
  let confirmBtn = document.getElementById(confirm);
              // // Your AJAX function here
              $.ajax({
                url: 'http://localhost/unihub/users/activateUser',
                type: 'POST', // or 'GET' depending on your needs
                data: {
                    user_id: confirm,
                },
                success: function (response) {
                    // Handle the success response
                    console.log("AJAX request successful:", response);

                    // Update the text content on success
                    // interestedBtn.find('span').text(response);   
                    if (response === '1') {
                      confirmBtn.classList.remove("open-popup")
                     } 
                    //else {
                    //     confirmBtn.addClass("new-class");
                    // }


                },
                error: function (error) {
                    // Handle the error response
                    console.error("AJAX request failed:", error);
                }
            });
  // if (popup) popup.classList.remove("open-popup");
}

