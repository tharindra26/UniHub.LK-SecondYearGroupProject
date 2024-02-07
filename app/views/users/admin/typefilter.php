<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/typefilter_style.css">
<h1 class="section-title"></h1>

<div class="container">
    <div class="search-bar-container">
        <form action="" class="search-bar">
            <input type="text" name="searchInput" placeholder="Search User" id="search-bar-input">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
</div>

<div class="filters">

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

<!-- status-filter -->
<div class="status-filter ">
        <div class="select-btn">
            <span id="statusSpan">Select Status</span>
            <i class="fa-solid fa-angle-down"></i>
        </div>
        <div class="status-filter-content">
            <div class="status-reset-btn">Reset</div>
            <ul class="status-filter-options"></ul>
        </div>
    </div>
<!-- -filter -->

</div>

<div class="table" id="filter-section" >
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
                <?php if (!empty($data['users'][0]->id)) : ?> 
                        <?php foreach ($data['users'] as $user)  : ?>
                            <tr>
                                <td><?php echo $user->fname , " " , $user->lname ?></td>
                                <td><?php echo $user->email ?></td>
                                <td><?php echo $user->type ?></td>
                                <td><?php
                                    if ($user->status == 1):
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

<script src="<?php echo URLROOT ?>/js/users/admin/typefilter.js"></script>