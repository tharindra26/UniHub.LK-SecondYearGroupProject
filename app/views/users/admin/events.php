<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/adminprofile_style.css">
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/events_style.css">
<h1 class="section-title">Events</h1>
<div class="summary">
    <div class="box total" id="all" onclick = "mainEventFilter('all');">
        <div class="box-content">
            <h3>All Events</h3>
        </div>
        <div class="">
            <span class="tot" data-val="<?php echo $data['totalEvents']->total_events;?>">0000</span>
        </div>
        <div class="box-icon">
            <i class="fa-solid fa-calendar-days"></i>
        </div>
    </div>
    <div class="box ongoing" id="ongoing" onclick = "mainEventFilter('ongoing');">
        <div class="box-content">
            <h3>Ongoing Events</h3>
        </div>
        <div class="">
            <span class="tot" data-val="<?php echo $data['ongoingEvents']->ongoing_events;?>">0000</span>
        </div>
        <div class="box-icon">
            <i class="fa-solid fa-calendar-check"></i>
        </div>
    </div>
    <div class="box due" id="due" onclick = "mainEventFilter('due');">
        <div class="box-content">
            <h3>Due Events</h3>
        </div>
        <div class="">
            <span class="tot" data-val="<?php echo $data['dueEvents']->due_events;?>">0000</span>
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
    <div class="option select-uni">
        <!-- university-filter -->
        <div class="uni-filter ">
                <div class="select-btn">
                    <span id="universitySpan">Select University</span>
                    <i class="fa-solid fa-angle-down"></i>
                </div>
                <div class="uni-filter-content">
                    <div class="uni-reset-btn">Reset</div>
                    <div class="uni-filter-search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Search" id="">
                    </div>
                    <ul class="uni-filter-options"></ul>
                </div>
            </div>
            <!-- university-filter -->
    </div>
    
</div>

<div class="summary">
    <div class="option table-heading">
        <div class="user-head">
            <h2>Recent Events</h2>
        </div>
    </div>
    <div class="option filter">
        <select name="approval" onchange="selectData(this.options[this.selectedIndex].value)" placeholder="Approval" class="dropdown-menu">
            <option value="">Recent Events</option>
            <option value="approved">Approved</option>
            <option value="pending">Pending</option>
            <option value="rejected">Rejected</option>
        </select>
    </div>
    <div class="option filter">
        <select name="status" onchange="selectStatus(this.options[this.selectedIndex].value)" class="dropdown-menu"> 
            <option value="">All Events</option>
            <option value="active">Active</option>
            <option value="deactivated">Deactivated</option>
        </select>
    </div>
</div>

<!-- <div class="user-info"> -->
            
<div class="users" id="events-filter-table">           
   
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?php echo URLROOT ?>/js/users/admin/events.js"></script>
</body>
</html>
