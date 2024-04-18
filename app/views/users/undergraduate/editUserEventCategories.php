<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/events/editCategories_style.css">


<div class="container">
    <div class="inner-container">
        <div class="title-text">
            <p>Change Interst on Events</p>
        </div>
        <div class="bottom-part">

            <div class="left-box">
                <div class="users" id="filter-table">
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th class="action-field">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data['userEventCategories'][0]->id)): ?>
                                <?php foreach ($data['userEventCategories'] as $category):
                                    if (empty($category)):
                                        break;
                                    endif; ?>

                                    <tr>
                                        <td>
                                            <?php echo $category->category_name ?>
                                        </td>

                                        <td id="action">
                                            <a href="#" class="update"
                                                onclick="openPopup('delete-popup-<?php echo $category->id ?>')">
                                                <i class="fa-solid fa-trash-can"></i></a>
                                            <!-- popupModal -->

                                            <span class="overlay"></span>
                                            <div class="modal-box" id="delete-popup-<?php echo $category->id ?>">
                                                <i class="fa-solid fa-trash-can"></i>
                                                <h2>Delete Category</h2>
                                                <h3>Category:
                                                    <?php echo $category->category_name ?>
                                                </h3>

                                                <div class="buttons">
                                                    <button class="close-btn"
                                                        onclick="deleteCategory(<?php echo $category->id ?>)">Ok,Delete</button>
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

                <div class="add-category-section">
                    <form class="form" action="" method="post" enctype="multipart/form-data">

                        <div class="categories-section">
                            <H3>Choose Categories</H3>
                            <div class="input-box ">
                                <!-- <label for="">Press ctrl to select multiple categories.</label> -->
                                <div class="select-box category">

                                    <select name="categories[]" id="selection">
                                        <option hidden>Select Category</option>
                                        <?php if (!empty($data['eventCategories'][0]->id)): ?>
                                            <?php foreach ($data['eventCategories'] as $category):
                                                if (empty($category)):
                                                    break;
                                                endif; ?>
                                                <option value="<?php echo $category->id ?>"><?php echo $category->category_name ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
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
                    <button class="add-categories-btn" onclick="addCategory()">Add Category</button>
                </div>


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
    function deleteCategory(categoryId) {
        // Send an AJAX request to the server to delete the category
        alert(categoryId);
        $.ajax({
            type: 'POST',
            url: URLROOT + '/users/deleteEventInterestCategory', // Replace with the URL of your server-side script
            data: {
                categoryId: categoryId
            }, // Pass the ID of the category to delete
            success: function (response) {
                alert(response);
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

    function addCategory() {
        // Get the selected category value
        var selectedCategory = $('#selection').val();
        console.log('selectedCategory:', selectedCategory);

        // Check if a category is selected
        if (selectedCategory) {
            // Send an AJAX request to the backend
            $.ajax({
                type: 'POST',
                url: URLROOT + '/users/addEventInterestCategory', // Replace 'your-backend-url' with the actual backend URL
                data: {
                    category: selectedCategory
                },
                success: function (response) {
                    alert(response);
                    if (response == true) {
                        // Handle success response
                        console.log('Category added successfully');
                        // Optionally, reset the selection
                        $('#selection').val('');
                        setTimeout(function () {
                            window.location.reload();
                        }, 500); // 1000 milliseconds delay (1 second)
                    } else {
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