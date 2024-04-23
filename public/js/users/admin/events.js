// Counter starts
function initializeCount() {
    totalValue = document.querySelectorAll(".tot");
    let timeinterval = 200;

    totalValue.forEach((valueDisplay) => {
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

// filters======================================================================

// Get the value inside the urlRootValue div
//var URLROOT = document.querySelector('.urlRootValue').textContent.trim();

$(document).ready(function () {
  function updateContent() {
      var keyword = document.getElementById("search-bar-input").value;
      var university = document.querySelector('.select-uni select[name="university"]').value;
      var approval = document.querySelector('.option.filter select[name="approval"]').value;
      var status = document.querySelector('.option.filter select[name="status"]').value;

      // Send an AJAX request with the filter values
      $.ajax({
          url: "http://localhost/unihub/events/filterEvents",
          method: "POST",
          data: {
              keyword: keyword,
              university: university,
              approval: approval,
              status: status,
          },
          success: function (data) {
              // Update the content section with the retrieved data
              $("#events-filter-table").html(data);
          },
      });
  }

  // Attach keyup event listener to the search bar input
  document.getElementById("search-bar-input").addEventListener("keyup", updateContent);

  // Attach change event listeners to the select inputs
  document
    .getElementById("search-bar-input")
    .addEventListener("keyup", updateContent);

  // Attach change event listener to university input
  document
    .getElementById("uni-filter-value")
    .addEventListener("change", updateContent);

  document
    .getElementById("approval-filter-value")
    .addEventListener("change", updateContent);

  document
    .getElementById("status-filter-value")
    .addEventListener("change", updateContent);

  // Trigger the initial update when the page loads
  updateContent();

  function resetOtherFilters() {
    // Reset search input
    document.getElementById("search-bar-input").value = "";
    
    // Reset university filter to default
    document.getElementById("uni-filter-value").value = "";
    
    // Reset approval filter to default
    document.getElementById("approval-filter-value").value = "";
    
    // Reset status filter to default
    document.getElementById("status-filter-value").value = "";
}
});




//approval filter

  function selectData(approvalType){

    var keyword = document.getElementById("search-bar-input").value;
    var university = document.document.getElementById("uni-filter-value").value;
    //var approval = document.getElementById("approval-filter-value").value;
    var status = document.getElementById("status-filter-value").value;

    $.ajax({
      url: "http://localhost/unihub/events/filterEvents",
      //url: URLROOT +"/events/searchEvents",
      method: "POST",
      data: {
        keyword: keyword,
        university: university,
        approval: approvalType,
        status: status,
      },
      success: function (data) {
        // Update the content section with the retrieved data
        $("#events-filter-table").html(data);
      },
    });

    updateContent();
  }
  
 
//approval filter

//status filter
function selectUni(uni_id){

  var keyword = document.getElementById("search-bar-input").value;
  //var university = document.document.getElementById("uni-filter-value").value;
  var approval = document.getElementById("approval-filter-value").value;
  var status = document.getElementById("status-filter-value").value;

  $.ajax({
    url: "http://localhost/unihub/events/filterEvents",
    //url: URLROOT +"/events/searchEvents",
    method: "POST",
    data: {
      keyword: keyword,
      university: uni_id,
      approval: approval,
      status: status,
    },
    success: function (data) {
      // Update the content section with the retrieved data
      $("#events-filter-table").html(data);
    },
  });
  updateContent();
}
//status filter

//status filter
function selectStatus(status){
  var keyword = document.getElementById("search-bar-input").value;
  var university = document.document.getElementById("uni-filter-value").value;
  var approval = document.getElementById("approval-filter-value").value;
  //var status = document.getElementById("status-filter-value").value;

  $.ajax({
    url: "http://localhost/unihub/events/filterEvents",
    //url: URLROOT +"/events/searchEvents",
    method: "POST",
    data: {
      keyword: keyword,
      university: university,
      approval: approval,
      status: status,
    },
    success: function (data) {
      // Update the content section with the retrieved data
      $("#events-filter-table").html(data);
    },
  });
  updateContent();
}
//status filter

//Main Event filter

// Function to reset other filters to default values
function resetOtherFilters() {
  // Reset search input
  document.getElementById("search-bar-input").value = "";
  
  // Reset university filter to default
  document.getElementById("uni-filter-value").value = "";
  
  // Reset approval filter to default
  document.getElementById("approval-filter-value").value = "";
  
  // Reset status filter to default
  document.getElementById("status-filter-value").value = "";
}

//Main Event filter
function mainEventFilter(type) {
  // Reset other filters to default values
  resetOtherFilters();
  // Make AJAX request with the selected filter type
  $.ajax({
      url: "http://localhost/unihub/events/dueEventsFilterilter",
      type: "POST",
      data: {
          value: type,
      },
      success: function (response) {
          // Update the content section with the retrieved data
          $("#events-filter-table").html(response);
      },
      error: function (error) {
          console.error("Error:", error);
      },
  });

updateContent();
}

//Main Event filter



