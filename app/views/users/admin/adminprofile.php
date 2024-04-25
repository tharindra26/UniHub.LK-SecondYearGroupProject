<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/adminprofile_style.css">

<div class=" admin-section">
    <!--menu section start-->
    <menu>
        <div class="top">
            <div class="sidebar-action">
                <span><i class="fa-solid fa-xmark sidebar-close"></i></span>
                <span><i class="fa-solid fa-bars sidebar-toggle"></i></span>
            </div>
            <!-- <div class="admin-logo">
                <span><i class="fa-solid fa-user-gear"></i></span>
            </div> 
            <div class="profile-head">
                <h2><span class="heading">ADMIN PROFILE</span></h2>
            </div>
             -->

        </div>
        <!--end top -->

        <div class="option-menu">
            <a href="#" id="dashboard-btn" class="active">
                <span><i class="fa-solid fa-grip"></i></span>
                <h3>Dashboard</h3>
            </a>
            <a href="#" id="user-accounts-btn">
                <span><i class="fa-solid fa-users-gear"></i></span>
                <h3>User Accounts</h3>
            </a>
            <a href="#" id="events-btn">
                <span><i class="fa-solid fa-grip"></i></span>
                <h3>Events</h3>
            </a>
            <a href="#" id="organizations-btn">
                <span><i class="fa-solid fa-grip"></i></span>
                <h3>Organizations</h3>
            </a>
            <a href="#" id="posts-btn">
                <span><i class="fa-solid fa-grip"></i></span>
                <h3>Posts</h3>
            </a>
            <a href="#" id="opportunities-btn">
                <span><i class="fa-solid fa-grip"></i></span>
                <h3>Opportunities</h3>
            </a>
            <a href="#" id="university-btn">
                <span><i class="fa-solid fa-graduation-cap"></i></span>
                <h3>Universities</h3>
            </a>
            <a href="#" id="requests-btn">
                <span><i class="fa-solid fa-grip"></i></span>
                <h3>Requests</h3>
                <span class="rq_count">14</span>
            </a>
            <a href="#" id="reports-btn">
                <span><i class="fa-solid fa-circle-exclamation"></i></span>
                <h3>Inqueries</h3>
                <span class="rq_count">20</span>
            </a>
            <a href="#" id="settings-btn">
                <span><i class="fa-solid fa-gear"></i></span>
                <h3>Settings</h3>
            </a>
        </div>
    </menu>
    <!--menu section ends-->

    <!--main section start-->
    <main id="main-id" class="main-class">
        <?php require APPROOT . '/views/users/admin/dashboard.php'; ?>
    </main>
    <!--main section start-->

</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?php echo URLROOT ?>/js/users/admin/adminprofile.js"></script>

<script>

    


    $(document).ready(function () {
        // Add click event to the button
        $("#dashboard-btn").on("click", function (e) {
            //
            e.preventDefault(); // Prevent the default link behavior
            // // Your AJAX function here
            $.ajax({
                url: 'http://localhost/unihub/users/dashboard',
                type: 'POST', // or 'GET' depending on your needs
                data: {

                },
                success: function (response) { //echo 1   
                    // console.log("AJAX request successful:", response);
                    $("#main-id").html(response);
                },
                error: function (error) {
                    // console.error("AJAX request failed:", error);
                }
            });
        });
        // checkEventParticipation();

        $("#user-accounts-btn").on("click", function (e) {

            e.preventDefault(); // Prevent the default link behavior
            // // Your AJAX function here
            $.ajax({
                url: 'http://localhost/unihub/users/useraccounts',
                type: 'POST', // or 'GET' depending on your needs
                data: {

                },
                success: function (response) { //echo 1
                    // console.log("AJAX request successful:", response);
                    $("#main-id").html(response);
                },
                error: function (error) {
                    // console.error("AJAX request failed:", error);
                }
            });
        });

        $("#events-btn").on("click", function (e) {

            e.preventDefault(); // Prevent the default link behavior
            // // Your AJAX function here
            $.ajax({
                url: 'http://localhost/unihub/users/events',
                type: 'POST', // or 'GET' depending on your needs
                data: {

                },
                success: function (response) { //echo 1
                    // console.log("AJAX request successful:", response);
                    $("#main-id").html(response);
                },
                error: function (error) {
                    // console.error("AJAX request failed:", error);
                }
            });
        });

        $("#organizations-btn").on("click", function (e) {

            e.preventDefault(); // Prevent the default link behavior
            // // Your AJAX function here
            $.ajax({
                url: 'http://localhost/unihub/users/organizations',
                type: 'POST', // or 'GET' depending on your needs
                data: {

                },
                success: function (response) { //echo 1
                    // console.log("AJAX request successful:", response);
                    $("#main-id").html(response);
                },
                error: function (error) {
                    // console.error("AJAX request failed:", error);
                }
            });
        });

        $("#posts-btn").on("click", function (e) {

            e.preventDefault(); // Prevent the default link behavior
            // // Your AJAX function here
            $.ajax({
                url: 'http://localhost/unihub/users/posts',
                type: 'POST', // or 'GET' depending on your needs
                data: {

                },
                success: function (response) { //echo 1
                    // console.log("AJAX request successful:", response);
                    $("#main-id").html(response);
                },
                error: function (error) {
                    // console.error("AJAX request failed:", error);
                }
            });
        });

        $("#opportunities-btn").on("click", function (e) {

            e.preventDefault(); // Prevent the default link behavior
            // // Your AJAX function here
            $.ajax({
                url: 'http://localhost/unihub/users/opportunities',
                type: 'POST', // or 'GET' depending on your needs
                data: {

                },
                success: function (response) { //echo 1
                    // console.log("AJAX request successful:", response);
                    $("#main-id").html(response);
                },
                error: function (error) {
                    // console.error("AJAX request failed:", error);
                }
            });
        });

        $("#requests-btn").on("click", function (e) {

            e.preventDefault(); // Prevent the default link behavior
            // // Your AJAX function here
            $.ajax({
                url: 'http://localhost/unihub/users/requests',
                type: 'POST', // or 'GET' depending on your needs
                data: {

                },
                success: function (response) { //echo 1
                    // console.log("AJAX request successful:", response);
                    $("#main-id").html(response);
                },
                error: function (error) {
                    // console.error("AJAX request failed:", error);
                }
            });
        });

        $("#reports-btn").on("click", function (e) {

            e.preventDefault(); // Prevent the default link behavior
            // // Your AJAX function here
            $.ajax({
                url: 'http://localhost/unihub/users/reports',
                type: 'POST', // or 'GET' depending on your needs
                data: {

                },
                success: function (response) { //echo 1
                    // console.log("AJAX request successful:", response);
                    $("#main-id").html(response);
                },
                error: function (error) {
                    // console.error("AJAX request failed:", error);
                }
            });
        });

        $(document).ready(function () {
            // Add click event to the button
            $("#settings-btn").on("click", function (e) {

                e.preventDefault(); // Prevent the default link behavior
                // // Your AJAX function here
                $.ajax({
                    url: 'http://localhost/unihub/users/settings',
                    type: 'POST', // or 'GET' depending on your needs
                    data: {

                    },
                    success: function (response) { //echo 1
                        // console.log("AJAX request successful:", response);
                        $("#main-id").html(response);
                    },
                    error: function (error) {
                        // console.error("AJAX request failed:", error);
                    }
                });
            });
            // checkEventParticipation();
        });
    });

</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>