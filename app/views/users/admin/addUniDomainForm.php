<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/addUniDomainForm_style.css">
<div class="form-outer-box">

    <form class="form" action="#" method="post">

        <div class="column">

            <div class="input-box">
                <label for="">University</label>
                <div class="select-box">
                    <select name="university" id="selection" class="dropdown-menu">
                        <option value="0" hidden >Select
                            University</option>
                        <?php foreach ($data['universities'] as $university): ?>
                            <option value="<?php echo $university->id ?>">
                                <?php echo $university->name ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <span class="university-error-message">
            </div>

            <div class="input-box">
                <label for="">Domain</label>
                <input type="text" name="domain" id="domain" placeholder="Enter the domain">
                <span class="domain-error-message">
                </span>
            </div>
        </div>

        <div class="add-unidomain-form-btn submit-btn" onclick="addDomain()">
            Add University
        </div>


    </form>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function addDomain() {
        // Retrieve values of website and domain inputs
        var university = document.getElementById("selection").value.trim();
        var domain = document.getElementById("domain").value.trim();

        // Get error spans
        var universityError = document.querySelector(".university-error-message");
        var domainError = document.querySelector(".domain-error-message");

        // Reset previous error messages
        universityError.textContent = "";
        domainError.textContent = "";

        // Check if either input is empty
        var isValid = true;
        if (university === "" || university === "0") {
            universityError.textContent = "University selection is required.";
            isValid = false;
        }
        if (domain === "") {
            domainError.textContent = "Domain is required.";
            isValid = false;
        }

        // If both inputs are filled, proceed
        if (isValid) {
            // Perform your action here, e.g., make AJAX request to add the domain
            $.ajax({
                type: 'POST',
                url: URLROOT + '/universities/addDomain',
                data: { universityId: university, domain: domain },
                success: function (response) {
                    console.log(response);
                    $('#search-bar-unidomain').val(null);
                    handleUniDomainFilters();
                },
                error: function (xhr, status, error) {
                    console.error('Failed to add domain:', error);
                }
            });
        }
    }

</script>