<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/adminprofile_style.css">

<h1 class="section-title">Dashboard</h1>

<div class="dashbord-area">
    <div class="chart-row">
        <div class="chart-section">
            <h3>Organizations</h3>
            <canvas id="chart1"></canvas>
        </div>
        <div class="chart-section"><canvas id="chart2"></canvas></div>
    </div>
    <div class="chart-row">
        <div class="chart-section"><canvas id="chart3"></canvas></div>
        <div class="chart-section"><canvas id="chart4"></canvas></div>
    </div>
    
    
    
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?php echo URLROOT ?>/js/users/admin/dashboard.js"></script>

</body>
</html>