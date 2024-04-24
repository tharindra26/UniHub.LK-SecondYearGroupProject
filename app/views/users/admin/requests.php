<!-- <?php $jsonData = json_encode($data['user']); ?> -->
<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/adminprofile_style.css">
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/requests_style.css">
<h1 class="section-title">Requests</h1>

<div class="event-requests-section">
    <div class="event-requests-title">Event Requests</div>
    <div class="summary">
        <div class="option table-heading">
            <div class="user-head">
                <h2>Event Requests</h2>
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
    </div>
    <div id="event-request-content" class="event-request-content">

    </div>
</div>
<div class="organization-requests-section"></div>
<div class="post-requests-section"></div>
<script>
    function handleFilters() {
        // var searchInputValue = $('#search-bar-input').val();
        // var selectedUniversity = $('#uni-filter-value').val();
        var selectedApproval = $('#approval-filter-value').val();
        // var selectedStatus = $('#status-filter-value').val();

        // if (searchInputValue === "") {
        //     searchInputValue = null;
        // }

        // Check if the selected values are "None" and set them to null
        // if (selectedUniversity === "None") {
        //     selectedUniversity = null;
        // }
        if (selectedApproval === "None") {
            selectedApproval = null;
        }
        // if (selectedStatus === "None") {
        //     selectedStatus = null;
        // }
        console.log(selectedApproval);

        // Perform any action you need with these values
        // For example, make an AJAX request to fetch filtered events based on these inputs
        // You can pass these values as parameters to your AJAX request
        $.ajax({
            type: 'POST',
            url: URLROOT + '/events/filterEventsByApproval',
            data: {
                keyword: '',
                university: '',
                approval: selectedApproval,
                status: '0'
            },
            success: function (response) {
                // Update the like count in the DOM
                $("#event-request-content").html(response);
            },
            error: function (xhr, status, error) {
                console.error('Fail to retreive:', error);
            }
        });
    }
    // Listen for changes in the approval dropdown
    $('#approval-filter-value').on('change', function () {
        handleFilters();
    });


</script>