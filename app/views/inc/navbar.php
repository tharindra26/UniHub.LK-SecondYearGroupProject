<div class="header">
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">UniHub.LK</label>
        <ul >
            <li><a class="active nav-elements" href="<?php echo URLROOT ?>/pages/index">Home</a></li>
            <li><a  class="nav-elements" href="<?php echo URLROOT ?>/pages/events">Events</a></li>
            <li><a class="nav-elements" href="<?php echo URLROOT ?>/pages/knowledgehub">Knowledge Hub</a></li>
            <li><a class="nav-elements" href="<?php echo URLROOT ?>/pages/opportunities">Opportunities</a></li>
            <li><a class="nav-elements" href="<?php echo URLROOT ?>/pages/organizations">Organizations</a></li>

            <?php if(isset($_SESSION['user_id'])): ?>
                <li><a class="nav-elements" href="<?php echo URLROOT ?>/users/logout">Logout</a></li>
            <?php else : ?>
                <li><a class="nav-elements" href="<?php echo URLROOT ?>/users/login">Login</a></li>
                <li><a class="nav-elements" href="<?php echo URLROOT ?>/users/register">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>