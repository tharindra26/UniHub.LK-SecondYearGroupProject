<!-- sample commit -->
<?php $jsonData = json_encode($data['user']); ?>
<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/adminprofile_style.css">
<h1 class="section-title">User Accounts</h1>

<div class="sub-menu">
    <div class="items" id="all" onclick="typeFilter('');">
        <div class="item-header">
            <span class="tot" data-val="<?php echo $data['numberOfAllUsers'] ?>">0000</span>
            <h3>All Users</h3>
        </div>
        <div class="icons"><i class="fa-solid fa-user-graduate"></i></div>
    </div>
    <div class="items" id="und" onclick="typeFilter('undergraduate');">
        <div class="item-header">
            <span class="tot" data-val="<?php echo $data['numberOfUndergraduates'] ?>">0000</span>
            <h3>Undergraduates</h3>
        </div>
        <div class="icons"><i class="fa-solid fa-user-graduate"></i></div>
    </div>

    <div class="items" id="uni-rep" onclick="typeFilter('unirep');">
        <div class="item-header">
            <span class="tot" data-val="<?php echo $data['numberOfUnireps'] ?>">000</span>
            <h3>Uni Representors</h3>
        </div>
        <div class="icons"><i class="fa-solid fa-users-gear"></i></div>

    </div>

    <div class="items" id="org-rep" onclick="typeFilter('orgrep');">
        <div class="item-header">
            <span class="tot" data-val="<?php echo $data['numberOfOrgreps'] ?>">000</span>
            <h3>Org Representors</h3>
        </div>
        <div class="icons"><i class="fa-solid fa-users"></i></div>
    </div>

    <div class="items" id="admin" onclick="typeFilter('admin');">
        <div class="item-header">
            <span class="tot" data-val="<?php echo $data['numberOfAdmins'] ?>">00</span>
            <h3>Administrators</h3>
        </div>
        <div class="icons"><i class="fa-solid fa-user-gear"></i></div>
    </div>
</div>

<!-- <div class="user-info"> -->

<div class="summary">
    <div class="option search">
        <div class="search-bar-container">
            <form action="" class="search-bar">
                <input type="text" name="searchInput" placeholder="Search Event" id="search-bar-input">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

    </div>
    <!-- university-filter -->
    <div class="option select-uni filter">
        <div class="filter-text">University:</div>
        <select name="university" id="uni-filter-value" placeholder=" Approval" class="dropdown-menu">
            <option value="">None</option>
            <?php if (!empty($data['universities'])): ?>
                <?php foreach ($data['universities'] as $uni): ?>
                    <option value="<?php echo $uni->id ?>"><?php echo $uni->name ?></option>
                <?php endforeach; ?>
            <?php endif; ?>

        </select>

    </div>


</div>

<div class="summary">
    <div class="option table-heading">
    </div>
    <div class="option filter filter1" onclick="addUserForm()">
        <div class="add-user-btn">
            <i class="fa-solid fa-user-plus"></i>
            <div class="add-user-btn-txt">New User</div>
        </div>
    </div>

    <div class="option filter filter1">
        <div class="filter-text">Type:</div>
        <select name="status" id="type-filter-value" class="dropdown-menu">
            <option value="">All</option>
            <option value="admin">Admin</option>
            <option value="unirep">University Representative</option>
            <option value="orgrep">Organization Representative</option>
            <option value="undergraduate">Undergraduate</option>
        </select>
    </div>

    <div class="option filter filter1">
        <div class="filter-text">Status:</div>
        <select name="status" id="status-filter-value" class="dropdown-menu">
            <option value="">None</option>
            <option value="activated">Activated</option>
            <option value="deactivated">Deactivated</option>
        </select>
    </div>



</div>

<!-- Search-bar -->

</div>

<!-- user table -->
<div class="users" id="filter-table">

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    function initializeCount() {
        totalValue = document.querySelectorAll(".tot");
        let timeinterval = 200;

        totalValue.forEach((valueDisplay) => {
            let startValue = 0;
            let endValue = parseInt(valueDisplay.getAttribute("data-val"));
            let duration = Math.floor(timeinterval / endValue);

            // If endValue is zero, set the text content immediately and return
            if (endValue === 0) {
                valueDisplay.textContent = 0;
                return;
            }

            let counter = setInterval(() => {
                startValue += 1;
                valueDisplay.textContent = startValue;
                if (startValue === endValue) {
                    clearInterval(counter);
                }
            }, duration);
        });
    }

    initializeCount();

    function typeFilter(type) {
        $.ajax({
            type: 'POST',
            url: URLROOT + '/users/filterUsers',
            data: {
                type: type,
                keyword: '',
                status: '',
                universityId: ''
            },
            success: function (response) {
                // Update the user table with the filtered results
                $("#filter-table").html(response);
                resetOtherFilters();
            },
            error: function (xhr, status, error) {
                console.error('Failed to retrieve:', error);
            }
        });
    }

    function handleUserFilters() {
        var searchInputValue = $('#search-bar-input').val();
        var selectedUniversity = $('#uni-filter-value').val();
        var selectedStatus = $('#status-filter-value').val();
        var selectedType = $('#type-filter-value').val();

        if (searchInputValue === "") {
            searchInputValue = null;
        }

        // Check if the selected values are "None" and set them to null
        if (selectedUniversity === "None") {
            selectedUniversity = null;
        }
        if (selectedStatus === "None") {
            selectedStatus = null;
        }
        if (selectedType === "None") {
            selectedType = null;
        }


        $.ajax({
            type: 'POST',
            url: URLROOT + '/users/filterUsers',
            data: {
                type: selectedType,
                keyword: searchInputValue,
                status: selectedStatus,
                universityId: selectedUniversity
            },
            success: function (response) {
                // Update the user table with the filtered results
                $("#filter-table").html(response);
            },
            error: function (xhr, status, error) {
                console.error('Failed to retrieve:', error);
            }
        });
    }
    handleUserFilters();

    // Listen for changes in the search input
    $('#search-bar-input').on('input', function () {
        handleUserFilters();
    });

    // Listen for changes in the university dropdown
    $('#uni-filter-value').on('change', function () {
        handleUserFilters();
    });

    // Listen for changes in the status dropdown
    $('#status-filter-value').on('change', function () {
        handleUserFilters();
    });

    $('#type-filter-value').on('change', function () {
        handleUserFilters();
    });

    // Function to reset other filters to default values
    function resetOtherFilters() {
        // Reset search input
        document.getElementById("search-bar-input").value = "";

        // Reset university filter to default
        document.getElementById("uni-filter-value").value = "";

        // Reset approval filter to default
        document.getElementById("category-filter-value").value = "";

        // Reset status filter to default
        document.getElementById("status-filter-value").value = "";

        document.getElementById("type-filter-value").value = "";
    }

    function addUserForm() {
        $.ajax({
            url: URLROOT + '/users/addUserForm',
            type: "POST",
            data: {

            },
            success: function (response) {
                // Update the content section with the retrieved data
                $("#filter-table").html(response);
            },
            error: function (error) {

                console.error("Error:", error);
            },
        });
    }


</script>