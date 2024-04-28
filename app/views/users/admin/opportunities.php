<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- <link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/adminprofile_style.css"> -->
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/opportunities_style.css">
<h1 class="section-title">Opportunities</h1>

<div class="summary">
    <div class="box total" id="all" onclick="mainEventFilter('');">
        <div class="box-content">
            <h3>All Opportunities</h3>
        </div>
        <div class="">
            <span class="tot" data-val="<?php echo $data['totalOpportunities'] ?>">0000</span>
        </div>
        <div class="box-icon">
            <i class="fa-solid fa-calendar-days"></i>
        </div>
    </div>
    <div class="box ongoing" id="ongoing" onclick="mainEventFilter('approved');">
        <div class="box-content">
            <h3>Published Opportunities</h3>
        </div>
        <div class="">
            <span class="tot" data-val="<?php echo $data['publishedOpportunities'] ?>">0000</span>
        </div>
        <div class="box-icon">
            <i class="fa-solid fa-calendar-check"></i>
        </div>
    </div>
    <div class="box due" id="due" onclick="mainEventFilter('pending');">
        <div class="box-content">
            <h3>Pending Opportunities</h3>
        </div>
        <div class="">
            <span class="tot" data-val="<?php echo $data['pendingOpportunities'] ?>">0000</span>
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
    <div class="option filter filter1">
        <div class="filter-text">Type:</div>
        <select name="type" id="type-filter-value" placeholder="Type" class="dropdown-menu">
            <option value="">None</option>
            <option value="Intern">Intern</option>
            <option value="Full-Time">Full-Time</option>
            <option value="Part-Time">Part-Time</option>
        </select>
    </div>

</div>

<div class="summary">
    <div class="option filter" onclick="generateOpportunitiesPDF()" >
        <div class="print-btn">
            <i class="fa-solid fa-print"></i>
            <div class="print-btn-txt">Print Table</div>
        </div>
    </div>

    <div class="option filter filter1">
        <div class="filter-text">Approval:</div>
        <select name="approval" id="approval-filter-value" placeholder="Approval" class="dropdown-menu">
            <option value="">None</option>
            <option value="approved">Approved</option>
            <option value="pending">Pending</option>
            <option value="rejected">Rejected</option>
        </select>
    </div>
    <div class="option filter filter1">
        <div class="filter-text">Status:</div>
        <select name="status" id="status-filter-value" class="dropdown-menu">
            <option value="0">None</option>
            <option value="activated">Activated</option>
            <option value="deactivated">Deactivated</option>
        </select>
    </div>
</div>

<!-- <div class="user-info"> -->

<div class="users" id="opportunity-filter-table">

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>


    var URLROOT = document.querySelector('.urlRootValue').textContent.trim();

    // Function to gather and handle all filter inputs
    function handleOpportunityFilters() {
        var searchInputValue = $('#search-bar-input').val();
        var selectedType = $('#type-filter-value').val();
        var selectedApproval = $('#approval-filter-value').val();
        var selectedStatus = $('#status-filter-value').val();

        if (searchInputValue === "") {
            searchInputValue = null;
        }

        if (selectedApproval === "None") {
            selectedApproval = null;
        }
        if (selectedType === "None") {
            selectedType = null;
        }
        if (selectedStatus === "None") {
            selectedStatus = null;
        }

        // Perform any action you need with these values
        // For example, make an AJAX request to fetch filtered events based on these inputs
        // You can pass these values as parameters to your AJAX request
        $.ajax({
            type: 'POST',
            url: URLROOT + '/opportunities/filterOpportunities',
            data: {
                keyword: searchInputValue,
                opportunityType: selectedType,
                approval: selectedApproval,
                status: selectedStatus
            },
            success: function (response) {
                // Update the like count in the DOM
                $("#opportunity-filter-table").html(response);
            },
            error: function (xhr, status, error) {
                console.error('Fail to retreive:', error);
            }
        });
    }
    handleOpportunityFilters();

    // Listen for changes in the search input
    $('#search-bar-input').on('input', function () {
        handleOpportunityFilters();
    });

    // Listen for changes in the approval dropdown
    $('#type-filter-value').on('change', function () {
        handleOpportunityFilters();
    });

    // Listen for changes in the approval dropdown
    $('#approval-filter-value').on('change', function () {
        handleOpportunityFilters();
    });

    // Listen for changes in the status dropdown
    $('#status-filter-value').on('change', function () {
        handleOpportunityFilters();
    });

    // Function to reset other filters to default values
    function resetOtherFilters() {
        // Reset search input
        document.getElementById("search-bar-input").value = "";

        // Reset university filter to default
        document.getElementById("type-filter-value").value = "";

        // Reset approval filter to default
        document.getElementById("category-filter-value").value = "";

        // Reset status filter to default
        document.getElementById("status-filter-value").value = "";
    }
    function mainEventFilter(type) {
        // Reset other filters to default values
        //resetOtherFilters();
        // Make AJAX request with the selected filter type
        $.ajax({
            url: URLROOT + '/opportunities/filterOpportunities',
            type: "POST",
            data: {
                approval: type,
                keyword: '',
                opportunityType: '',
                status: '0',
            },
            success: function (response) {
                // Update the content section with the retrieved data
                $("#opportunity-filter-table").html(response);
                resetOtherFilters()
            },
            error: function (error) {
                console.error("Error:", error);
            },
        });

        //handleFilters();
    }

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

    function generateOpportunitiesPDF() {
        var element = document.getElementById('opportunity-filter-table'); // Get the table element
        var opt = {
            margin: 1,
            filename: 'opportunities-table.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'A3', orientation: 'landscape' }
        };
        var pdf = new html2pdf(element, opt); // Create HTML2PDF instance
        pdf.save(); // Save the PDF
    }
</script>