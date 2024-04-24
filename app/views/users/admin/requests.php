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
</div>
<div class="organization-requests-section"></div>
<div class="post-requests-section"></div>
<script>
    $("#requests-content").on("click", function (e) {
        //
        e.preventDefault(); // Prevent the default link behavior
        // // Your AJAX function here
        $.ajax({
            url: 'http://localhost/unihub/requests/eventRequests',
            type: 'POST', // or 'GET' depending on your needs
            data: {

            },
            success: function (response) { //echo 1   
                // console.log("AJAX request successful:", response);
                $("#requests-content").html(response);
            },
            error: function (error) {
                // console.error("AJAX request failed:", error);
            }
        });
    });
</script>