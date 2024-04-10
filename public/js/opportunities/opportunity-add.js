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



const coverImageUpload = document.getElementById("coverImageUpload"), //original button
  customCoverImgBtn = document.getElementById("custom-cover-img-btn"), //duplicate button view for us
  coverImgTxt = document.getElementById("cover-img-txt");

customCoverImgBtn.addEventListener("click", function () {
  coverImageUpload.click();
});

coverImageUpload.addEventListener("change", function () {
  var fileInput = this;

  if (fileInput.files && fileInput.files[0]) {
    // Display the file name when an image is chosen
    coverImgTxt.innerHTML = "File chosen: " + fileInput.files[0].name;
  }
});

const descriptionImageUpload = document.getElementById("descriptionImageUpload"), //original button
  customDescriptionImgBtn = document.getElementById("custom-description-img-btn"), //duplicate button view for us
  descriptionImgTxt = document.getElementById("description-img-txt");

customDescriptionImgBtn.addEventListener("click", function () {
  descriptionImageUpload.click();
});

descriptionImageUpload.addEventListener("change", function () {
  var fileInput = this;

  if (fileInput.files && fileInput.files[0]) {
    // Display the file name when an image is chosen
    descriptionImgTxt.innerHTML = "File chosen: " + fileInput.files[0].name;
  }
});