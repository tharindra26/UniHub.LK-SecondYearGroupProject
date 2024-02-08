<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<link rel="stylesheet" href="<?php echo URLROOT ?>/css/knowledgehub/knowledgehubs-index_style.css">

    <!-- header -->
    <div class="Main-box">
        <div class="cover-image">
            <img class="image" src=" <?php echo URLROOT ?>/img/knowledgehub/knowledgehub_home/header-image.png" alt="">
            <div class="title-overlay">
                <h1>Knowledge Hub</h1>
            </div>
        </div>

        <div class="container">
            <div class="search-bar-container">
                <form action="" class="search-bar">
                    <input type="text" name="" id="" placeholder="Search anything">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>


<!-- Quick-shortcut-bar -->
        <div class="container">
            <div class="shortcut-bar">
                <div class="section-name">KnowledgeHub</div>
                <div class="shortcut-options">
                    <div class="option">Blogs</div>
                    <div class="option">Kuppi</div>
                    <div class="option">Posts</div>
                </div>
            </div>
        </div>
<!-- Quick-shortcut-bar -->

        
        <div class="container">

            <div class="details-section">

                <div class="left-section">



                    <!-- <div class="tilte">
                        <a href="#" class="link">
                            <div class="text">
                                <i class="fa-solid fa-plus plus-mark"></i>&nbsp Add Post...
                            </div>
                        </a>
                    </div> -->

                    <a href="#">
                        <div class="add_item_button">
                            <i class="fa-solid fa-plus"></i>
                          <span>Add Here</span>
                        </div>
                    </a>  
                    
                    <!-- university-filter -->
                    <div class="uni-filter ">
                        <div class="select-btn">
                            <span>Select University</span>
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                        <div class="uni-filter-content">
                            <div class="uni-reset-btn">Reset</div>
                            <div class="uni-filter-search">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <input type="text" placeholder="Search" id="">
                            </div>
                            <ul class="uni-filter-options">
                            </ul>
                        </div>     
                    </div>
                    <!-- university-filter -->

                    <!-- date filter -->
                    <div class="date-filter">
                        <input type="date" name="" id="date-input">
                        <span class="date-reset-btn"  onclick="resetDate()">Reset Date</span>
                    </div>
                    <!-- date filter -->

                    <!-- category filter -->
                    <div class="category-filter">
                        <div class="category-select-btn">
                            <span class="category-btn-txt">Select Category</span>
                            <span class="arrow-dwn">
                                <i class="fa-solid fa-angle-down"></i>
                            </span> 
                        </div>

                        <ul class="list-items">
                            <div class="category-reset-btn">Reset</div>
                            <li class="item">
                                <span class="checkbox">
                                    <i class="fa-solid fa-check check-icon"></i>
                                </span>
                                <span class="item-text">Hackathon</span>
                            </li>

                            <li class="item">
                                <span class="checkbox">
                                    <i class="fa-solid fa-check check-icon"></i>
                                </span>
                                <span class="item-text">Musical Show</span>
                            </li>
                        </ul>
                    </div>
                <!-- category filter -->

                </div>


                <div class="middle-section" id="card_parent">
                <?php if (!empty($data['knowledgehubs'][0]->id)) : ?> 
                    <?php foreach ($data['knowledgehubs'] as $knowledgehubs) : ?>

                    <div class="card">
                        <div class="image_box">
                            <img class="post_image" src="<?php echo URLROOT ?>/img/knowledgehub/knowledgehub_home/<?php echo $knowledgehubs -> image ?>" alt="">
                        </div>
                        <div class="card_details">
                            <div class="card_header">
                                <h2><?php echo $knowledgehubs -> title ?></h2>
                            </div>
                            <div class="details">
                                <p> <?php echo $knowledgehubs -> description ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <?php endforeach; ?>
                <?php endif; ?>
    
    
                </div>
                <!-- <div class="right-section"></div> -->
            </div>
        </div>

    </div>

        
    

    <!-- header -->



<script src="<?php echo URLROOT ?>/js/knowledegehub/knowledgehubs-index.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>