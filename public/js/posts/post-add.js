const profileImageUpload = document.getElementById("profileImageUpload"), //original button
  customProfileImgBtn = document.getElementById("custom-profile-img-btn"), //duplicate button view for us
  profileImgTxt = document.getElementById("profile-img-txt");

customProfileImgBtn.addEventListener("click", function () {
  profileImageUpload.click();
});


profileImageUpload.addEventListener("change", function () {
  var fileInput = this;

  if (fileInput.files && fileInput.files[0]) {
    // Display the file name when an image is chosen
    profileImgTxt.innerHTML = "File chosen: " + fileInput.files[0].name;
  }
});