<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/updateuser_style.css">
        <div class="settings-text">
            <p>Manage User</p>
        </div>
        <div class="bottom-part">
            <div class="options-box">

                <a href="#" class="option-link" id="profile_image">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-regular fa-images"></i>
                        </div>
                        <div class="option-text">Profile Image & Cover Image</div>
                    </div>
                </a>


                <a href="#"
                    class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-address-card"></i>
                        </div>
                        <div class="option-text">Contact Details</div>
                    </div>
                </a>


                <a href="#" class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-brands fa-squarespace"></i>
                        </div>
                        <div class="option-text">Title</div>
                    </div>
                </a>

                <a href="#" class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-align-right"></i>
                        </div>
                        <div class="option-text">Description</div>
                    </div>
                </a>


                <a href="#" class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <div class="option-text">Type</div>
                    </div>
                </a>


                <a href="#" class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div class="option-text">Password Reset</div>
                    </div>
                </a>

            </div>
        </div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/users/admin/updateuser.js"></script>

<script>
        $(document).ready(function () {
        // Add click event to the button
        $("#profile_image").on("click", function (e) {
            console.log("Click");
            e.preventDefault(); // Prevent the default link behavior
            // // Your AJAX function here
            $.ajax({
                url: 'http://localhost/unihub/users/useraccounts',
                type: 'POST', // or 'GET' depending on your needs
                data: {
            
                },
                success: function (response) { //echo 1
                    console.log("AJAX request successful:", response);
                    $("#main-id").html(response);
                },
                error: function (error) {
                    // console.error("AJAX request failed:", error);
                }
            });
        });
        // checkEventParticipation();
    });

</script>