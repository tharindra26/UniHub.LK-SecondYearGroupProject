<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/events/event-add_style.css">

<div class="container">
    <div class="inner-container">
        <div class="add-event-form">
            <header>Add Event</header>
            <form class="form" action="<?php echo URLROOT; ?>/events/add" method="post" enctype="multipart/form-data">




                <div class="input-box">
                    <label for="">Event Title</label>
                    <input type="text" name="title" id="" value="<?php echo $data['title'] ?>"
                        placeholder="Enter full name">
                    <?php if (!empty($data['title_err'])): ?>
                        <span class="error-message"><?php echo $data['title_err']; ?></span>
                    <?php endif; ?>
                </div>




                <div class="contact-details">
                    <h3>Contact Details</h3>


                    <div class="column">
                        <div class="input-box">
                            <label for="">University</label>
                            <div class="select-box">
                                <select name="university_id" id="selection">
                                    <option hidden value="" <?php if (empty($data['university_id']))
                                        echo 'selected'; ?>>Select
                                        University</option>
                                    <?php foreach ($data['universities'] as $university): ?>
                                        <option value="<?php echo $university->id ?>" <?php if ($data['university_id'] == $university->id)
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
                            <label for="">Organized by</label>
                            <input type="text" name="organized_by" value="<?php echo $data['organized_by'] ?>" id=""
                                placeholder="Enter the organization entity">
                            <?php if (!empty($data['organized_by_err'])): ?>
                                <span class="error-message"><?php echo $data['organized_by_err']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="column">
                        <div class="input-box">
                            <label for="">Email</label>
                            <input type="text" name="email" value="<?php echo $data['email'] ?>" id=""
                                placeholder="Enter the email">
                            <?php if (!empty($data['email_err'])): ?>
                                <span class="error-message"><?php echo $data['email_err']; ?></span>
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

                    <div class="column">
                        <div class="input-box">
                            <label for="">web</label>
                            <input type="text" name="web" value="<?php echo $data['web'] ?>" id=""
                                placeholder="Enter the web">
                            <?php if (!empty($data['web_err'])): ?>
                                <span class="error-message"><?php echo $data['web_err']; ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="input-box">
                            <label for="">Linkedin</label>
                            <input type="tel" name="linkedin" value="<?php echo $data['linkedin'] ?>" id=""
                                placeholder="Enter the linkedin">
                            <?php if (!empty($data['linkedin_err'])): ?>
                                <span class="error-message"><?php echo $data['linkedin_err']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="column">
                        <div class="input-box">
                            <label for="">Facebook</label>
                            <input type="text" name="facebook" value="<?php echo $data['facebook'] ?>" id=""
                                placeholder="Enter the facebook">
                            <?php if (!empty($data['facebook_err'])): ?>
                                <span class="error-message"><?php echo $data['facebook_err']; ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="input-box">
                            <label for="">Instagram</label>
                            <input type="tel" name="instagram" value="<?php echo $data['instagram'] ?>" id=""
                                placeholder="Enter the instagram">
                            <?php if (!empty($data['linkedin_err'])): ?>
                                <span class="error-message"><?php echo $data['instagram_err']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>



                <h3>Placement</h3>
                <div class="column">
                    <div class="input-box">
                        <label for="">Venue</label>
                        <input type="text" name="venue" value="<?php echo $data['venue'] ?>" id=""
                            placeholder="Enter event venue">
                        <?php if (!empty($data['venue_err'])): ?>
                            <span class="error-message"><?php echo $data['venue_err']; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="input-box">
                        <label for="">Embed Google map link</label>
                        <input type="text" name="map_navigation" value="<?php echo $data['map_navigation'] ?>" id=""
                            placeholder="Enter embed Google map link">
                        <?php if (!empty($data['map_navigation_err'])): ?>
                            <span class="error-message"><?php echo $data['map_navigation_err']; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="column">
                    <div class="input-box">
                        <?php
                        // Get the current date and time in the format required by datetime-local input
                        $currentDateTime = date('Y-m-d\TH:i', time());
                        ?>
                        <label for="">Start date-time</label>

                        <input type="datetime-local" name="start_datetime" value="<?php echo $data['start_datetime'] ?>"
                            id="start_datetime" min="<?php echo $currentDateTime; ?>">
                        <?php if (!empty($data['start_datetime_err'])): ?>
                            <span class="error-message"><?php echo $data['start_datetime_err']; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="input-box">
                        <label for="">End date-time</label>
                        <input type="datetime-local" name="end_datetime" value="<?php echo $data['end_datetime'] ?>"
                            id="">
                        <?php if (!empty($data['end_datetime_err'])): ?>
                            <span class="error-message"><?php echo $data['end_datetime_err']; ?></span>
                        <?php endif; ?>
                    </div>
                </div>



                <div class="input-box">
                    <label for="">Event Description</label>
                    <textarea id="eventDescription" name="description" value="<?php echo $data['description'] ?>"
                        placeholder="Enter event description"><?php echo $data['description'] ?></textarea>
                    <?php if (!empty($data['description_err'])): ?>
                        <span class="error-message"><?php echo $data['description_err']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="categories-section">
                    <H3>Choose Categories</H3>
                    <div class="column">
                        <div class="input-box ">
                            <label for="">Press ctrl to select multiple categories.</label>
                            <div class="select-box category">

                                <select name="categories[]" id="selection" multiple>
                                    <option hidden value="0">Select Category</option>
                                    <?php foreach ($data['eventCategories'] as $category): ?>
                                        <option value="<?php echo $category->id ?>" <?php if (is_array($data['categories']) && in_array($category->id, $data['categories']))
                                               echo 'selected'; ?>>
                                            <?php echo $category->category_name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>


                            </div>
                            <?php if (!empty($data['category_err'])): ?>
                                <span class="error-message"><?php echo $data['category_err']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>


                <div class="input-box">
                    <H3>Profile Image</H3>
                    <label for="">Upload a 600x600 pixels image. Accepted formats: JPG, PNG.</label>
                    <input type="file" id="profileImageUpload" name="event_profile_image"
                        value="<?php echo $data['event_profile_image'] ?>" accept="image/*">
                    <button type="button" id="custom-profile-img-btn"><i class="fa-regular fa-file-image"></i> &nbsp
                        Choose a image</button>
                    <span id="profile-img-txt">
                        <?php echo (!empty($data['event_profile_image'])) ? basename($data['event_profile_image']) : 'No file chosen, yet.'; ?>
                    </span>
                    <?php if (!empty($data['event_profile_image_err'])): ?>
                        <span class="error-message"><?php echo $data['event_profile_image_err']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="input-box">
                    <H3>Cover Image</H3>
                    <label for="">Upload a cover image with a 16:9 aspect ratio. Recommended resolution: 1600x900
                        pixels. Accepted formats: JPG, PNG.</label>
                    <input type="file" id="coverImageUpload" name="event_cover_image"
                        value="<?php echo $data['event_cover_image'] ?>" accept="image/*">
                    <button type="button" id="custom-cover-img-btn"><i class="fa-regular fa-file-image"></i> &nbsp
                        Choose a image</button>
                    <span id="cover-img-txt">
                        <?php echo (!empty($data['event_cover_image'])) ? basename($data['event_cover_image']) : 'No file chosen, yet.'; ?>
                    </span>
                    <?php if (!empty($data['event_cover_image_err'])): ?>
                        <span class="error-message"><?php echo $data['event_cover_image_err']; ?></span>
                    <?php endif; ?>
                </div>
                <button class="submit-btn" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>



<script src="<?php echo URLROOT ?>/js/events/event-add.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>