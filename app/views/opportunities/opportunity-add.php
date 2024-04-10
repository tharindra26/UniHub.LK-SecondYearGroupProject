<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/opportunities/opportunity-add_style.css">


<div class="container">
    <div class="inner-container">
        <div class="add-event-form">
            <header>Add Opportunity</header>
            <form class="form" action="<?php echo URLROOT; ?>/opportunities/add" method="post"
                enctype="multipart/form-data">

                <div class="input-box">
                    <label for="">Opportunity Title</label>
                    <input type="text" name="opportunity_title" id="" value="<?php echo $data['opportunity_title'] ?>"
                        placeholder="Enter opportunity title">
                    <?php if (!empty($data['opportunity_title_err'])): ?>
                        <span class="error-message">
                            <?php echo $data['opportunity_title_err']; ?>
                        </span>
                    <?php endif; ?>
                </div>

                <h3>Contact Details</h3>
                <div class="column">
                    <div class="input-box">
                        <label for="">Organization</label>
                        <input type="text" name="organization_name" id=""
                            value="<?php echo $data['organization_name'] ?>" placeholder="Enter the organization">
                        <?php if (!empty($data['organization_name_err'])): ?>
                            <span class="error-message">
                                <?php echo $data['organization_name_err']; ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="input-box">
                        <label for="">Contact Person</label>
                        <input type="text" name="contact_person" id="" value="<?php echo $data['contact_person'] ?>"
                            placeholder="Enter the name of contact person">
                        <?php if (!empty($data['contact_person_err'])): ?>
                            <span class="error-message">
                                <?php echo $data['contact_person_err']; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="column">
                    <div class="input-box">
                        <label for="">Contact Email</label>
                        <input type="text" name="contact_email" id="" value="<?php echo $data['contact_email'] ?>"
                            placeholder="Enter the Email">
                        <?php if (!empty($data['contact_email_err'])): ?>
                            <span class="error-message">
                                <?php echo $data['contact_email_err']; ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="input-box">
                        <label for="">Contact Phone Number</label>
                        <input type="text" name="contact_phone" id="" value="<?php echo $data['contact_phone'] ?>"
                            placeholder="Enter the contact number">
                        <?php if (!empty($data['contact_phone_err'])): ?>
                            <span class="error-message">
                                <?php echo $data['contact_phone_err']; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <h3>Opportunity Details</h3>
                <div class="column">
                    <div class="input-box">
                        <label for="">Opportunity Type</label>
                        <div class="select-box">
                            <select name="opportunity_type" id="selection">
                                <option hidden <?php if (empty($data['opportunity_type']))
                                    echo 'selected'; ?>>Select
                                    Opportunity opportunity Type</option>
                                <option value="Intern" <?php if ($data['opportunity_type'] == 'Intern')
                                    echo 'selected'; ?>>Intern</option>
                                <option value="Part-Time" <?php if ($data['opportunity_type'] == 'Part-Time')
                                    echo 'selected'; ?>>Part-Time</option>
                                <option value="Full-Time" <?php if ($data['opportunity_type'] == 'Full-Time')
                                    echo 'selected'; ?>>Full-Time</option>
                            </select>
                        </div>
                        <?php if (!empty($data['opportunity_type_err'])): ?>
                            <span class="error-message">
                                <?php echo $data['opportunity_type_err']; ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="input-box">
                        <label for="">Title Positions</label>
                        <input type="text" name="title_positions" id="" value="<?php echo $data['title_positions'] ?>"
                            placeholder="Enter the tite positions">
                        <?php if (!empty($data['title_positions_err'])): ?>
                            <span class="error-message">
                                <?php echo $data['title_positions_err']; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="column">
                    <div class="input-box">
                        <label for="">Website</label>
                        <input type="text" name="website_url" id="" value="<?php echo $data['website_url'] ?>"
                            placeholder="Enter the website url">
                        <?php if (!empty($data['website_url_err'])): ?>
                            <span class="error-message">
                                <?php echo $data['website_url_err']; ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="input-box">
                        <label for="">LinkedIn</label>
                        <input type="text" name="linkedin" id="" value="<?php echo $data['linkedin'] ?>"
                            placeholder="Enter the linkedin">
                        <?php if (!empty($data['linkedin_err'])): ?>
                            <span class="error-message">
                                <?php echo $data['linkedin_err']; ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="input-box">
                        <label for="">Application Deadline</label>
                        <input type="datetime-local" name="application_deadline"
                            value="<?php echo $data['application_deadline'] ?>" id="">
                        <?php if (!empty($data['application_deadline_err'])): ?>
                            <span class="error-message">
                                <?php echo $data['application_deadline_err']; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="input-box">
                    <label for="">Job Description</label>
                    <textarea id="eventDescription" name="description" value="<?php echo $data['description'] ?>"
                        placeholder="Enter job description"><?php echo $data['description'] ?></textarea>
                    <?php if (!empty($data['description_err'])): ?>
                        <span class="error-message">
                            <?php echo $data['description_err']; ?>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="input-box">
                    <label for="">Qualifications</label>
                    <textarea id="eventDescription" name="qualifications" value="<?php echo $data['qualifications'] ?>"
                        placeholder="Enter qualifications"><?php echo $data['qualifications'] ?></textarea>
                    <?php if (!empty($data['description_err'])): ?>
                        <span class="error-message">
                            <?php echo $data['qualifications_err']; ?>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="input-box">
                    <label for="">Additional Information</label>
                    <textarea id="eventDescription" name="additional_information"
                        value="<?php echo $data['additional_information'] ?>"
                        placeholder="Enter additional information"><?php echo $data['additional_information'] ?></textarea>
                    <?php if (!empty($data['additional_information_err'])): ?>
                        <span class="error-message">
                            <?php echo $data['additional_information_err']; ?>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="input-box">
                    <label for="">Tags</label>
                    <input type="text" name="tags" id="" value="<?php echo $data['tags'] ?>"
                        placeholder="Enter tags separated by commas">
                    <?php if (!empty($data['tags_err'])): ?>
                        <span class="error-message">
                            <?php echo $data['tags_err']; ?>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="column">
                    <div class="input-box">
                        <H3>Profile Image for Opportunity</H3>
                        <label for="">Upload a 600x600 pixels image. Accepted formats: JPG, PNG.</label>
                        <input type="file" id="profileImageUpload" name="opportunity_card_image"
                            value="<?php echo $data['opportunity_card_image'] ?>" accept="image/*">
                        <button type="button" id="custom-profile-img-btn"><i class="fa-regular fa-file-image"></i> &nbsp
                            Choose a image</button>
                        <span id="profile-img-txt">No file chosen, yet.</span>
                        <?php if (!empty($data['opportunity_card_image_err'])): ?>
                            <span class="error-message">
                                <?php echo $data['opportunity_card_image_err']; ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="input-box">
                        <H3>Cover Image for Opportunity</H3>
                        <label for="">Upload a 600x600 pixels image. Accepted formats: JPG, PNG.</label>
                        <input type="file" id="coverImageUpload" name="opportunity_cover_image"
                            value="<?php echo $data['opportunity_cover_image'] ?>" accept="image/*">
                        <button type="button" id="custom-cover-img-btn"><i class="fa-regular fa-file-image"></i> &nbsp
                            Choose a image</button>
                        <span id="cover-img-txt">No file chosen, yet.</span>
                        <?php if (!empty($data['opportunity_cover_image_err'])): ?>
                            <span class="error-message">
                                <?php echo $data['opportunity_cover_image_err']; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="input-box">
                    <H3>Additional Details Image about opportunity</H3>
                    <label for="">Upload a 600x600 pixels image. Accepted formats: JPG, PNG.</label>
                    <input type="file" id="descriptionImageUpload" name="description_image"
                        value="<?php echo $data['description_image'] ?>" accept="image/*">
                    <button type="button" id="custom-description-img-btn"><i class="fa-regular fa-file-image"></i> &nbsp
                        Choose a image</button>
                    <span id="description-img-txt">No file chosen, yet.</span>
                    <?php if (!empty($data['description_image_err'])): ?>
                        <span class="error-message">
                            <?php echo $data['description_image_err']; ?>
                        </span>
                    <?php endif; ?>
                </div>





                <button class="submit-btn" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>



<script src="<?php echo URLROOT ?>/js/opportunities/opportunity-add.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>