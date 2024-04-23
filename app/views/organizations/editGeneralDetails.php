<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/organizations/editGeneralDetails_style.css">

<div class="container">
    <div class="inner-container">
        <div class="add-event-form">
            <header>Update General Details</header>
            <form class="form" action="<?php echo URLROOT; ?>/organizations/editGeneralDetails/<?php echo $data['organization_id'] ?>" method="post"
                enctype="multipart/form-data">

                <div class="input-box">
                    <label for="">Organization Title</label>
                    <input type="text" name="organization_name" id="" value="<?php echo $data['organization_name'] ?>"
                        placeholder="Enter organization title">
                    <?php if (!empty($data['organization_name_err'])): ?>
                        <span class="error-message"><?php echo $data['organization_name_err']; ?></span>
                    <?php endif; ?>
                </div>




                <h3>Contact Details</h3>


                <div class="column">
                    <div class="input-box">
                        <label for="">University</label>
                        <div class="select-box">
                            <select name="university" id="selection">
                                <option hidden <?php if (empty($data['university']))
                                    echo 'selected'; ?>>Select
                                    University</option>
                                <?php foreach ($data['universities'] as $university): ?>
                                    <option value="<?php echo $university->id ?>" <?php if ($data['university'] == $university->id)
                                           echo 'selected'; ?>>
                                        <?php echo $university->name ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php if (!empty($data['university_err'])): ?>
                            <span class="error-message"><?php echo $data['university_err']; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="input-box">
                        <label for="">Contact Number</label>
                        <input type="tel" name="contact_number" value="<?php echo $data['contact_number'] ?>" id=""
                            placeholder="Enter the Contact Number">
                        <?php if (!empty($data['contact_number_err'])): ?>
                            <span class="error-message"><?php echo $data['contact_number_err']; ?></span>
                        <?php endif; ?>
                    </div>

                </div>

                <h3>About Organization</h3>

                <div class="input-box">
                    <label for="">Number of members</label>
                    <input type="text" name="number_of_members" value="<?php echo $data['number_of_members'] ?>" id=""
                        placeholder="Enter the number of members">
                    <?php if (!empty($data['number_of_members_err'])): ?>
                        <span class="error-message"><?php echo $data['number_of_members_err']; ?></span>
                    <?php endif; ?>
                </div>

                

                <div class="input-box">
                    <label for="">Brief Description</label>
                    <textarea id="eventDescription" name="short_caption" value="<?php echo $data['short_caption'] ?>"
                        placeholder="Enter a breif introduction on organization"><?php echo $data['short_caption'] ?></textarea>
                    <?php if (!empty($data['short_caption_err'])): ?>
                        <span class="error-message"><?php echo $data['short_caption_err']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="input-box">
                    <label for=""> Full Description</label>
                    <textarea id="eventDescription" name="description" value="<?php echo $data['description'] ?>"
                        placeholder="Enter the organization description"><?php echo $data['description'] ?></textarea>
                    <?php if (!empty($data['short_caption_err'])): ?>
                        <span class="error-message"><?php echo $data['description_err']; ?></span>
                    <?php endif; ?>
                </div>


                

                <button class="submit-btn" type="submit">Send Request</button>
            </form>
        </div>
    </div>
</div>



<script src="<?php echo URLROOT ?>/js/organizations/editGeneralDetails.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>