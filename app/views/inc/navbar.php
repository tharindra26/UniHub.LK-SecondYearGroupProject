<div class="header">
    <nav class="main-nav">
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">UniHub.LK</label>
        <ul >
            <li><a class="active nav-elements" href="<?php echo URLROOT ?>/pages/index">Home</a></li>
            <li><a  class="nav-elements" href="<?php echo URLROOT ?>/events/index">Events</a></li>
            <li><a class="nav-elements" href="<?php echo URLROOT ?>/knowledgehubs/index">Knowledge Hub</a></li>
            <li><a class="nav-elements" href="<?php echo URLROOT ?>#">Opportunities</a></li>
            <li><a class="nav-elements" href="<?php echo URLROOT ?>/organizations/index">Organizations</a></li>

            <?php if(isset($_SESSION['user_id'])): ?>
                <li><a class="active nav-elements" href="<?php echo URLROOT ?>/users/show/<?php echo $_SESSION['user_id'] ?>">
                    <i class="fa-solid fa-user"></i>
                    &nbsp <?php
                            if ($_SESSION['user_type'] === 'admin') {
                                echo 'Admin-' . $_SESSION['user_name'];
                            } elseif ($_SESSION['user_type'] === 'org') {
                                echo 'Org-' . $_SESSION['user_name'];
                            } else {
                                echo 'MY PROFILE-' . $_SESSION['user_name'];
                            }
                            ?>
                </a></li>
                <li><a class="active nav-elements" href="<?php echo URLROOT ?>/users/logout">Logout</a></li>
            <?php else : ?>
                <li><a class="nav-elements" href="<?php echo URLROOT ?>/users/login">Login</a></li>
                <li><a class="nav-elements" href="<?php echo URLROOT ?>/users/register">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>