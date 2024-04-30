<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/addUserForm_style.css">
<div class="form-outer-box">

    <form class="form" action="#" method="post">

        <div class="column">
            <div class="input-box">
                <label for="">Primary Email</label>
                <input type="text" name="email" id="email" placeholder="Enter the primary email">
                <span class="email-error-message error-message">
                </span>
            </div>

            <div class="input-box">
                <label for="">Secondary Email</label>
                <input type="text" name="secondary_email" id="secondary_email" placeholder="Enter the secondary email">
                <span class="secondary-email-error-message error-message">
                </span>
            </div>
        </div>

        <div class="column">
            <div class="input-box">
                <label for="">User Type</label>
                <div class="select-box">
                    <select name="type" id="selection">
                        <option hidden>Select Type</option>
                        <option value="admin">Admin</option>
                        <option value="unirep">University Representative</option>
                        <option value="orgrep">Organization Representative</option>
                    </select>
                </div>
                <span class="user-type-error-message error-message">
                </span>
            </div>
        </div>

        <div class="column">
            <div class="input-box">
                <label for="">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter the password">
                <span class="password-error-message error-message">
                </span>
            </div>
        </div>

        <div class="add-domain-form-btn submit-btn" onclick="addUser()">
            Add User
        </div>


    </form>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>

    function addUser() {
        // Retrieve values from input fields
        var email = $('#email').val().trim();
        var secondaryEmail = $('#secondary_email').val().trim();
        var userType = $('#selection').val();
        var password = $('#password').val().trim();

        // Get error message spans
        var emailError = $('.email-error-message');
        var secondaryEmailError = $('.secondary-email-error-message');
        var userTypeError = $('.user-type-error-message');
        var passwordError = $('.password-error-message');

        // Reset previous error messages
        emailError.text('');
        secondaryEmailError.text('');
        userTypeError.text('');
        passwordError.text('');

        // Perform validation
        var isValid = true;

        // Check if email is empty
        if (email === '') {
            emailError.text('Primary email is required.');
            isValid = false;
        }

        // Check if secondary email is empty
        if (secondaryEmail === '') {
            secondaryEmailError.text('Secondary email is required.');
            isValid = false;
        }

        // Check if user type is selected
        if (userType === 'Select Type') {
            userTypeError.text('Please select a user type.');
            isValid = false;
        }

        // Check if password is empty
        if (password === '') {
            passwordError.text('Password is required.');
            isValid = false;
        }

        // If all fields are filled, proceed to add the user
        if (isValid) {
            // Perform your action here, e.g., make AJAX request to add the user
            console.log('Email:', email);
            console.log('Secondary Email:', secondaryEmail);
            console.log('User Type:', userType);
            console.log('Password:', password);

            // Call function to check if the user already exists
            checkUserExists(email);
        }
    }

    function checkUserExists(email) {
        // Make AJAX request to check if the user already exists
        $.ajax({
            type: 'POST',
            url: URLROOT + '/users/checkUserExist',
            data: {
                email: email
            },
            success: function (response) {
                // If user does not exist, proceed to add the user
                if (!response) {
                    // Call function to add the user
                    checkOrganizationExists(email);
                } else {
                    // Display error message indicating that the user already exists
                    $('.email-error-message').text('User with this email already exists.');
                }
            },
            error: function (xhr, status, error) {
                console.error('Failed to check user existence:', error);
            }
        });
    }

    function checkOrganizationExists(email) {
        // Make AJAX request to check if an organization exists with the email
        console.log('Checking');
        $.ajax({
            type: 'POST',
            url: URLROOT + '/organizations/checkOrganizationExist',
            data: {
                email: email
            },
            success: function (response) {
                // If organization does not exist, proceed to add the user
                if (response) {
                    addUserToDatabase();
                } else {
                    // Display error message indicating that an organization with this email already exists
                    $('.email-error-message').text('Organization with this email not exit.');
                }
            },
            error: function (xhr, status, error) {
                console.error('Failed to check organization existence:', error);
            }
        });
    }

    function addUserToDatabase() {
        var email = $('#email').val().trim();
        var secondaryEmail = $('#secondary_email').val().trim();
        var userType = $('#selection').val();
        var password = $('#password').val().trim();

        console.log(email, secondaryEmail, userType, password);
        $.ajax({
            type: 'POST',
            url: URLROOT + '/users/addSpecialUser',
            data: {
                email: email,
                secondaryEmail: secondaryEmail,
                userType: userType,
                password: password
            },
            success: function (response) {
                console.log(response);
                alert('User added successfully!');
                $('#search-bar-input').val(null);
                $('#uni-filter-value').val(null);
                $('#status-filter-value').val(null);
                $('#type-filter-value').val(null);
                handleFilters();
            },
            error: function (xhr, status, error) {
                console.error('Failed to add user to database:', error);
            }
        });
    }

</script>