<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/adminprofile_style.css">
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/events_style.css">
<h1 class="section-title">Events</h1>

<div class="summary">
    <div class="box total">
        <div class="box-content">
            <h3>Total Events</h3>
        </div>
        <div class="">
            <span class="tot" data-val="2240">0000</span>
        </div>
        <div class="box-icon">
            <i class="fa-solid fa-calendar-days"></i>
        </div>
    </div>
    <div class="box active">
        <div class="box-content">
            <h3>Active Events</h3>
        </div>
        <div class="">
            <span class="tot" data-val="2240">0000</span>
        </div>
        <div class="box-icon">
            <i class="fa-solid fa-calendar-check"></i>
        </div>
    </div>
    <div class="box due">
        <div class="box-content">
            <h3>Due Events</h3>
        </div>
        <div class="">
            <span class="tot" data-val="2240">0000</span>
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
    <div class="option search">
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
    <!-- <div class="option btn">
        <a href="#">
            <div class="view-all-button">
                <i class="fa-solid fa-eye"></i>
                <span>View All Events</span>
            </div>
        </a>        
    </div>
    <div class="option btn">
        <a href="<?php echo URLROOT ?>/events/add">
            <div class="view-all-button">
                <i class="fa-solid fa-calendar-plus"></i>
                <span>Add New Event</span>
            </div>
        </a>                    
    </div> -->
</div>

<div class="summary">
    
</div>


<!-- <div class="user-info"> -->
            <div class="user-head">
                <h2>Recent Events</h2>
            </div>

<div class="users" id="events-filter-table">           
    <table class="user-table">
        <thead>
            <tr>
                <th>Event Title</th>
                <th>User ID</th>
                <th>Category</th>
                <th>Contact</th>
                <th>Approval</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data['events'][0]->id)) : ?> 
            <?php foreach ($data['events'] as $event):
                if (empty($event)):
                    break;
                endif;
                // $popupId = "popup" . $user->id; 
                $eventId = $event->id;?>
                    <tr>
                        <td><?php echo $event->title ?></td>
                        <td><?php echo $event->user_id ?></td>
                        <td><?php echo $event->category_name?></td>
                        <td><?php echo $event->contact_number ?></td>
                        <td><?php
                            if ($event->approval == "approved"):
                                echo "Approved";
                            elseif($event->approval == "rejected"):
                                echo "Rejected";
                            else:
                                echo "Pending";
                            endif;
                        ?></td>
                        <td><?php
                            if ($event->status == 1):
                                echo "Active";
                            else:
                                echo "Deactivated";
                            endif;
                        ?></td>
                        <td>
                            <a href="#" class="view"><i class="fa-solid fa-eye"></i></a>
                            <a href="#" class="update"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="#" class="delete"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>

                <?php endforeach; ?>
                <?php endif; ?>
                   
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?php echo URLROOT ?>/js/users/admin/events.js"></script>
</body>
</html>
