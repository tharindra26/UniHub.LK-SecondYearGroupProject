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



const boardImageUpload = document.getElementById("boardImageUpload"), //original button
  customBoardImgBtn = document.getElementById("custom-board-img-btn"), //duplicate button view for us
  boardImgTxt = document.getElementById("board-img-txt");

customBoardImgBtn.addEventListener("click", function () {
  coverImageUpload.click();
});

boardImageUpload.addEventListener("change", function () {
  var fileInput = this;

  if (fileInput.files && fileInput.files[0]) {
    // Display the file name when an image is chosen
    boardImgTxt.innerHTML = "File chosen: " + fileInput.files[0].name;
  }
});

