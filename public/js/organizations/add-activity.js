const activityImageUpload = document.getElementById("activityImageUpload"), //original button
  customActivityImgBtn = document.getElementById("custom-activity-img-btn"), //duplicate button view for us
  activityImgTxt = document.getElementById("activity-img-txt");

customActivityImgBtn.addEventListener("click", function () {
  activityImageUpload.click();
});

activityImageUpload.addEventListener("change", function () {
  var fileInput = this;

  if (fileInput.files && fileInput.files[0]) {
    // Display the file name when an image is chosen
    activityImgTxt.innerHTML = "File chosen: " + fileInput.files[0].name;
  }

});