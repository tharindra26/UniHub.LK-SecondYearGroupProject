const profileImageUpload = document. getElementById('profileImageUpload'),
customProfileImgBtn = document.getElementById('custom-profile-img-btn'),
profileImgTxt =document.getElementById('profile-img-txt');

customProfileImgBtn.addEventListener('click', function(){
    profileImageUpload.click();
})

// profileImageUpload.addEventListener("change", function(){
//     if(profileImageUpload.value){
//         profileImgTxt.innerHTML = profileImageUpload.value.split(/[\\\/]/).pop();
//     }else{
//         profileImageUpload.innerHTML = "No file chosen, yet.";
//     }
// });


profileImageUpload.addEventListener("change", function () {
    var fileInput = this;

    if (fileInput.files && fileInput.files[0]) {
        // Display the file name when an image is chosen
        profileImgTxt.innerHTML = "File chosen: " + fileInput.files[0].name;
    }

    // if (fileInput.files && fileInput.files[0]) {
    //     var reader = new FileReader();

    //     reader.onload = function (e) {
    //         var img = new Image();
    //         img.src = e.target.result;

    //         img.onload = function () {
    //             var aspectRatio = img.width / img.height;
    //             var allowedAspectRatio = 16 / 9; // Change this ratio according to your requirements

    //             if (Math.abs(aspectRatio - allowedAspectRatio) < 0.1) {
    //                 // Aspect ratio is within an acceptable range
    //                 profileImgTxt.innerHTML = "File chosen: " + fileInput.files[0].name;
    //             } else {
    //                 // Aspect ratio is not within the acceptable range
    //                 profileImgTxt.innerHTML = "Please choose an image with the correct aspect ratio.";
    //                 fileInput.value = ""; // Clear the file input
    //             }
    //         };
    //     };

    //     reader.readAsDataURL(fileInput.files[0]);
    // }
});