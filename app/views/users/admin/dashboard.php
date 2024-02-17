
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/adminprofile_style.css">
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/dashboard_style.css">

<h1 class="section-title">Dashboard</h1>

<div class="dashboard-area">
    <div class="summary">
        <div class="box" >
            <div class="summary-content">
                <span class="num" data-val="2240">0000</span>
                <h3>Users</h3>
            </div>
            <div class="icons" ><i class="fa-solid fa-users"></i></div>   
        </div>

        <div class="box" >
            <div class="summary-content">
                <span class="num" data-val="2240">0000</span>
                <h3>Events</h3>
            </div>
            <div class="icons" ><i class="fa-solid fa-calendar-week"></i></div> 
         </div>

        <div class="box" >
            <div class="summary-content">
                <span class="num" data-val="2240">0000</span>
                <h3>Organizations</h3>
            </div>
            <div class="icons" ><i class="fa-solid fa-sitemap"></i></div> 
         </div>

        <div class="box" >
            <div class="summary-content">
                <span class="num" data-val="2240">0000</span>
                <h3>Posts</h3>
            </div>
            <div class="icons" ><i class="fa-solid fa-file-signature"></i></div> 
         </div>

        <div class="box" >
            <div class="summary-content">
                <span class="num" data-val="2240">0000</span>
                <h3>Opportunities</h3>
            </div>
            <div class="icons" ><i class="fa-solid fa-school"></i></div> 
         </div>
    </div>
    <div class="chart-row">
        <div class="chart-section"><canvas id="chart1"></canvas></div>
        <div class="chart-section"><canvas id="chart2"></canvas></div>
    </div>

    <div class="activity">
        <table class="user-table">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Account Type</th>
                    <th>Account Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Viruli Weerasinghe</td>
                    <td>viruliweerasinghe@gmail.com</td>
                    <td>Undergraduate</td>
                    <td>Active</td>
                    <td>Update Profile</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?php echo URLROOT ?>/js/users/admin/dashboard.js"></script>

