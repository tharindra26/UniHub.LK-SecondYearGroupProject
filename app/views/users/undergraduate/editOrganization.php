<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/events/change-contact-details_style.css">

<!-- Loading Spinner -->
<div class="spinner" id="spinner"></div>


<div class="container">
    <div class="inner-container">
        <div class="title-text">
            <p>Change Organization</p>
        </div>
        <div class="bottom-part">

            <div class="left-box">
                <div class="form-outer-box">

                    <form class="form"
                        action="<?php echo URLROOT; ?>/users/editOrganization/<?php echo $data['id'] ?>"
                        method="post" enctype="multipart/form-data">

                        <div class="column">
                            <div class="input-box">
                                <label for="">organization Name</label>
                                <input type="text" name="organization_name"
                                    value="<?php echo $data['organization_name'] ?>" id=""
                                    placeholder="Enter the organization_name">
                                <!-- <?php if (!empty($data['organization_name_err'])): ?>
                                <span class="error-message"><?php echo $data['organization_name_err']; ?></span>
                            <?php endif; ?> -->
                            </div>
                            <div class="input-box">
                                <label for="">Role</label>
                                <input type="text" name="role"
                                    value="<?php echo $data['role'] ?>" id=""
                                    placeholder="Enter the role">
                                <!-- <?php if (!empty($data['role_err'])): ?>
                                <span class="error-message"><?php echo $data['role_err']; ?></span>
                            <?php endif; ?> -->
                            </div>
                        </div>

                        <div class="column">
                            <div class="input-box">
                                <label for="">Select Organization</label>
                                <select name="organization_id" id="uni-filter-value" placeholder=" Approval"
                                    class="dropdown-menu">
                                    <option value="">None</option>
                                    <?php if (!empty($data['organizations'])): ?>
                                        <?php foreach ($data['organizations'] as $org): ?>
                                            <option value="<?php echo $org->organization_id ?>"><?php echo $org->organization_name ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </select>
                                <!-- <?php if (!empty($data['organization_err'])): ?>
                                <span class="error-message"><?php echo $data['organization_err']; ?></span>
                            <?php endif; ?> -->
                            </div>
                            <div class="input-box">
                                <label for="">Select University</label>
                                <select name="organization_university" id="uni-filter-value" placeholder=" Approval"
                                    class="dropdown-menu">
                                    <option value="">None</option>
                                    <?php if (!empty($data['universities'])): ?>
                                        <?php foreach ($data['universities'] as $uni): ?>
                                            <option value="<?php echo $uni->id ?>"><?php echo $uni->name ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </select>
                                <!-- <?php if (!empty($data['university_err'])): ?>
                                <span class="error-message"><?php echo $data['university_err']; ?></span>
                            <?php endif; ?> -->
                            </div>
                        </div>

                        <div class="column">
                            <div class="input-box">
                                <label for="">Start Date</label>
                                <input type="date" name="start_date" id="start-date-input"
                                    value="<?php echo $data['start_date'] ?>">
                                <!-- <?php if (!empty($data['start_date_err'])): ?>
                                    <span class="error-message"><?php echo $data['start_date_err']; ?></span>
                                <?php endif; ?> -->
                            </div>
                            <div class="input-box">
                                <label for="">End Date</label>
                                <input type="date" name="end_date" id="end-date-input"
                                    value="<?php echo $data['end_date'] ?>">
                                <!-- <?php if (!empty($data['end_date_err'])): ?>
                                    <span class="error-message"><?php echo $data['end_date_err']; ?></span>
                                <?php endif; ?> -->
                            </div>
                        </div>


                        <button class="submit-btn" type="submit">Update</button>
                    </form>
                </div>
            </div>

            <div class="image-box">
                <img src="<?php echo URLROOT ?>/img/events/announcements/announcement_img.jpg" alt="">
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/events/changeContactDetails.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>