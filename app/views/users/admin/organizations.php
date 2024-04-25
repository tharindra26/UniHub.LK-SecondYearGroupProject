<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/events_style.css">
<h1 class="section-title">Organization</h1>
<div class="summary">
    <div class="box total" id="all" onclick="mainOrganizationFilter('all');">
        <div class="box-content">
            <h3>All Organizations</h3>
        </div>
        <div class="">
            <span class="tot" data-val="<?php echo $data['totalOrganizations']->total_organizations; ?>">0000</span>
        </div>
        <div class="box-icon">
            <i class="fa-solid fa-calendar-days"></i>
        </div>
    </div>
</div>
<div class="summary">
    <div class="option search">
        <div class="search-bar-container">
            <form action="" class="search-bar">
                <input type="text" name="searchInput" placeholder="Search Organization" id="search-bar-org">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

    </div>
    <!-- university-filter -->
    <div class="option select-uni filter">
        <div class="filter-text">University:</div>
            <select name="university" id="uni-filter-org" placeholder=" Approval" class="dropdown-menu">
                <option value="">None</option>
                <?php if (!empty($data['universities'])): ?>
                    <?php foreach ($data['universities'] as $uni): ?>
                        <option value="<?php echo $uni->id ?>"><?php echo $uni->name ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>

            </select>

    </div>


</div>

<div class="summary">
    <div class="option table-heading">
        <div class="user-head">
            <h2>All Organizations</h2>
        </div>
    </div>
    <div class="option filter">
    <div class="filter-text">Category:</div>
    <select name="category" id="category-filter-org" class="dropdown-menu">
            <option value="">None</option>
            <?php if (!empty($data['categories'])): ?>
                <?php foreach ($data['categories'] as $catogery): ?>
                    <option value="<?php echo $catogery->category_id ?>"><?php echo $catogery->category_name ?></option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="">No universities found</option>
            <?php endif; ?>

        </select>
    </div>
    <div class="option filter">
    <div class="filter-text">Status:</div>
        <select name="status" id="status-filter-org"
            class="dropdown-menu">
            <option value="">None</option>
            <option value="active">Active</option>
            <option value="deactivated">Deactivated</option>
        </select>
    </div>
</div>

<!-- <div class="user-info"> -->

<div class="users" id="organizations-filter-table">

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?php echo URLROOT ?>/js/users/admin/organizations.js"></script>

<script>
    var URLROOT = document.querySelector('.urlRootValue').textContent.trim();

    // Function to gather and handle all filter inputs
    function handleOrganizationFilters() {
        var searchInputValue = $('#search-bar-org').val();
        var selectedUniversity = $('#uni-filter-org').val();
        var selectedCategory = $('#category-filter-org').val();
        var selectedStatus = $('#status-filter-org').val();

        if (searchInputValue === "") {
            searchInputValue = null;
        }

        // Check if the selected values are "None" and set them to null
        if (selectedUniversity === "None") {
            selectedUniversity = null;
        }
        if (selectedCategory === "None") {
            selectedCategory = null;
        }
        if (selectedStatus === "None") {
            selectedStatus = null;
        }

        // Perform any action you need with these values
        // For example, make an AJAX request to fetch filtered events based on these inputs
        // You can pass these values as parameters to your AJAX request
        $.ajax({
            type: 'POST',
            url: URLROOT + '/organizations/filterOrganizations',
            data: {
                keyword: searchInputValue,
                university: selectedUniversity,
                category: selectedCategory,
                status: selectedStatus,
            },
            success: function (response) {
                // Update the like count in the DOM
                $("#organizations-filter-table").html(response);
            },
            error: function (xhr, status, error) {
                console.error('Fail to retreive:', error);
            }
        });
    }
    handleOrganizationFilters();

    // Listen for changes in the search input
    $('#search-bar-org').on('input', function () {
        handleOrganizationFilters();
    });

    // Listen for changes in the university dropdown
    $('#uni-filter-org').on('change', function () {
        handleOrganizationFilters();
    });

    // Listen for changes in the approval dropdown
    $('#category-filter-org').on('change', function () {
        handleOrganizationFilters();
    });

    // Listen for changes in the status dropdown
    $('#status-filter-org').on('change', function () {
        handleOrganizationFilters();
    });
</script>
<script>
    // Function to reset other filters to default values
    function resetOtherFilters() {
        // Reset search input
        document.getElementById("search-bar-org").value = "";

        // Reset university filter to default
        document.getElementById("uni-filter-org").value = "";

        // Reset approval filter to default
        document.getElementById("category-filter-org").value = "";

        // Reset status filter to default
        document.getElementById("status-filter-org").value = "";
    }
    function mainOrganizationFilter(type) {
    // Reset other filters to default values
    resetOtherFilters();
    // Make AJAX request with the selected filter type
    $.ajax({
        url: URLROOT + '/organizations/totalOrgFilter',
        type: "POST",
        data: {
            value: type,
        },
        success: function (response) {
            // Update the content section with the retrieved data
            $("#organizations-filter-table").html(response); // Updated the selector to match the correct element
        },
        error: function (error) {
            console.error("Error:", error);
        },
    });
}

</script>
<script>
    // Counter starts
function initializeCount() {
    totalValue = document.querySelectorAll(".tot");
    let timeinterval = 200;

    totalValue.forEach((valueDisplay) => {
        let startValue = 0;
        let endValue = parseInt(valueDisplay.getAttribute("data-val"));
        let duration = Math.floor(timeinterval / endValue);
        let counter = setInterval(() => {
            startValue += 1;
            valueDisplay.textContent = startValue;
            if (startValue === endValue) {
                clearInterval(counter);
            }
        }, duration);
    });
}

initializeCount();

</script>