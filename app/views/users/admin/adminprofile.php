<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/adminprofile_style.css">

<div class="container admin-section">
    <!--menu section start-->
    <menu>
        <div class="top">
            <div class="admin-logo">
                <span><i class="fa-solid fa-user-gear"></i></span>
            </div>
            <div class="profile-head">
                <h2><span class="heading">ADMIN PROFILE</span></h2>
            </div>
            <div class="close">
                <span><i class="fa-solid fa-xmark"></i></span>
            </div>
        </div>
        <!--end top -->

        <div class="option-menu">
            <a href="#">
                <span><i class="fa-solid fa-grip"></i></span>
                <h3>Dashboard</h3>
            </a>
            <a href="#" class="active">
                <span><i class="fa-solid fa-users-gear"></i></span>
                <h3>User Accounts</h3>
            </a>
            <a href="#">
                <span><i class="fa-solid fa-grip"></i></span>
                <h3>Events</h3>
            </a>
            <a href="#">
                <span><i class="fa-solid fa-grip"></i></span>
                <h3>Organizations</h3>
            </a>
            <a href="#">
                <span><i class="fa-solid fa-grip"></i></span>
                <h3>Knowledge Hub</h3>
            </a>
            <a href="#">
                <span><i class="fa-solid fa-grip"></i></span>
                <h3>Oppurtunities</h3>
            </a>
            <a href="#">
                <span><i class="fa-solid fa-grip"></i></span>
                <h3>Requests</h3>
                <span class="rq_count">14</span>
            </a>
            <a href="#">
                <span><i class="fa-solid fa-circle-exclamation"></i></span>
                <h3>Reports</h3>
                <span class="rq_count">20</span>
            </a>
            <a href="#">
                <span><i class="fa-solid fa-gear"></i></span>
                <h3>Settings</h3>
            </a>
        </div>
    </menu>
    <!--menu section ends-->

    <!--main section start-->
    <main id="main-id">
        <h1>User Accounts</h1>

        <div class="sub-menu">
            <div class="items">

                    <span><i class="fa-solid fa-user-graduate"></i></span>
                    <span class="num" data-val="2240">0000</span>
                    <h3>Undergraduates</h3>

            </div>
            
            <div class="items">

                    <span><i class="fa-solid fa-users-gear"></i></span>
                    <span class="num" data-val="340">000</span>
                    <h3>Uni Representors</h3>

            </div>
            
            <div class="items">

                    <span><i class="fa-solid fa-users"></i></span>
                    <span class="num" data-val="250">000</span>
                    <h3>Org Representors</h3>

            </div>
            
            <div class="items">
                    <span><i class="fa-solid fa-user-gear"></i></span>
                    <span class="num" data-val="12">00</span>
                    <h3>Administrators</h3>
            </div>
            
        </div>

        <div class="user-info">
            <h2>All Users</h2>
            <table class="user-table">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Account Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Viruli Weerasinghe</td>
                        <td>viruliweerasinghe@gmail.com</td>
                        <td>Active</td>
                        <td>
                        <a href="#" class="view">View</a>
                            <a href="#" class="update">Update</a>
                            <a href="#" class="delete">Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Viruli Weerasinghe</td>
                        <td>viruliweerasinghe@gmail.com</td>
                        <td>Active</td>
                        <td>
                        <a href="#" class="view">View</a>
                            <a href="#" class="update">Update</a>
                            <a href="#" class="delete">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    <!--main section start-->

</div>




<script src="<?php echo URLROOT?>/js/users/admin/adminprofile.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>

