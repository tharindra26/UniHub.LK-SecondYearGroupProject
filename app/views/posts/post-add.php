<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/posts/post-add_style.css">

<div class="container">
    <div class="inner-container">
        <div class="title-text">
            <p>Publish Post</p>
        </div>
        <div class="bottom-part">

            <div class="left-box">
                <div class="form-outer-box">

                    <form class="form" action="<?php echo URLROOT; ?>/posts/add" method="post"
                        enctype="multipart/form-data">
                        <div class="column">
                            <div class="input-box">

                                <label for="">Post Title</label>
                                <input type="text" name="post_title" id="" placeholder="Enter your title "
                                    value="<?php echo $data['post_title'] ?>">
                                <?php if (!empty($data['post_title_err'])): ?>
                                    <span class="error-message">
                                        <?php echo $data['post_title_err']; ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="column">
                            <div class="input-box">
                                <label for="">Post Description</label>
                                <textarea id="eventDescription" name="post_description"
                                    placeholder="Enter the post description"><?php echo $data['post_description'] ?></textarea>
                                <?php if (!empty($data['post_description_err'])): ?>
                                    <span class="error-message">
                                        <?php echo $data['post_description_err']; ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="column">
                            <div class="input-box">
                                <label for="">Material links</label>
                                <input type="text" name="material_link" id="" placeholder="Enter the material link"
                                    value="<?php echo $data['material_link'] ?>">
                                <?php if (!empty($data['material_link_err'])): ?>
                                    <span class="error-message">
                                        <?php echo $data['material_link_err']; ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="categories-section">
                            <H3>Choose Categories</H3>
                            <div class="column">
                                <div class="input-box ">
                                    <label for="">Press ctrl to select multiple categories.</label>
                                    <div class="select-box category">

                                        <select name="categories[]" id="selection" multiple>
                                            <option hidden value="0">Select Category</option>
                                            <?php foreach ($data['postCategories'] as $category): ?>
                                                <option value="<?php echo $category->category_name ?>" <?php if (is_array($data['categories']) && in_array($category->category_name, $data['categories']))
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
                                <H3>Post Image</H3>
                                <label for="">Recommend to upload a image with a 16:9 aspect ratio. Accepted formats:
                                    JPG, PNG.</label>
                                <input type="file" id="profileImageUpload" name="post_profile_image"
                                    value="<?php echo $data['post_profile_image'] ?>" accept="image/*">
                                <button type="button" id="custom-profile-img-btn"><i
                                        class="fa-regular fa-file-image"></i> &nbsp
                                    Choose a image</button>
                                <span id="profile-img-txt">No file chosen, yet.</span>
                                <?php if (!empty($data['post_profile_image_err'])): ?>
                                    <span class="error-message">
                                        <?php echo $data['post_profile_image_err']; ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>


                        <button class="submit-btn" type="submit">
                            <p><i class="fa-solid fa-paper-plane"></i> publish post</p>
                        </button>


                    </form>
                </div>
            </div>

            <!-- <div class="image-box">
                <img src="<?php echo URLROOT ?>/img/events/announcements/announcement_img.jpg" alt="">
            </div> -->
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?php echo URLROOT ?>/js/posts/post-add.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>