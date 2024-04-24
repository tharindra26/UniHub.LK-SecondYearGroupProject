<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/adminprofile_style.css">
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/dashboard_style.css">

<h1 class="section-title">Dashboard</h1>

<div class="dashboard-area">
    <div class="summary">
        <div class="box box1">
            <div class="summary-content">
                <span class="num" data-val="2240"><?php echo $data['usersCount'] ?></span>
                <h3>Users</h3>
            </div>
            <div class="icons"><i class="fa-solid fa-users"></i></div>
        </div>

        <div class="box">
            <div class="summary-content">
                <span class="num" data-val="2240"><?php echo $data['eventsCount'] ?></span>
                <h3>Events</h3>
            </div>
            <div class="icons"><i class="fa-solid fa-calendar-week"></i></div>
        </div>

        <div class="box">
            <div class="summary-content">
                <span class="num" data-val="2240"><?php echo $data['organizationsCount'] ?></span>
                <h3>Organizations</h3>
            </div>
            <div class="icons"><i class="fa-solid fa-sitemap"></i></div>
        </div>

        <div class="box">
            <div class="summary-content">
                <span class="num" data-val="2240"><?php echo $data['postsCount'] ?></span>
                <h3>Posts</h3>
            </div>
            <div class="icons"><i class="fa-solid fa-file-signature"></i></div>
        </div>

        <div class="box">
            <div class="summary-content">
                <span class="num" data-val="2240"><?php echo $data['opportunitiesCount'] ?></span>
                <h3>Opportunities</h3>
            </div>
            <div class="icons"><i class="fa-solid fa-school"></i></div>
        </div>
    </div>
    <div class="chart-row">
        <div class="chart-section"><canvas id="loginDataChart"></canvas></div>
    </div>


</div>


<?php
$labels = [];
$logins = [];

// Get the last 30 days
$startDate = new DateTime('-30 days');
$endDate = new DateTime();
$interval = new DateInterval('P1D'); // 1 day interval
$period = new DatePeriod($startDate, $interval, $endDate);

// Loop through each day in the period
foreach ($period as $date) {
    $formattedDate = $date->format('Y-m-d');
    $labels[] = $formattedDate; // Add the date to labels array
    $logins[] = isset($data['loginData'][$formattedDate]) ? $data['loginData'][$formattedDate] : 0; // Add the corresponding login count
}
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?php echo URLROOT ?>/js/users/admin/dashboard.js"></script>
<script>

    var URLROOT = document.querySelector('.urlRootValue').textContent.trim();
    function initializeCharts() {
        const loginDataChart = document.getElementById('loginDataChart');

        new Chart(loginDataChart, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Login Data',
                    data: <?php echo json_encode($logins); ?>,
                    borderWidth: 3,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
                    pointRadius: 0 // Set pointRadius to 0 to remove dots
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var URLROOT = document.querySelector('.urlRootValue').textContent.trim();



    }

    // Call the function to initialize the charts when the page loads
    initializeCharts();

</script>