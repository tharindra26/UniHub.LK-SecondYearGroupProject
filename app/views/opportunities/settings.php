<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/opportunities/settings_style.css">

<div class="container">
    <div class="inner-container">
        <div class="settings-text">
            <p>Manage Opportunity Profile</p>
        </div>
        <div class="bottom-part">
            <div class="options-box">

                <a href="<?php echo URLROOT ?>/opportunities/updateOpportunity/<?php echo $data['id'] ?>"
                    class="option-link">
                    <div class="option">
                        <div class="option-icon">
                            <i class="fa-solid fa-wrench"></i>
                        </div>
                        <div class="option-text">Update Opportunity Profile</div>
                    </div>
                </a>


                <a href="#" class="option-link " onclick="openPopup('delete-popup-<?php echo $data['id'] ?>')">
                    <div class="option delete-option" >
                        <div class="option-icon">
                            <i class="fa-regular fa-trash-can"></i>
                        </div>
                        <div class="option-text">Delete Opportunity</div>
                    </div>
                </a>
                <!-- popupModal -->
                <span class="overlay"></span>
                <div class="modal-box" id="delete-popup-<?php echo $data['id'] ?>">
                    <i class="fa-solid fa-trash-can"></i>
                    <h2>Delete Opportunity</h2>
                    <h3>Opportunity:
                        <?php echo $data['id'] ?>
                    </h3>

                    <div class="buttons">
                        <button class="close-btn"
                            onclick="deleteOpportunity(<?php echo $data['id'] ?>)">Ok,Delete</button>
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

<script>
    // Get the value inside the urlRootValue div
    var URLROOT = document.querySelector('.urlRootValue').textContent.trim();

    // popup modal script
    const overlay = document.querySelector(".overlay");
    const modalBox = document.querySelector(".modal-box");

    function openPopup(popupId) {
        console.log('Opening popup with ID:', popupId);
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



    // Function to handle the deletion of a announcement
    function deleteOpportunity(opportunityId) {
        // Send an AJAX request to the server to delete the category
        // alert("badu wada");
        $.ajax({
            type: 'POST',
            url: URLROOT + '/opportunities/deleteOpportunity', // Replace with the URL of your server-side script
            data: {
                opportunityId: opportunityId
            }, // Pass the ID of the category to delete
            success: function (response) {
                if (response == true) {
                    console.log('Opportunity deleted successfully');
                    closePopup('delete-popup-' + opportunityId);
                    setTimeout(function () {
                        window.location.href = URLROOT+'/opportunities/index';
                    }, 500); // 1000 milliseconds delay (1 second)
                }
            },
            error: function (xhr, status, error) {
                console.error('Error deleting announcement:', error);
            }
        });
    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/opportunities/settings.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>