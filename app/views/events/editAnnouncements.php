<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/events/editAnnouncements_style.css">



<div class="container">

    <div class="inner-container">
        <div class="title-text">
            <p>Event Announcements</p>
        </div>
        <div class="bottom-part">

            <div class="left-box">
                <div class="users" id="filter-table">
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>Announcements ID</th>
                                <th>Text</th>
                                <th class="action-field">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data['announcements'][0]->announcement_id)): ?>
                                <?php foreach ($data['announcements'] as $announcement):
                                    if (empty($announcement)):
                                        break;
                                    endif; ?>

                                    <tr>
                                        <td>
                                            <?php echo $announcement->announcement_id ?>
                                        </td>
                                        <td>
                                            <?php echo $announcement->announcement_text ?>
                                        </td>

                                        <td id="action">
                                            <a href="#" class="update"
                                                onclick="openPopup('delete-popup-<?php echo $announcement->announcement_id ?>')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>

                                            <!-- popupModal -->
                                            <span class="overlay"></span>
                                            <div class="modal-box"
                                                id="delete-popup-<?php echo $announcement->announcement_id ?>">
                                                <i class="fa-solid fa-trash-can"></i>
                                                <h2>Delete Announcement</h2>
                                                <h3>Announcement:
                                                    <?php echo $announcement->announcement_id ?>
                                                </h3>

                                                <div class="buttons">
                                                    <button class="close-btn"
                                                        onclick="deleteAnnouncement(<?php echo $announcement->announcement_id ?>)">Ok,Delete</button>
                                                </div>
                                            </div>
                                            <!-- popupModal -->


                                            <a href="#" class="update"
                                                onclick="openPopup('update-popup-<?php echo $announcement->announcement_id ?>')">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <!-- popupModal -->
                                            <div class="modal-box"
                                                id="update-popup-<?php echo $announcement->announcement_id ?>">
                                                <!-- <i class="fa-solid fa-trash-can"></i> -->
                                                <h2>Update Announcement</h2>
                                                <h3>Announcement:
                                                    <?php echo $announcement->announcement_id ?>
                                                </h3>

                                                <form class="form" action="#" method="post">
                                                    <div class="column">
                                                        <div class="input-box">
                                                            <label for="">Announcement</label>
                                                            <textarea id="eventAnnouncement" name="announcement"
                                                                value="<?php echo $announcement->announcement_text ?>"
                                                                placeholder="Enter the announcement"><?php echo $announcement->announcement_text ?></textarea>
                                                            <!-- <?php if (!empty($data['announcement_err'])): ?>
                                                                <span class="error-message">
                                                                    <?php echo $data['announcement_err']; ?>
                                                                </span>
                                                            <?php endif; ?> -->
                                                        </div>
                                                    </div>


                                                    <div class="radio-option-box">
                                                        <h3>Notify followers</h3>
                                                        <div class="radio-options">
                                                            <div class="radio-option">
                                                                <input type="radio" id="check-yes" name="sharingOption"
                                                                    value="1" checked>
                                                                <label for="check-yes">Yes, notify them</label>
                                                            </div>

                                                            <div class="radio-option">
                                                                <input type="radio" id="check-no" name="sharingOption"
                                                                    value="0">
                                                                <label for="check-no">No,don't notify them</label>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </form>

                                                <div class="buttons">
                                                    <button class="close-btn" id="update-btn"
                                                        onclick="updateAnnouncement('<?php echo $announcement->announcement_id ?>')">
                                                        Update
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- popupModal -->



                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" style="text-align: center;">No announcements available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- <div class="option-box">
                    <a href="<?php echo URLROOT ?>/events/addAnnouncement/<?php echo $data['event']->id ?>" class="add-announcement-btn"><i class="fa-solid fa-plus"></i> &nbsp Announcement</a>
                </div> -->
            </div>


            <div class="image-box">
                <img src="<?php echo URLROOT ?>/img/events/announcements/announcement_img.jpg" alt="">
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
    function deleteAnnouncement(announcementId) {
        // Send an AJAX request to the server to delete the category
        $.ajax({
            type: 'POST',
            url: URLROOT + '/events/deleteAnnouncement', // Replace with the URL of your server-side script
            data: {
                announcementId: announcementId
            }, // Pass the ID of the category to delete
            success: function (response) {
                if (response == true) {
                    console.log('Announcement deleted successfully');
                    closePopup('delete-popup-' + announcementId);
                    setTimeout(function () {
                        window.location.reload();
                    }, 500); // 1000 milliseconds delay (1 second)
                }
            },
            error: function (xhr, status, error) {
                console.error('Error deleting announcement:', error);
            }
        });
    }

    function updateAnnouncement(announcementId) {
        // Send an AJAX request to the server to delete the category
        var announcementText = $("#eventAnnouncement").val();
        console.log(announcementId, announcementText);

        $.ajax({
            type: 'POST',
            url: URLROOT + '/events/updateAnnouncement', // Replace with the URL of your server-side script
            data: {
                announcementId: announcementId,
                announcementText: announcementText
            }, // Pass the ID of the category to delete
            success: function (response) {
                if (response == true) {
                    console.log('Announcement updated');
                    closePopup('update-popup-' + announcementId);
                    setTimeout(function () {
                        window.location.reload();
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
<script src="<?php echo URLROOT ?>/js/events/editAnnouncements.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>