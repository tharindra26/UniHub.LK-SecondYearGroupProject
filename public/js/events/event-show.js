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
            url: 'http://localhost/unihub/events/checkEventParticipation',
            type: 'POST',
            data: {
                
            },
            success: function (response) {
                // Handle the success response
                console.log("Check Event Participation - AJAX request successful:", response);

                var interestedBtn = $("#interested-btn-id");

                if (response === '1') {
                    interestedBtn.addClass("new-class");
                } else {
                    interestedBtn.removeClass("new-class");
                }
            },
            error: function (xhr, status, error) {
                // Handle the error response
                console.error("Check Event Participation - AJAX request failed:", status, error);
            }
        });
    }
    });



    

    

    
    
    

