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

                                    <select name="categories[]" id="proficiency-level">
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
    function deleteCategory(skill_id) {
        // Send an AJAX request to the server to delete the category
        $.ajax({
            type: 'POST',
            url: URLROOT + '/users/deleteSkill', // Replace with the URL of your server-side script
            data: {
                skill_id: skill_id,
            }, // Pass the ID of the category to delete
            success: function (response) {
                if (response == true) {
                    console.log('Skill Deleted Successfully');
                    closePopup(skill_id);
                    setTimeout(function () {
                        window.location.reload();
                    }, 500); // 1000 milliseconds delay (1 second)
                }
            },
            error: function (xhr, status, error) {
                console.error('Error deleting skill:', error);
            }
        });
    }


    function addSkill() {
        // Get the skill name and selected proficiency level
        var skillName = document.getElementById('skill_name').value;
        var proficiencyLevel = document.getElementById('proficiency-level').value;

        // Check if both skill name and proficiency level are not empty
        if (skillName.trim() === '' || proficiencyLevel === 'Select Proficiency Level') {
            // Display an error message or handle the empty fields as needed
            alert('Please enter a skill name and select a proficiency level.');
            return;
        }

        // Log the skill name and proficiency level to the console
        console.log('Skill Name:', skillName);
        console.log('Proficiency Level:', proficiencyLevel);

        $.ajax({
            type: 'POST',
            url: URLROOT + '/users/addSkill', // Replace with the URL of your server-side script
            data: {
                skill_name: skillName,
                proficiency_level: proficiencyLevel
            }, // Pass the ID of the category to delete
            success: function (response) {
                if (response == true) {
                    console.log('Skill added successfully');
                }
                setTimeout(function () {
                        window.location.reload();
                    }, 500); // 1000 milliseconds delay (1 second)
            },
            error: function (xhr, status, error) {
                console.error('Error deleting skill:', error);
            }
        });

        // Proceed with your AJAX request or any other logic here
    }

    

</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>