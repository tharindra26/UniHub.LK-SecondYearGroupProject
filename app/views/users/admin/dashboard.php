
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/adminprofile_style.css">
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/dashboard_style.css">

<h1 class="section-title">Dashboard</h1>

<div class="dashbord-area">
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
    <!-- <div class="chart-row">
        <div class="chart-section">
            <h3>Organizations</h3>
            <canvas id="chart1"></canvas>
        </div>
        <div class="chart-section"><canvas id="chart2"></canvas></div>
    </div> -->
    <div class="chart-row">
        <div class="chart-section"><canvas id="chart1"></canvas></div>
        <div class="chart-section"><canvas id="chart2"></canvas></div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?php echo URLROOT ?>/js/users/admin/dashboard.js"></script>

