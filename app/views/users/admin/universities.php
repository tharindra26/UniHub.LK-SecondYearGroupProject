<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- <link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/adminprofile_style.css"> -->
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/events_style.css">
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/university_style.css">
<h1 class="section-title">Posts</h1>
<div class="summary">
    <div class="box total" id="all" onclick="mainUniversityFilter();">
        <div class="box-content">
            <h3>Total Universities</h3>
        </div>
        <div class="">
            <span class="tot" data-val="<?php echo $data['totalUniversities']; ?>">0000</span>
        </div>
        <div class="box-icon">
            <i class="fa-solid fa-building-columns"></i>
        </div>
    </div>



</div>
<div class="summary">
    <div class="option search">
        <div class="search-bar-container">
            <form action="" class="search-bar">
                <input type="text" name="searchInput" placeholder="Search Post" id="search-bar-university">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>
    <div class="option filter" onclick="generateUniversitiesPDF()" >
        <div class="print-btn">
            <i class="fa-solid fa-print"></i>
            <div class="print-btn-txt">Print Table</div>
        </div>
    </div>
    <div class="add-university-btn" onclick="addUniversityForm()">
        <i class="fa-solid fa-plus"></i>
        <div class="add-university-btn-txt">
            Add University
        </div>
    </div>
</div>

<div class="users" id="university-filter-table">
</div>


<div class="summary">
    <div class="box ongoing" id="published" onclick="mainDomainFilter();">
        <div class="box-content">
            <h3>University Domains</h3>
        </div>
        <div class="">
            <span class="tot" data-val="<?php echo $data['totalDomains']; ?>">0</span>
        </div>
        <div class="box-icon">
            <i class="fa-solid fa-link"></i>
        </div>
    </div>
</div>
<div class="summary">
    <div class="option search">
        <div class="search-bar-container">
            <form action="" class="search-bar">
                <input type="text" name="searchInput" placeholder="Search Post" id="search-bar-unidomain">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>
    <div class="option select-uni filter">
        <div class="filter-text">University:</div>
        <select name="unidomain" id="unidomain-filter-value" placeholder=" Approval" class="dropdown-menu">
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
    <div class="option filter" onclick="generateUniversityDomainPDF()" >
        <div class="print-btn">
            <i class="fa-solid fa-print"></i>
            <div class="print-btn-txt">Print Table</div>
        </div>
    </div>
    <div class="add-university-btn" onclick="addUniDomainForm()">
        <i class="fa-solid fa-plus"></i>
        <div class="add-university-btn-txt">
            Add Domain
        </div>
    </div>
</div>

<div class="users" id="unidomain-filter-table">
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    var URLROOT = document.querySelector('.urlRootValue').textContent.trim();



    // Function to gather and handle all filter inputs
    function handleUniversityFilters() {
        var searchInputValue = $('#search-bar-university').val();


        if (searchInputValue === "") {
            searchInputValue = null;
        }


        $.ajax({
            type: 'POST',
            url: URLROOT + '/universities/filterUniversities',
            data: {
                keyword: searchInputValue
            },
            success: function (response) {
                // Update the like count in the DOM
                $("#university-filter-table").html(response);
            },
            error: function (xhr, status, error) {
                console.error('Fail to retreive:', error);
            }
        });
    }

    handleUniversityFilters();


    // Listen for changes in the search input
    $('#search-bar-university').on('input', function () {
        handleUniversityFilters();
    });

    // Function to reset other filters to default values
    function resetOtherUniversityFilters() {
        // Reset search input
        document.getElementById("search-bar-university").value = "";
    }

    function resetOtherDomainFilters() {
        // Reset search input
        document.getElementById("search-bar-unidomain").value = "";
        document.getElementById("unidomain-filter-value").value = "";
    }

    function mainUniversityFilter() {

        $.ajax({
            url: URLROOT + '/universities/filterUniversities',
            type: "POST",
            data: {
                keyword: '',
            },
            success: function (response) {
                // Update the content section with the retrieved data
                $("#university-filter-table").html(response);
                resetOtherUniversityFilters();
            },
            error: function (error) {
                console.error("Error:", error);
            },
        });
    }

    function mainDomainFilter() {

        $.ajax({
            url: URLROOT + '/universities/filterDomains',
            type: "POST",
            data: {
                keyword: '',
                university: ''
            },
            success: function (response) {
                // Update the content section with the retrieved data
                $("#unidomain-filter-table").html(response);
                resetOtherDomainFilters();
            },
            error: function (error) {
                console.error("Error:", error);
            },
        });
    }

    // Counter starts
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


    function handleUniDomainFilters() {
        var searchInputValue = $('#search-bar-unidomain').val();
        var selectedUniversityValue = $('#unidomain-filter-value').val();
        console.log(searchInputValue);

        if (searchInputValue === "") {
            searchInputValue = null;
        }
        if (selectedUniversityValue === "") {
            selectedUniversityValue = null;
        }

        $.ajax({
            type: 'POST',
            url: URLROOT + '/universities/filterDomains',
            data: {
                keyword: searchInputValue,
                university: selectedUniversityValue
            },
            success: function (response) {
                // Update the like count in the DOM
                $("#unidomain-filter-table").html(response);
            },
            error: function (xhr, status, error) {
                console.error('Fail to retreive:', error);
            }
        });
    }

    $('#search-bar-unidomain').on('input', function () {
        handleUniDomainFilters();
    });
    $('#unidomain-filter-value').on('input', function () {
        handleUniDomainFilters();
    });

    handleUniDomainFilters();

    function addUniversityForm() {
        $.ajax({
            url: URLROOT + '/universities/addUniversityForm',
            type: "POST",
            data: {

            },
            success: function (response) {
                // Update the content section with the retrieved data
                $("#university-filter-table").html(response);
            },
            error: function (error) {

                console.error("Error:", error);
            },
        });
    }

    function addUniDomainForm() {
        $.ajax({
            url: URLROOT + '/universities/addDomainForm',
            type: "POST",
            data: {

            },
            success: function (response) {
                // Update the content section with the retrieved data
                $("#unidomain-filter-table").html(response);
            },
            error: function (error) {

                console.error("Error:", error);
            },
        });
    }


    function generateUniversitiesPDF() {
        var element = document.getElementById('university-filter-table'); // Get the table element
        var opt = {
            margin: 1,
            filename: 'univerisities-table.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'A3', orientation: 'portrait' }
        };
        var pdf = new html2pdf(element, opt); // Create HTML2PDF instance
        pdf.save(); // Save the PDF
    }

    function generateUniversityDomainPDF() {
        var element = document.getElementById('unidomain-filter-table'); // Get the table element
        var opt = {
            margin: 1,
            filename: 'university-domains-table.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'A3', orientation: 'landscape' }
        };
        var pdf = new html2pdf(element, opt); // Create HTML2PDF instance
        pdf.save(); // Save the PDF
    }


</script>