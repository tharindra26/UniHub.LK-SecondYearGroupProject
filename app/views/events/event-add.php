<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/events/event-add_style.css">

<div class="container">
    <div class="inner-container">
        <div class="add-event-form">
            <header>Add Event</header>
            <form class="form" action="/upload" method="post" enctype="multipart/form-data">
                <div class="input-box">
                    <label for="">Event Title</label>
                    <input type="text" name="" id="" placeholder="Enter full name">
                </div>

                <div class="column">
                    <div class="input-box">
                        <label for="">University</label>
                        <div class="select-box">
                            <select name="" id="">
                                <option value="1">University of Colombo</option>
                                <option value="2">University of Peradeniya</option>
                                <option value="3">University of Moratuwa</option>
                                <option value="4">University of Kelaniya</option>
                                <option value="5">University of Sri Jayewardenepura</option>
                                <option value="6">University of Ruhuna</option>
                                <option value="7">University of Jaffna</option>
                                <option value="8">University of Sabaragamuwa</option>
                                <option value="9">Eastern University, Sri Lanka</option>
                                <option value="10">South Eastern University of Sri Lanka</option>
                                <option value="11">Rajarata University of Sri Lanka</option>
                                <option value="12">Wayamba University of Sri Lanka</option>
                                <option value="13">Uva Wellassa University</option>
                                <option value="14">University of the Visual and Performing Arts</option>
                                <option value="15">Sabaragamuwa University of Sri Lanka</option>
                                <option value="16">Open University of Sri Lanka</option>
                                <option value="17">General Sir John Kotelawala Defence University</option>
                                <option value="18">Sri Lanka Institute of Information Technology (SLIIT)</option>
                                <option value="19">Informatics Institute of Technology (IIT)</option>
                                <option value="20">General Sir John Kotelawala Defence University - Southern Campus</option>
                            </select>
                        </div>
                    </div>

                    <div class="input-box">
                        <label for="">Organized by</label>
                        <input type="text" name="" id="" placeholder="Enter full name">
                    </div>
                </div>

                <div class="column">
                    <div class="input-box">
                        <label for="">Venue</label>
                        <input type="text" name="" id="" placeholder="Enter event venue">
                    </div>

                    <div class="input-box">
                        <label for="">Embed Google map link</label>
                        <input type="text" name="" id="" placeholder="Enter embed Google map link">
                    </div>
                </div>

                <div class="column">
                    <div class="input-box">
                        <label for="">Start date-time</label>
                        <input type="datetime-local" name="" id="" >
                    </div>

                    <div class="input-box">
                        <label for="">End date-time</label>
                        <input type="datetime-local" name="" id="" >
                    </div>
                </div>

                <div class="column">
                    <div class="input-box">
                        <label for="">Choose Profile Image</label>
                        <input type="file" id="profileImageUpload" name="image" accept="image/*" >
                        <button type="button" id="custom-profile-img-btn"><i class="fa-regular fa-file-image"></i> &nbsp Choose a image</button>
                        <span id="profile-img-txt">No file chosen, yet.</span>
                    </div>

                    <div class="input-box">
                        <label for="">Choose Profile Image</label>
                        <input type="file" id="profileImageUpload" name="image" accept="image/*">
                        <button type="button" id="custom-profile-img-btn"><i class="fa-regular fa-file-image"></i> &nbsp Choose a image</button>
                        <span id="profile-img-txt">No file choosen, yet.</span>
                    </div>
                    
                </div>

                <button class="submit-btn" type="submit">Submit</button>
            </form>
        </div>


        <div class="image-section">
            <img src="<?php echo URLROOT ?>/img/events/event-add/event-add-image.jpg" alt="" srcset="">
        </div>
    </div>
    
    
</div>



<script src="<?php echo URLROOT?>/js/events/event-add.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>