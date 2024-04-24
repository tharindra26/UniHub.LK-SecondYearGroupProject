<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/adminprofile_style.css">
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/events_style.css">
<h1 class="section-title">Events</h1>
<div class="summary">
    <div class="box total" id="all" onclick="mainEventFilter('all');">
        <div class="box-content">
            <h3>All Events</h3>
        </div>
        <div class="">
            <span class="tot" data-val="<?php echo $data['totalEvents']->total_events; ?>">0000</span>
        </div>
        <div class="box-icon">
            <i class="fa-solid fa-calendar-days"></i>
        </div>
    </div>
    <div class="box ongoing" id="ongoing" onclick="mainEventFilter('ongoing');">
        <div class="box-content">
            <h3>Ongoing Events</h3>
        </div>
        <div class="">
            <span class="tot" data-val="<?php echo $data['ongoingEvents']->ongoing_events; ?>">0000</span>
        </div>
        <div class="box-icon">
            <i class="fa-solid fa-calendar-check"></i>
        </div>
    </div>
    <div class="box due" id="due" onclick="mainEventFilter('due');">
        <div class="box-content">
            <h3>Due Events</h3>
        </div>
        <div class="">
            <span class="tot" data-val="<?php echo $data['dueEvents']->due_events; ?>">0000</span>
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
                <input type="text" name="searchInput" placeholder="Search Event" id="search-bar-input">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

    </div>
    <!-- university-filter -->
    <div class="option select-uni filter">
        <select name="university" id="uni-filter-value" "
            placeholder=" Approval" class="dropdown-menu">
            <option value="">None</option>
            <?php if (!empty($data['universities'])): ?>
                <?php foreach ($data['universities'] as $uni): ?>
                    <option value="<?php echo $uni->id ?>"><?php echo $uni->name ?></option>
                <?php endforeach; ?>
                ?php else : ?>
                <option value="">No universities found</option>
            <?php endif; ?>

        </select>
    </div>


</div>

<div class="summary">
    <div class="option table-heading">
        <div class="user-head">
            <h2>Recent Events</h2>
        </div>
    </div>
    <div class="option filter">
        <select name="approval" id="approval-filter-value" placeholder="Approval" class="dropdown-menu">
            <option value="">None</option>
            <option value="approved">Approved</option>
            <option value="pending">Pending</option>
            <option value="rejected">Rejected</option>
        </select>
    </div>
    <div class="option filter">
        <select name="status" id="status-filter-value" class="dropdown-menu">
            <option value="">None</option>
            <option value="1">Active</option>
            <option value="0">Deactivated</option>
        </select>
    </div>
</div>

<!-- <div class="user-info"> -->

<div class="users" id="events-filter-table">

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?php echo URLROOT ?>/js/users/admin/events.js"></script>
<script>
    var URLROOT = document.querySelector('.urlRootValue').textContent.trim();
    // Function to gather and handle all filter inputs
    function handleFilters() {
        var searchInputValue = $('#search-bar-input').val();
        var selectedUniversity = $('#uni-filter-value').val();
        var selectedApproval = $('#approval-filter-value').val();
        var selectedStatus = $('#status-filter-value').val();

        if (searchInputValue === "") {
            searchInputValue = null;
        }

        // Check if the selected values are "None" and set them to null
        if (selectedUniversity === "None") {
            selectedUniversity = null;
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
            url: URLROOT + '/events/filterEvents',
            data: { keyword: searchInputValue,
                university: selectedUniversity,
                approval:selectedApproval,
                status: selectedStatus   
             },
            success: function (response) {
                // Update the like count in the DOM
                $("#events-filter-table").html(response);
            },
            error: function (xhr, status, error) {
                console.error('Fail to retreive:', error);
            }
        });
    }
    handleFilters();

    // Listen for changes in the search input
    $('#search-bar-input').on('input', function () {
        handleFilters();
    });

    // Listen for changes in the university dropdown
    $('#uni-filter-value').on('change', function () {
        handleFilters();
    });

    // Listen for changes in the approval dropdown
    $('#approval-filter-value').on('change', function () {
        handleFilters();
    });

    // Listen for changes in the status dropdown
    $('#status-filter-value').on('change', function () {
        handleFilters();
    });
</script>