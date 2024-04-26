<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/postDomainForm_style.css">
<div class="form-outer-box">

    <form class="form" action="#" method="post">

        <div class="column">
            <div class="input-box">
                <label for="">Website</label>
                <input type="text" name="website" id="website" placeholder="Enter the website">
                <span class="website-error-message">
                </span>
            </div>
        </div>

        <div class="column">
            <div class="input-box">
                <label for="">Domain</label>
                <input type="text" name="domain" id="domain" placeholder="Enter the domain">
                <span class="domain-error-message">
                </span>
            </div>
        </div>

        <div class="add-domain-form-btn submit-btn" onclick="addDomain()">
            Add Domain
        </div>


    </form>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function addDomain() {
        // Retrieve values of website and domain inputs
        var website = document.getElementById("website").value.trim();
        var domain = document.getElementById("domain").value.trim();

        // Get error spans
        var websiteError = document.querySelector(".website-error-message");
        var domainError = document.querySelector(".domain-error-message");

        // Reset previous error messages
        websiteError.textContent = "";
        domainError.textContent = "";

        // Check if either input is empty
        var isValid = true;
        if (website === "") {
            websiteError.textContent = "Website is required.";
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
                url: URLROOT + '/posts/addDomain',
                data: { website: website, domain: domain },
                success: function (response) {
                    console.log(response);
                    $('#search-bar-post-domain').val(null);
                    handleDomainFilters();
                },
                error: function (xhr, status, error) {
                    console.error('Failed to add domain:', error);
                }
            });
        }
    }

</script>