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
                <option value="">All</option>
                <option value="approved">Approved</option>
                <option value="pending" selected>Pending</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>
    </div>
    <div id="event-request-content" class="event-request-content">

    </div>
</div>



<div class="organization-requests-section">
    <div class="summary">
        <div class="option table-heading">
            <div class="user-head">
                <h2>Organization Requests</h2>
            </div>
        </div>
        <div class="option filter">
            <select name="approval" id="organization-filter-value" placeholder="Approval" class="dropdown-menu">
                <option value="">All</option>
                <option value="approved">Approved</option>
                <option value="pending" selected>Pending</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>
    </div>
    <div id="organization-request-content" class="organization-request-content">

    </div>
</div>
<div class="post-requests-section">
    <div class="summary">
        <div class="option table-heading">
            <div class="user-head">
                <h2>Post Requests</h2>
            </div>
        </div>
        <div class="option filter">
            <select name="approval" id="post-filter-value" placeholder="Approval" class="dropdown-menu">
                <option value="">All</option>
                <option value="approved">Approved</option>
                <option value="pending" selected>Pending</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>
    </div>
    <div id="post-request-content" class="post-request-content">
    </div>
    <script>
        function handleEventFilters() {
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

        handleEventFilters();
        // Listen for changes in the approval dropdown
        $('#approval-filter-value').on('change', function () {
            handleEventFilters();
        });



        function handleOrganizationFilters() {


            var selectedOrganizationFilterValue = $('#organization-filter-value').val();

            if (selectedOrganizationFilterValue === "None") {
                selectedOrganizationFilterValue = null;
            }

            console.log(selectedOrganizationFilterValue);

            $.ajax({
                type: 'POST',
                url: URLROOT + '/organizations/filterOrganizationsByApproval',
                data: {
                    keyword: '',
                    university: '',
                    category: '',
                    approval: selectedOrganizationFilterValue,
                    status: '0'
                },
                success: function (response) {
                    // Update the like count in the DOM
                    $("#organization-request-content").html(response);
                },
                error: function (xhr, status, error) {
                    console.error('Fail to retreive:', error);
                }
            });

        }

        handleOrganizationFilters();
        // Listen for changes in the approval dropdown
        $('#organization-filter-value').on('change', function () {
            handleOrganizationFilters();
        });



        function handlePostFilters() {


            var selectedPostFilterValue = $('#post-filter-value').val();

            if (selectedPostFilterValue === "None") {
                selectedPostFilterValue = null;
            }

            console.log(selectedPostFilterValue);

            $.ajax({
                type: 'POST',
                url: URLROOT + '/posts/filterPostsByApproval',
                data: {
                    keyword: '',
                    category: '',
                    approval: selectedOrganizationFilterValue,
                    status: '0'
                },
                success: function (response) {
                    // Update the like count in the DOM
                    $("#post-request-content").html(response);
                },
                error: function (xhr, status, error) {
                    console.error('Fail to retreive:', error);
                }
            });

        }

        handlePostFilters();
        // Listen for changes in the approval dropdown
        $('#post-filter-value').on('change', function () {
            handlePostFilters();
        });


    </script>