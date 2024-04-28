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


// dynamically uploaded images uploading functions

// Function to update profile image preview
function updateProfileImagePreview(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
          $('.profile-img-box img').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
  }
}

// Function to update cover image preview
function updateCoverImagePreview(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
          $('.cover-img-box img').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
  }
}

// Trigger updateProfileImagePreview function when profile image input changes
$('#profileImageUpload').change(function() {
  updateProfileImagePreview(this);
});

// Trigger updateCoverImagePreview function when cover image input changes
$('#coverImageUpload').change(function() {
  updateCoverImagePreview(this);
});
