<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/undergraduate/editSkills_style.css">

<div class="container">
    <div class="inner-container">
        <div class="bottom-part">
            
            <div class="left-box">
                <div class="title-text">
                    <p>Change Skills</p>
                </div>
                <div class="users" id="filter-table">
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>Skill</th>
                                <th>Proficiency Level</th>
                                <th class="action-field">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data['skill'][0]->user_skill_id)): ?>
                                <?php foreach ($data['skill'] as $skill):
                                    if (empty($skill)):
                                        break;
                                    endif; ?>

                                    <tr>
                                        <td>
                                            <?php echo $skill->skill_name ?>
                                        </td>

                                        <td>
                                            <?php echo $skill->proficiency_level ?>
                                        </td>

                                        <td id="action">
                                            <a href="#" class="update"
                                                onclick="openPopup('delete-popup-<?php echo $skill->user_skill_id ?>')">
                                                <i class="fa-solid fa-trash-can"></i></a>
                                            
                                            <!-- popupModal -->

                                            <span class="overlay"></span>
                                            <div class="modal-box" id="delete-popup-<?php echo $skill->user_skill_id ?>">
                                                <i class="fa-solid fa-trash-can"></i>
                                                <h2>Delete Skill</h2>
                                                <h3>Skill:
                                                    <?php echo $skill->skill_name ?>
                                                </h3>

                                                <div class="buttons">
                                                    <button class="close-btn"
                                                        onclick="deleteCategory(<?php echo $skill->user_skill_id ?>, <?php echo $skill->user_skill_id ?>)">Ok,Delete</button>
                                                </div>
                                            </div>

                                            <!-- popupModal -->
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>

                

            </div>

            <div class="right-bar">
            <div class="title-text">
            <p>Change Skills</p>
            </div>
            <div class="add-skill-section">
                    <form class="form" action="" method="post" enctype="multipart/form-data">
                        <div class="categories-section">
                            <div class="input-box">
                                <label for="">Skill</label>
                                <input type="text" name="skill_name" value="" id="skill_name" placeholder="Enter the Skill">
                                <?php if (!empty($data['skill_name_err'])): ?>
                                <span class="error-message"><?php echo $data['skill_name_err']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="input-box ">
                                <!-- <label for="">Press ctrl to select multiple categories.</label> -->
                                <div class="select-box category">

                                    <select name="categories[]" id="selection">
                                        <option hidden>Select Proficiency Level</option>
                                        <option value="Beginner">Beginner</option>
                                        <option value="Intermediate">Intermediate</option>
                                        <option value="Advanced">Advanced</option>
                                        <option value="Expert">Expert</option>
                                    </select>


                                </div>
                                <?php if (!empty($data['category_err'])): ?>
                                    <span class="error-message">
                                        <?php echo $data['category_err']; ?>
                                    </span>
                                <?php endif; ?>
                            </div>


                        </div>
                    </form>
                    <div class="error-message"></div>
                    <button class="add-categories-btn" onclick="addSkill()">Add Skill</button>
                </div>

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



    // Function to handle the deletion of a category
    function deleteCategory(eventId, categoryId) {
        // Send an AJAX request to the server to delete the category
        $.ajax({
            type: 'POST',
            url: URLROOT + '/events/deleteEventCategory', // Replace with the URL of your server-side script
            data: {
                categoryId: categoryId,
                eventId: eventId
            }, // Pass the ID of the category to delete
            success: function (response) {
                if (response == true) {
                    console.log('Category deleted successfully');
                    closePopup('delete-popup-' + categoryId);
                    setTimeout(function () {
                        window.location.reload();
                    }, 500); // 1000 milliseconds delay (1 second)
                }
            },
            error: function (xhr, status, error) {
                console.error('Error deleting category:', error);
            }
        });
    }

    function addSkill() {
        // Get the selected category value
        var selectedCategory = $('#selection').val();
        var skillName = $('#skill_name').val();
        console.log('skillName', skillName);
        console.log('selectedCategory', selectedCategory);

        // Check if a category is selected
        if (selectedCategory && skillName) {
            // Send an AJAX request to the backend
            $.ajax({
                type: 'POST',
                url: "http://localhost/unihub/users/addSkill", // Replace 'your-backend-url' with the actual backend URL
                data: {
                    userId: <?php echo $data['user_id']; ?>,
                    skill_name:skillName,
                    proficiency_level: selectedCategory
                },
                success: function (response) {
                    if (response == true) {
                        // Handle success response
                        console.log('Category added successfully');
                        // Optionally, reset the selection
                        $('#skill_name').val('');
                        $('#selection').val('');
                        setTimeout(function () {
                            window.location.reload();
                        }, 500); // 1000 milliseconds delay (1 second)
                    }else{
                        $('.error-message').text('Error: Failed to add category');
                    }
                },
                error: function (xhr, status, error) {
                    // Handle error
                    console.error('Error adding category:', error);
                }
            });
        } else {
            // Show an error message if no category is selected
            alert('Please select a category');
        }
    }

</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/events/editCategories.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>