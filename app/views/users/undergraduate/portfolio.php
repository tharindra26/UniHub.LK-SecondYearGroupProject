<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/undergraduate/portfolio_style.css">
<div class="content-container">
    <div class="print-portfolio" id="portfolio">
        <div class="leftbar">
            <div class="profile-photo" >
                <img src="<?php echo URLROOT ?>/img/users/users_profile_images/<?php echo $data['user']->profile_image ?>"
                    alt="Profile Picture" class="profile-img">
            </div>
            <div class="contact">
                <?php if (!empty($data['address'])): ?>
                    <div class="address">
                        <i class="fa-solid fa-location-dot"></i>
                        <p><?php echo $data['address'] ?></p>
                    </div>
                <?php endif; ?>
                <?php if (!empty($data['user']->contact_number)): ?>

                    <div class="address">
                        <i class="fa-solid fa-phone"></i>
                        <p><?php echo $data['user']->contact_number ?></p>
                    </div>
                <?php endif; ?>
                <?php if (!empty($data['user']->email)): ?>
                    <div class="address">
                        <i class="fa-solid fa-envelope"></i>
                        <p><?php echo $data['user']->email ?></p>
                    </div>
                <?php endif; ?>
                <?php if (!empty($data['user']->linkedin)): ?>
                    <div class="address">
                        <i class="fa-brands fa-linkedin"></i>
                        <p><?php echo $data['user']->linkedin ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="personal-info">
                <?php if (!empty($data['user']->dob)): ?>
                    <?php
                    $birthday = $data['user']->dob;
                    // Convert MySQL datetime to DateTime object
                    $dateTime = new DateTime($birthday);
                    // Format the DateTime object to extract only THU NOV 16
                    $extractedDate = $dateTime->format('jS M Y');

                    $dob = new DateTime($birthday);
                    // Get the current date
                    $currentDate = new DateTime();
                    // Calculate the difference between the current date and date of birth
                    $age = $currentDate->diff($dob);
                    ?>
                    <div class="info-heading">
                        <h4>Personal Info</h4>
                    </div>
                    <div class="info-list">
                        <ul>
                            <li>Date of Birth: <?php echo $extractedDate ?></li>
                            <li>Age: <?php echo $age->y; ?></li>
                        <?php endif; ?>
                        <li>Nationality: Sri Lankan</li>
                    </ul>
                </div>
            </div>
            <?php if (!empty($data['skills'][0]->user_skill_id)): ?>
                <div class="skills">
                    <div class="info-heading">
                        <h4>Skills</h4>
                    </div>
                    <div class="skill-list">
                        <ul>
                            <?php foreach ($data['skills'] as $skill): ?>
                                <li>
                                    <h4><?php echo $skill->skill_name ?></h4>
                                    <p> : <?php echo $skill->proficiency_level ?></p>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <?php if (!empty($data['languages'])): ?>
                <div class="languages">
                    <div class="info-heading">
                        <h4>Languages</h4>
                    </div>
                    <div class="language-list">
                        <ul>
                            <?php foreach ($data['languages'] as $language): ?>
                                <li>
                                    <h4><?php echo $language ?></h4>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

        </div>
        <div class="rightbar">
            <div class="name">
                <h1><?php echo $data['user']->fname, " ", $data['user']->lname ?></h1>
            </div>
            <?php if (!empty($data['user'])): ?>
                <div class="about">
                    <p><?php echo $data['user']->description ?></p>
                </div>
            <?php endif; ?>

            <?php if (!empty($data['qualifications'][0]->qualification_id)): ?>
                <div class="qualifications">
                    <div class="list-heading">
                        <h4>Qualifications</h4>
                    </div>
                    <div class="qualification-list">
                        <ul>
                            <?php foreach ($data['qualifications'] as $qualification): ?>
                                <li>
                                    <h4><?php echo $qualification->qualification_name ?> -
                                        <?php echo $qualification->institution ?>
                                    </h4>
                                    <p>Completed date : <?php echo $qualification->completion_date ?></p>
                                    <p><?php echo $qualification->description ?></p>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <?php if (!empty($data['education'][0]->education_id)): ?>
                <div class="qualifications">
                    <div class="list-heading">
                        <h4>Education</h4>
                    </div>
                    <div class="education-list">
                        <ul>
                            <?php foreach ($data['education'] as $education): ?>
                                <li>
                                    <h4><?php echo $education->institution ?></h4>
                                    <p><?php echo $education->start_year ?> - <?php echo $education->end_year ?></p>
                                    <p><?php echo $education->description ?></p>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <?php if (!empty($data['organizations'][0]->id)): ?>
                <div class="qualifications">
                    <div class="list-heading">
                        <h4>Extra Curricular Activities</h4>
                    </div>
                    <div class="education-list">
                        <ul>
                            <?php foreach ($data['organizations'] as $organization): ?>
                                <li>
                                    <h4><?php echo $organization->organization_name ?> -
                                        <?php echo $organization->name ?>
                                    </h4>
                                    <p><?php echo $organization->role ?></p>
                                    <p>From: <?php echo $organization->start_date ?> To: <?php echo $organization->end_date ?>
                                    </p>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="qualifications">
                <div class="list-heading">
                    <h4>NON-RELATED REFERENCES</h4>
                </div>
                <div class="education-list">

                    <?php if (!empty($data['ref1_name'])): ?>
                        <div class="ref-item">
                        <h5>Name:</h5><p>&nbsp&nbsp&nbsp<?php echo $data['ref1_name'] ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($data['ref1_designation'])): ?>
                        <div class="ref-item">
                        <h5>Designation:</h5><p>&nbsp&nbsp&nbsp<?php echo $data['ref1_designation'] ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($data['ref1_company'])): ?>
                        <div class="ref-item">
                        <h5>Company:</h5><p>&nbsp&nbsp&nbsp<?php echo $data['ref1_company'] ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($data['ref1_address'])): ?>
                        <div class="ref-item">
                        <h5>Address:</h5><p>&nbsp&nbsp&nbsp<?php echo $data['ref1_address'] ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($data['ref1_contact'])): ?>
                        <div class="ref-item">
                        <h5>Contact Number:</h5><p>&nbsp&nbsp&nbsp<?php echo $data['ref1_contact'] ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($data['ref1_email'])): ?>
                        <div class="ref-item">
                        <h5>Email:</h5><p>&nbsp&nbsp&nbsp<?php echo $data['ref1_email'] ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <br>
                <div class="education-list">
                    <?php if (!empty($data['ref2_name'])): ?>
                        <div class="ref-item">
                        <h5>Name:</h5><p>&nbsp&nbsp&nbsp<?php echo $data['ref2_name'] ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($data['ref2_designation'])): ?>
                        <div class="ref-item">
                        <h5>Designation:</h5><p>&nbsp&nbsp&nbsp<?php echo $data['ref2_designation'] ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($data['ref2_company'])): ?>
                        <div class="ref-item">
                        <h5>Company:</h5><p>&nbsp&nbsp&nbsp<?php echo $data['ref2_company'] ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($data['ref2_address'])): ?>
                        <div class="ref-item">
                        <h5>Address:</h5><p>&nbsp&nbsp&nbsp<?php echo $data['ref2_address'] ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($data['ref2_contact'])): ?>
                        <div class="ref-item">
                        <h5>Contact Number:</h5><p>&nbsp&nbsp&nbsp<?php echo $data['ref2_contact'] ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($data['ref1_email'])): ?>
                        <div class="ref-item">
                        <h5>Email:</h5><p>&nbsp&nbsp&nbsp<?php echo $data['ref2_email'] ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="qualifications">
                <div class="education-list">
                    <p>I hereby declare that all the above information is correct and accurate</p>
                    <br>
                    <p>............................</p>
                    <p>Signature</p>
                </div>
            </div>
        </div>
    </div>
    <button class="submit-btn" onclick="generatePDF()" >Print Portfolio</button>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.min.js"></script>
<script>
    function generatePDF() {
        var element = document.getElementById('portfolio'); // Get the table element
        var opt = {
            margin:       1,
            filename:     'portfolio.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', format: 'A3', orientation: 'portrait' }
        };
        var pdf = new html2pdf(element, opt); // Create HTML2PDF instance
        pdf.save(); // Save the PDF
    }
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>