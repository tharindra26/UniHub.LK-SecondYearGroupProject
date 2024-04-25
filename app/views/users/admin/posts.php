<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- <link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/adminprofile_style.css"> -->
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/events_style.css">
<h1 class="section-title">Events</h1>
<div class="summary">
    <div class="box total" id="all" onclick="mainPostsFilter('all');">
        <div class="box-content">
            <h3>Total Posts</h3>
        </div>
        <div class="">
            <span class="tot" data-val="<?php echo $data['totalPosts']; ?>">0000</span>
        </div>
        <div class="box-icon">
            <i class="fa-solid fa-calendar-days"></i>
        </div>
    </div>
    <div class="box ongoing" id="published" onclick="mainPostsFilter('published');">
        <div class="box-content">
            <h3>Published Posts</h3>
        </div>
        <div class="">
            <span class="tot" data-val="<?php echo $data['publishedPostsCount']; ?>">0</span>
        </div>
        <div class="box-icon">
            <i class="fa-solid fa-calendar-check"></i>
        </div>
    </div>
    <div class="box due" id="pending" onclick="mainPostsFilter('pending');">
        <div class="box-content">
            <h3>Pending Posts</h3>
        </div>
        <div class="">
            <span class="tot" data-val="<?php echo $data['pendingPostsCount']; ?>">0000</span>
        </div>
        <div class="box-icon">
            <i class="fa-solid fa-calendar-xmark"></i>
        </div>
    </div>

</div>
<div class="summary">
    <div class="option search">
        <div class="search-bar-container">
            <form action="" class="search-bar">
                <input type="text" name="searchInput" placeholder="Search Post" id="search-bar-post">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

    </div>
    <div class="option select-uni filter">
        <div class="filter-text">Category:</div>
        <select name="category" id="category-filter-post" class="dropdown-menu">
            <option value="">None</option>
            <?php if (!empty($data['categories'])): ?>
                <?php foreach ($data['categories'] as $catogery): ?>
                    <option value="<?php echo $catogery->category_id ?>"><?php echo $catogery->category_name ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>


</div>

<div class="summary">
    <div class="option filter filter1">
        <div class="filter-text">Start:</div>
        <div class="date-filter">
            <input type="date" name="" id="start-date-post">
        </div>
    </div>
    <div class="option filter filter1">
        <div class="filter-text">End:</div>
        <div class="date-filter">
            <input type="date" name="" id="end-date-post">
        </div>
    </div>

    <div class="option filter filter1">
        <div class="filter-text">Approval:</div>
        <select name="approval" id="approval-filter-post" placeholder="Approval" class="dropdown-menu">
            <option value="">None</option>
            <option value="approved">Approved</option>
            <option value="pending">Pending</option>
            <option value="rejected">Rejected</option>
        </select>
    </div>
    <div class="option filter filter1">
        <div class="filter-text">Status:</div>
        <select name="status" id="status-filter-post" class="dropdown-menu">
            <option value="0">None</option>
            <option value="active">Activated</option>
            <option value="deactivated">Deactivated</option>
        </select>
    </div>
</div>

<!-- <div class="user-info"> -->

<div class="users" id="posts-filter-table">

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?php echo URLROOT ?>/js/users/admin/posts.js"></script>

<script>
    var URLROOT = document.querySelector('.urlRootValue').textContent.trim();

    // Function to gather and handle all filter inputs
    function handlePostFilters() {
        var searchInputValue = $('#search-bar-post').val();
        var selectedCategory = $('#category-filter-post').val();
        var selectedApproval = $('#approval-filter-post').val();
        var selectedStatus = $('#status-filter-post').val();
        var startDate = $('#start-date-post').val(); 
        var endDate = $('#end-date-post').val();

        if (searchInputValue === "") {
            searchInputValue = null;
        }

        // Check if the selected values are "None" and set them to null
        if (selectedCategory === "None") {
            selectedCategory = null;
        }
        if (selectedApproval === "None") {
            selectedApproval = null;
        }
        if (selectedStatus === "None") {
            selectedStatus = null;
        }

        // Perform any action you need with these values
        // For example, make an AJAX request to fetch filtered events based on these inputs
        // You can pass these values as parameters to your AJAX request
        $.ajax({
            type: 'POST',
            url: URLROOT + '/posts/filterPosts',
            data: {
                keyword: searchInputValue,
                university: "",
                category: selectedCategory,
                approval: selectedApproval,
                status: selectedStatus,
                startDate: startDate,
                endDate: endDate
            },
            success: function (response) {
                // Update the like count in the DOM
                $("#posts-filter-table").html(response);
            },
            error: function (xhr, status, error) {
                console.error('Fail to retreive:', error);
            }
        });
    }
    handlePostFilters();

    // Listen for changes in the search input
    $('#search-bar-post').on('input', function () {
        handlePostFilters();
    });

    // Listen for changes in the university dropdown
    $('#category-filter-post').on('change', function () {
        handlePostFilters();
    });

    // Listen for changes in the approval dropdown
    $('#approval-filter-post').on('change', function () {
        handlePostFilters();
    });

    // Listen for changes in the status dropdown
    $('#status-filter-post').on('change', function () {
        handlePostFilters();
    });

    $('#start-date-post').on('change', function () {
        handlePostFilters();
    });

    $('#end-date-post').on('change', function () {
        handlePostFilters();
    });
</script>

<script>
    // Function to reset other filters to default values
    function resetOtherPostFilters() {
        // Reset search input
        document.getElementById("search-bar-post").value = "";

        // Reset university filter to default
        document.getElementById("category-filter-post").value = "";

        // Reset approval filter to default
        document.getElementById("approval-filter-post").value = "";

        // Reset status filter to default
        document.getElementById("status-filter-post").value = ""; // Fixed element ID here
    }

    function mainPostsFilter(type) {
        // Reset other filters to default values
        resetOtherPostFilters();
        // Make AJAX request with the selected filter type
        $.ajax({
            url: URLROOT + '/posts/totalPostsFilter',
            type: "POST",
            data: {
                value: type,
            },
            success: function (response) {
                // Update the content section with the retrieved data
                $("#posts-filter-table").html(response);
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