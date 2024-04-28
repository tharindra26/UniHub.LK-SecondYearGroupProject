<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/organizations/settings_style.css">

<div class="container">
    <div class="inner-container">
        <div class="settings-text">
            <p>Manage Organization</p>
        </div>
        <div class="bottom-part">
            <div class="options-box">

                <a href="<?php echo URLROOT ?>/organizations/editGeneralDetails/<?php echo $data['id'] ?>"
                    class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-gears"></i>
                        </div>
                        <div class="option-text">General Details</div>
                    </div>
                </a>

                <a href="<?php echo URLROOT ?>/organizations/editProfileImage/<?php echo $data['id'] ?>"
                    class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-regular fa-images"></i>
                        </div>
                        <div class="option-text">Profile Image ,Cover Image & Board Members</div>
                    </div>
                </a>


                <a href="<?php echo URLROOT ?>/organizations/editSocialMedia/<?php echo $data['id'] ?>"
                    class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-link"></i>
                        </div>
                        <div class="option-text">Social Media Handles</div>
                    </div>
                </a>


                <a href="<?php echo URLROOT ?>/organizations/changeOrganizationCategories/<?php echo $data['id'] ?>"
                    class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-table-list"></i>
                        </div>
                        <div class="option-text">Organization Categories</div>
                    </div>
                </a>

                <a href="<?php echo URLROOT ?>/organizations/addActivity/<?php echo $data['id'] ?>" class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-hand-holding-heart"></i>
                        </div>
                        <div class="option-text">Add Activity</div>
                    </div>
                </a>

                <a href="<?php echo URLROOT ?>/organizations/addNews/<?php echo $data['id'] ?>" class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-newspaper"></i>
                        </div>
                        <div class="option-text">Add News</div>
                    </div>
                </a>

                <a href="#" class="option-link " onclick="openPopup('activation-popup-<?php echo $data['id'] ?>')">
                    <div class="activation-option <?php if ($data['organization']->status == 0)
                        echo 'deactivated'; ?>">
                        <div class="option-icon">
                            <i class="fa-solid fa-toggle-off"></i>
                        </div>
                        <div class="option-text">
                            <?php if ($data['organization']->status == 0)
                                echo 'Activate Organization';
                            else
                                echo 'Deactivate Organization'; ?>
                        </div>
                    </div>
                </a>

                <!-- popupModal -->
                <span class="overlay"></span>
                <div class="modal-box" id="activation-popup-<?php echo $data['id'] ?>">
                    <i class="fa-solid fa-toggle-off"></i>
                    <h2><?php if ($data['organization']->status == 0)
                        echo 'Activate Organization';
                    else
                        echo 'Deactivate Organization'; ?>
                    </h2>
                    <h3>Organization:
                        <?php echo $data['organization']->organization_name ?>
                    </h3>

                    <div class="buttons">
                        <button class="close-btn" onclick="changeActivation(<?php echo $data['id'] ?>)"><?php if ($data['organization']->status == 0)
                               echo 'Activate';
                           else
                               echo 'Deactivate'; ?></button>
                    </div>
                </div>
                <!-- popupModal -->



            </div>
            <div class="image-box">
                <img src="<?php echo URLROOT ?>/img/events/settings/settings.jpg" alt="">
            </div>
        </div>

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/organizations/settings.js"></script>
<script>
    // Get the value inside the urlRootValue div
    var URLROOT = document.querySelector('.urlRootValue').textContent.trim();

    // popup modal script
    const overlay = document.querySelector(".overlay");
    const modalBox = document.querySelector(".modal-box");

    function openPopup(popupId) {
        var element = document.getElementById(popupId);
        if (element) {
            element.classList.add("active");
            overlay.classList.add("active");
        }
    }

    function closePopup(popupId) {
        var element = document.getElementById(popupId);
        if (element) {
            element.classList.remove("active");
            overlay.classList.remove("active");
        }
    }
    overlay.addEventListener("click", () => {
        modalBox.classList.remove("active");
        overlay.classList.remove("active");
    });

    // popup modal script
    function changeActivation(organizationId) {
        // Send an AJAX request to the server to delete the category
        alert(organizationId);
        $.ajax({
            type: 'POST',
            url: URLROOT + '/organizations/changeActivation', // Replace with the URL of your server-side script
            data: {
                organizationId: organizationId
            }, // Pass the ID of the category to delete
            success: function (response) {
                if (response == 'deactivated') {
                    console.log('Organization Deactivated successfully');
                    $('.activation-option').addClass('deactivated');
                    $('.activation-option .option-text').text('Activate Organization');
                    closePopup('activation-popup-' + organizationId);
                } else {
                    if (response == 'activated') {
                        console.log('Organization activated successfully');
                        $('.activation-option').removeClass('deactivated');
                        $('.activation-option .option-text').text('Deactivate Organization');
                        closePopup('activation-popup-' + organizationId);
                    }
                }
            },
            error: function (xhr, status, error) {
                console.error('Error deactivating organization:', error);
            }
        });
    }
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>