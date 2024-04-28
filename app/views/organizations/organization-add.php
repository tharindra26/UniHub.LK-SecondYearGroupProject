<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/organizations/organization-add_style.css">

<div class="container">
    <div class="inner-container">
        <div class="add-event-form">
            <header>Organization Request</header>
            <form class="form" action="<?php echo URLROOT; ?>/organizations/add" method="post"
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
                                <option hidden value="0" <?php if (empty($data['university']))
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
                        <label for="">Organization Email</label>
                        <input type="text" name="contact_email" value="<?php echo $data['contact_email'] ?>" id=""
                            placeholder="Enter the organization email">
                        <?php if (!empty($data['contact_email_err'])): ?>
                            <span class="error-message"><?php echo $data['contact_email_err']; ?></span>
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
                    <input type="number" name="number_of_members" value="<?php echo $data['number_of_members'] ?>" id=""
                        placeholder="Enter the number of members">
                    <?php if (!empty($data['number_of_members_err'])): ?>
                        <span class="error-message"><?php echo $data['number_of_members_err']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="categories-section">
                    <H3>Choose Categories</H3>
                    <div class="column">
                        <div class="input-box ">
                            <label for="">Press ctrl to select multiple categories.</label>
                            <div class="select-box category">

                                <select name="categories[]" id="selection" multiple>
                                    <option hidden>Select Category</option>
                                    <?php foreach ($data['organizationCategories'] as $category): ?>
                                        <option value="<?php echo $category->category_id ?>" <?php if (is_array($data['categories']) && in_array($category->category_id, $data['categories']))
                                               echo 'selected'; ?>>
                                            <?php echo $category->category_name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>


                            </div>
                            <?php if (!empty($data['categories_err'])): ?>
                                <span class="error-message">
                                    <?php echo $data['categories_err']; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

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


                <h3>Social media handles</h3>
                <div class="column">
                    <div class="input-box">
                        <label for="">Website</label>
                        <input type="text" name="website_url" value="<?php echo $data['website_url'] ?>" id=""
                            placeholder="Enter the web">
                        <?php if (!empty($data['website_url_err'])): ?>
                            <span class="error-message"><?php echo $data['website_url_err']; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="input-box">
                        <label for="">Linkedin</label>
                        <input type="text" name="linkedin" value="<?php echo $data['linkedin'] ?>" id=""
                            placeholder="Enter the organization linkedin link">
                        <?php if (!empty($data['linkedin_err'])): ?>
                            <span class="error-message"><?php echo $data['linkedin_err']; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="column">
                    <div class="input-box">
                        <label for="">Facebook</label>
                        <input type="text" name="facebook" value="<?php echo $data['facebook'] ?>" id=""
                            placeholder="Enter the organization facebook link">
                        <?php if (!empty($data['facebook_err'])): ?>
                            <span class="error-message"><?php echo $data['facebook_err']; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="input-box">
                        <label for="">Instagram</label>
                        <input type="text" name="instagram" value="<?php echo $data['instagram'] ?>" id=""
                            placeholder="Enter the organization instagram link">
                        <?php if (!empty($data['instagram_err'])): ?>
                            <span class="error-message"><?php echo $data['instagram_err']; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="column">
                    <div class="input-box">
                        <H3>Organization Logo</H3>
                        <label for="">Upload a 600x600 pixels image. Accepted formats: JPG, PNG.</label>
                        <input type="file" id="profileImageUpload" name="organization_profile_image"
                            value="<?php echo $data['organization_profile_image'] ?>" accept="image/*">
                        <button type="button" id="custom-profile-img-btn"><i class="fa-regular fa-file-image"></i>
                            &nbsp Choose a image</button>
                        <span id="profile-img-txt">
                            <?php echo (!empty($data['organization_profile_image'])) ? basename($data['organization_profile_image']) : 'No file chosen, yet.'; ?>
                        </span>
                        <?php if (!empty($data['organization_profile_image_err'])): ?>
                            <span class="error-message"><?php echo $data['organization_profile_image_err']; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="input-box">
                        <H3>Cover Image</H3>
                        <label for="">Upload a cover image with a 16:9 aspect ratio. Recommended resolution: 1600x900
                            pixels. Accepted formats: JPG, PNG.</label>
                        <input type="file" id="coverImageUpload" name="organization_cover_image"
                            value="<?php echo $data['organization_cover_image'] ?>" accept="image/*">
                        <button type="button" id="custom-cover-img-btn"><i class="fa-regular fa-file-image"></i> &nbsp
                            Choose a image</button>
                        <span id="cover-img-txt">
                            <?php echo (!empty($data['organization_cover_image'])) ? basename($data['organization_cover_image']) : 'No file chosen, yet.'; ?>
                        </span>
                        <?php if (!empty($data['organization_cover_image_err'])): ?>
                            <span class="error-message"><?php echo $data['organization_cover_image_err']; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="input-box">
                    <H3>Board Members Image</H3>
                    <label for="">Upload a cover image with a 16:9 aspect ratio. Recommended resolution: 1600x900
                        pixels. Accepted formats: JPG, PNG.</label>
                    <input type="file" id="boardImageUpload" name="board_members_image"
                        value="<?php echo $data['board_members_image'] ?>" accept="image/*">
                    <button type="button" id="custom-board-img-btn"><i class="fa-regular fa-file-image"></i> &nbsp
                        Choose a image</button>
                    <span id="board-img-txt">
                        <?php echo (!empty($data['board_members_image'])) ? basename($data['board_members_image']) : 'No file chosen, yet.'; ?>
                    </span>
                    <?php if (!empty($data['board_members_image_err'])): ?>
                        <span class="error-message"><?php echo $data['board_members_image_err']; ?></span>
                    <?php endif; ?>
                </div>



                <button class="submit-btn" type="submit">Send Request</button>
            </form>
        </div>
    </div>
</div>



<script src="<?php echo URLROOT ?>/js/organizations/organization-add.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>