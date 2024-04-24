<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/adminprofile_style.css">
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/events_style.css">
<h1 class="section-title">Organization</h1>
<div class="summary">
    <div class="box total" id="all" onclick = "mainOrganizationFilter('all');">
        <div class="box-content">
            <h3>All Organizations</h3>
        </div>
        <div class="">
            <span class="tot" data-val="<?php echo $data['totalOrganizations']->total_organizations;?>">0000</span>
        </div>
        <div class="box-icon">
            <i class="fa-solid fa-calendar-days"></i>
        </div>
    </div>
</div>
<div class="summary">
    <div class="option search">
        <div class="search-bar-container">
            <form action="" class="search-bar">
                <input type="text" name="searchInput" placeholder="Search Organization" id="search-bar-input">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>        
                
    </div>
     <!-- university-filter -->
    <div class="option select-uni filter">
        <select name="university" id="uni-filter-value" onchange="selectUni(this.options[this.selectedIndex].value)" placeholder="Approval" class="dropdown-menu">
         <option value="">All Universities</option>
            <?php if (!empty($data['universities'])) : ?> 
                <?php foreach ($data['universities'] as $uni) : ?>    
                    <option value="<?php echo $uni->name ?>"><?php echo $uni->name ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
           
        </select>         
    </div>
    
    
</div>

<div class="summary">
    <div class="option table-heading">
        <div class="user-head">
            <h2>All Organizations</h2>
        </div>
    </div>
    <div class="option filter">
        <select name="category" id="category-filter-value" onchange="selectCategory(this.options[this.selectedIndex].value)" placeholder="Approval" class="dropdown-menu">
            <option value="">All Categories</option>
            <?php if (!empty($data['categories'])) : ?> 
                <?php foreach ($data['categories'] as $catogery) : ?>    
                    <option value="<?php echo $catogery->category_id ?>"><?php echo $catogery->category_name ?></option>
                <?php endforeach; ?>
                <?php else : ?>
                <option value="">No universities found</option>
            <?php endif; ?>
           
        </select>
    </div>
    <div class="option filter">
        <select name="status" id="status-filter-value" onchange="selectStatus(this.options[this.selectedIndex].value)" class="dropdown-menu"> 
            <option value="">All Organizations</option>
            <option value="active">Active</option>
            <option value="deactivated">Deactivated</option>
        </select>
    </div>
</div>

<!-- <div class="user-info"> -->
            
<div class="users" id="organizations-filter-table">           
   
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?php echo URLROOT ?>/js/users/admin/organizations.js"></script>
</body>
</html>

