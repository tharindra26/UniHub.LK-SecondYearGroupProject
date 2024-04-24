<!-- sample commit -->
<?php $jsonData = json_encode($data['user']); ?>
<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/adminprofile_style.css">
<h1 class="section-title">User Accounts</h1>

<div class="sub-menu">
    <div class="items" id="all" onclick="typefilter('all');">
        <div class="item-header">
            <span class="num" data-val="2240">0000</span>
            <h3>All Users</h3>
        </div>
        <div class="icons"><i class="fa-solid fa-user-graduate"></i></div>
    </div>
    <div class="items" id="und" onclick="typefilter('Undergraduate');">
        <div class="item-header">
            <span class="num" data-val="2240">0000</span>
            <h3>Undergraduates</h3>
        </div>
        <div class="icons"><i class="fa-solid fa-user-graduate"></i></div>
    </div>

    <div class="items" id="uni-rep" onclick="typefilter('uni-rep');">
        <div class="item-header">
            <span class="num" data-val="340">000</span>
            <h3>Uni Representors</h3>
        </div>
        <div class="icons"><i class="fa-solid fa-users-gear"></i></div>

    </div>

    <div class="items" id="org-rep" onclick="typefilter('org-rep');">
        <div class="item-header">
            <span class="num" data-val="250">000</span>
            <h3>Org Representors</h3>
        </div>
        <div class="icons"><i class="fa-solid fa-users"></i></div>
    </div>

    <div class="items" id="admin" onclick="typefilter('admin');">
        <div class="item-header">
            <span class="num" data-val="12">00</span>
            <h3>Administrators</h3>
        </div>
        <div class="icons"><i class="fa-solid fa-user-gear"></i></div>
    </div>
</div>

<!-- <div class="user-info"> -->

<div class="user-head">
    <!-- Search-bar -->

    <div class="option search-bar-container">
        <form action="" class="search-bar">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            <input type="text" name="searchInput" placeholder="Search users" id="search-bar-input">

        </form>
    </div>


</div>
<!-- Search-bar -->

</div>
<div class="add-user-btn" onclick="openPopup1('add-user-btn')">
    Add User
</div>

<!-- popupModal -->
<span class="overlay"></span>
<div class="modal-box" id="add-user-btn">
    <i class="fa-solid fa-toggle-off"></i>
</div>
<!-- popupModal -->
<!-- user table -->
<div class="users" id="filter-table">

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/users/admin/useraccounts.js"></script>
<script>
    // popup modal script
    const overlay = document.querySelector(".overlay");
    const modalBox = document.querySelector(".modal-box");

    function openPopup1(popupId) {
        alert("Popup");
        var element = document.getElementById(popupId);
        if (element) {
            element.classList.add("active");
            overlay.classList.add("active");
        }
    }

    function closePopup1(popupId) {
        var element = document.getElementById(popupId);
        if (element) {
            element.classList.remove("active");
            overlay.classList.remove("active");
        }
    }
    overlay.addEventListener("click", () => {
        modalBox.classList.remove("active");
        overlay.classList.remove("active");
    });

</script>