<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/addUniversityForm_style.css">
<div class="form-outer-box">

    <form class="form" action="#" method="post">

        <div class="column">
            <div class="input-box">
                <label for="">University</label>
                <input type="text" name="name" id="name" placeholder="Enter the University">
                <span class="name-error-message">
                </span>
            </div>

            <div class="input-box">
                <label for="">Short Code</label>
                <input type="text" name="unicode" id="unicode" placeholder="Enter the short code">
                <span class="unicode-error-message">
                </span>
            </div>
        </div>

        <div class="add-university-form-btn submit-btn" onclick="addUniversity()">
            Add University
        </div>


    </form>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function addUniversity() {
        // Retrieve values of website and domain inputs
        var name = document.getElementById("name").value.trim();
        var unicode = document.getElementById("unicode").value.trim();

        // Get error spans
        var nameError = document.querySelector(".name-error-message");
        var unicodeError = document.querySelector(".unicode-error-message");

        // Reset previous error messages
        nameError.textContent = "";
        unicodeError.textContent = "";

        // Check if either input is empty
        var isValid = true;
        if (name === "") {
            nameError.textContent = "University Name is required.";
            isValid = false;
        }
        if (unicode === "") {
            unicodeError.textContent = "Short Code is required.";
            isValid = false;
        }

        // If both inputs are filled, proceed
        if (isValid) {
            // Perform your action here, e.g., make AJAX request to add the domain
            $.ajax({
                type: 'POST',
                url: URLROOT + '/universities/addUniversity',
                data: { name: name, unicode: unicode },
                success: function (response) {
                    console.log(response);
                    $('#search-bar-university').val(null);
                    handleUniversityFilters();
                },
                error: function (xhr, status, error) {
                    console.error('Failed to add domain:', error);
                }
            });
        }
    }

</script>