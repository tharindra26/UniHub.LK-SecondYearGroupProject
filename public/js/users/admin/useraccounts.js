// Counter starts
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
  function openPopup(popupId){
    let popup = document.getElementById(popupId);
    if (popup) popup.classList.add("open-popup");
}

function closePopup(popupId){
    let popup = document.getElementById(popupId);
    if (popup) popup.classList.remove("open-popup");
}

