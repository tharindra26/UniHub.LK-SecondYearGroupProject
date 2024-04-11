// Get the value inside the urlRootValue div
var URLROOT = document.querySelector(".urlRootValue").textContent.trim();

$(document).ready(function () {
  function updateContent() {
    var keyword = document.getElementById("search-bar-input").value;

    // Send an AJAX request with the filter value
    $.ajax({
      // url: "http://localhost/unihub/events/searchEvents",
      url: URLROOT + "/opportunities/searchOpportunities",
      method: "POST",
      data: {
        keyword: keyword,
      },
      success: function (data) {
        // Update the content section with the retrieved data
        $("#content-section").html(data);
        console.log(data);
      },
    });
  }
  updateContent();

  // Attach keyup event listener to the search bar input
  document
    .getElementById("search-bar-input")
    .addEventListener("keyup", updateContent);
});
