<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/events/change-contact-details_style.css">

<div class="container">
    <div class="inner-container">
        <div class="title-text">
            <p>Fill Extra Details For the Portfolio</p>
        </div>
        <div class="bottom-part">

            <div class="left-box">
                <div class="form-outer-box">
                    <form class="form" action="<?php echo URLROOT; ?>/users/generatePortfolio/<?php echo $_SESSION['user_id']?>" method="post"
                        enctype="multipart/form-data">

                        <div class="column">
                            <div class="input-box">
                                <label for="">Address</label>
                                <input type="text" name="address" value="<?php echo $data['address'] ?>" id=""
                                    placeholder="Enter your address">
                                <!-- <?php if (!empty($data['adress_err'])): ?>
                                <span class="error-message"><?php echo $data['adress_err']; ?></span>
                            <?php endif; ?> -->
                            </div>
                        </div>

                        <div class="column">
                            <div class="categories-section">
                                <H3>Choose Languages</H3>
                                <div class="column">
                                    <div class="input-box ">
                                        <label for="">Press ctrl to select multiple categories.</label>
                                        <div class="select-box category">

                                            <select name="languages[]" id="selection" multiple>
                                                <option hidden>Select Category</option>
                                                <option value="English">English</option>
                                                <option value="Sinhala">Sinhala</option>
                                                <option value="Tamil">Tamil</option>
                                                <option value="Japanese">Japanese</option>
                                            </select>


                                        </div>
                                        <?php if (!empty($data['language_err'])): ?>
                                            <span class="error-message">
                                                <?php echo $data['language_err']; ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="ref-section1">
                            <div class="heading">
                                <h3>Non Related References 01</h3>
                            </div>
                            <div class="column">
                                <div class="input-box">
                                    <label for="">Name</label>
                                    <input type="text" name="ref1_name" value="<?php echo $data['ref1_name'] ?>" id=""
                                        placeholder="Enter name">
                                    <!-- <?php if (!empty($data['ref1_name_err'])): ?>
                                <span class="error-message"><?php echo $data['ref1_name_err']; ?></span>
                            <?php endif; ?> -->
                                </div>
                                <div class="input-box">
                                    <label for="">Designation</label>
                                    <input type="text" name="ref1_designation"
                                        value="<?php echo $data['ref1_designation'] ?>" id=""
                                        placeholder="Enter designation">
                                    <!-- <?php if (!empty($data['ref1_designation_err'])): ?>
                                <span class="error-message"><?php echo $data['ref1_designation_err']; ?></span>
                            <?php endif; ?> -->
                                </div>
                            </div>
                            <div class="column">
                                <div class="input-box">
                                    <label for="">Company</label>
                                    <input type="text" name="ref1_company" value="<?php echo $data['ref1_company'] ?>"
                                        id="" placeholder="Enter Company Name">
                                    <!-- <?php if (!empty($data['ref1_company_err'])): ?>
                                <span class="error-message"><?php echo $data['ref1_company_err']; ?></span>
                            <?php endif; ?> -->
                                </div>
                                <div class="input-box">
                                    <label for="">Address</label>
                                    <input type="text" name="ref1_address" value="<?php echo $data['ref1_address'] ?>"
                                        id="" placeholder="Enter address">
                                    <!-- <?php if (!empty($data['ref1_address_err'])): ?>
                                <span class="error-message"><?php echo $data['ref1_address_err']; ?></span>
                            <?php endif; ?> -->
                                </div>
                            </div>
                            <div class="column">
                                <div class="input-box">
                                    <label for="">Contact Number</label>
                                    <input type="text" name="ref1_contact" value="<?php echo $data['ref1_contact'] ?>"
                                        id="" placeholder="Enter Contact Number">
                                    <!-- <?php if (!empty($data['ref1_contact_err'])): ?>
                                <span class="error-message"><?php echo $data['ref1_contact_err']; ?></span>
                            <?php endif; ?> -->
                                </div>
                                <div class="input-box">
                                    <label for="">Email</label>
                                    <input type="text" name="ref1_email" value="<?php echo $data['ref1_email'] ?>" id=""
                                        placeholder="Enter Email">
                                    <!-- <?php if (!empty($data['ref1_email_err'])): ?>
                                <span class="error-message"><?php echo $data['ref1_email_err']; ?></span>
                            <?php endif; ?> -->
                                </div>
                            </div>

                        </div>
                        <div class="ref-section2">
                            <div class="heading">
                                <h3>Non Related References 02</h3>
                            </div>
                            <div class="column">
                                <div class="input-box">
                                    <label for="">Name</label>
                                    <input type="text" name="ref2_name" value="<?php echo $data['ref2_name'] ?>" id=""
                                        placeholder="Enter name">
                                    <!-- <?php if (!empty($data['ref2_name_err'])): ?>
                                <span class="error-message"><?php echo $data['ref2_name_err']; ?></span>
                            <?php endif; ?> -->
                                </div>
                                <div class="input-box">
                                    <label for="">Designation</label>
                                    <input type="text" name="ref2_designation"
                                        value="<?php echo $data['ref2_designation'] ?>" id=""
                                        placeholder="Enter designation">
                                    <!-- <?php if (!empty($data['ref2_designation_err'])): ?>
                                <span class="error-message"><?php echo $data['ref2_designation_err']; ?></span>
                            <?php endif; ?> -->
                                </div>
                            </div>
                            <div class="column">
                                <div class="input-box">
                                    <label for="">Company</label>
                                    <input type="text" name="ref2_company" value="<?php echo $data['ref2_company'] ?>"
                                        id="" placeholder="Enter Company Name">
                                    <!-- <?php if (!empty($data['ref2_company_err'])): ?>
                                <span class="error-message"><?php echo $data['ref2_company_err']; ?></span>
                            <?php endif; ?> -->
                                </div>
                                <div class="input-box">
                                    <label for="">Address</label>
                                    <input type="text" name="ref2_address" value="<?php echo $data['ref2_address'] ?>"
                                        id="" placeholder="Enter address">
                                    <!-- <?php if (!empty($data['ref2_address_err'])): ?>
                                <span class="error-message"><?php echo $data['ref2_address_err']; ?></span>
                            <?php endif; ?> -->
                                </div>
                            </div>
                            <div class="column">
                                <div class="input-box">
                                    <label for="">Contact Number</label>
                                    <input type="text" name="ref2_contact" value="<?php echo $data['ref2_contact'] ?>"
                                        id="" placeholder="Enter Contact Number">
                                    <!-- <?php if (!empty($data['ref2-contact_err'])): ?>
                                <span class="error-message"><?php echo $data['ref2_contact_err']; ?></span>
                            <?php endif; ?> -->
                                </div>
                                <div class="input-box">
                                    <label for="">Email</label>
                                    <input type="text" name="ref2_email" value="<?php echo $data['ref2_email'] ?>" id=""
                                        placeholder="Enter Email">
                                    <!-- <?php if (!empty($data['ref2_email_err'])): ?>
                                <span class="error-message"><?php echo $data['ref2_email_err']; ?></span>
                            <?php endif; ?> -->
                                </div>
                            </div>

                        </div>

                        <button class="submit-btn" type="submit">Preview Portfolio</button>
                    </form>
                </div>
            </div>
            <div class="image-section">
                <img src="<?php echo URLROOT ?>/img/events/event-add/event-add-image.jpg" alt="" srcset="">
            </div>
        </div>

    </div>


</div>



<script src="<?php echo URLROOT ?>/js/events/event-add.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>