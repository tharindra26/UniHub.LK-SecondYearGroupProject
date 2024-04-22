<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/typefilter_style.css">
<h1 class="section-title"></h1>

<table class="user-table">
        <thead>
            <tr>
                <th>Event ID</th>
                <th>Event Title</th>
                <th>User ID</th>
                <th>Category</th>
                <th>Contact</th>
                <th>Approval</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data['events'][0]->id)) : ?> 
            <?php foreach ($data['events'] as $event):
                if (empty($event)):
                    break;
                endif;
                // $popupId = "popup" . $user->id; 
                $eventId = $event->id;?>
                    <tr>
                        <td><?php echo $event->id ?></td>
                        <td><?php echo $event->title ?></td>
                        <td><?php echo $event->user_id ?></td>
                        <td><?php echo $event->category_names ?></td>
                        <td><?php echo $event->contact_number ?></td>
                        <td>
                            <div class="<?php echo ($event->approval == "approved") ? 'approved' : (($event->approval == "rejected") ? 'rejected' : 'pending'); ?>">
                            <?php
                            if ($event->approval == "approved"):
                                echo "Approved";
                            elseif($event->approval == "rejected"):
                                echo "Rejected";
                            else:
                                echo "Pending";
                            endif;
                        ?></div>
                        </td>
                        <td>
                        <div class="<?php echo ($event->status == 1) ? 'activated' : 'deactivated'; ?>"><?php
                            if ($event->status == 1):
                                echo "Active";
                            else:
                                echo "Deactivated";
                            endif;
                        ?></div>
                        </td>
                        <td class="action">
                            <a href="<?php echo URLROOT ?>/events/show/<?php echo $event->id ?>" class="view"><i class="fa-solid fa-eye"></i><a>
                            <a href="<?php echo URLROOT ?>/events/settings/<?php echo $event->id ?>" class="update"><i class="fa-solid fa-pen-to-square"></i></a>
                            <?php
                            if ($event->status == 0): ?>
                                <div class="activate">
                                    <a href="#" class="delete" onclick="openPopup('<?php echo $eventId; ?>')"><i
                                            class="fa-solid fa-bell"></i></a>
                                    <!-- popupModal -->
                                <span class="overlay"></span>
                                <div class="modal-box" id="<?php echo $friend_id; ?>">
                                    <!-- <i class="fa-solid fa-xmark"></i> -->
                                    <i class="fa-solid fa-circle-check"></i>
                                    <h2>Confirm Activation</h2>
                                    <p>Are you sure you want to active the Event. EventId:<?php echo $event->title ?> </p>
                                <div class="btn">
                                    <button class="confirm-btn"
                                                onclick="confirmActivate('<?php echo $eventId; ?>')">Activate</button>
                                            <button class="confirm-btn"
                                                onclick="closePopup('<?php echo $eventId; ?>')">Cancel</button>
                                </div>
                            </div>
                        <!-- popupModal -->
                                </div>

                            <?php else: ?>
                                <div class="deactivate">
                                    <a href="#" class="delete" onclick="openPopup('<?php echo $eventId; ?>')"><i
                                            class="fa-solid fa-trash-can"></i></a>
                                          <!-- popupModal -->
                                <span class="overlay"></span>
                                <div class="modal-box" id="<?php echo $eventId; ?>">
                                    <!-- <i class="fa-solid fa-xmark"></i> -->
                                    <i class="fa-solid fa-circle-check"></i>
                                    <h2>Confirm Activation</h2>
                                    <p>Are you sure you want to active the Event. EventId:<?php echo $event->title ?> </p>
                                <div class="btn">
                                    <button class="confirm-btn"
                                                onclick="confirmDeactivate('<?php echo $eventId; ?>')">Activate</button>
                                            <button class="confirm-btn"
                                                onclick="closePopup('<?php echo $eventId; ?>')">Cancel</button>
                                </div>
                            </div>
                        <!-- popupModal -->
                                </div>
                            <?php endif; ?>
                        </td>
                    </tr>

                <?php endforeach; 
                else:?>
                <tr>
                    <td colspan="7" class="null-text">
                        No events found.
                    </td>
                </tr>
                <?php endif; ?>
                   
            </tbody>
        </table>

        <script src="<?php echo URLROOT ?>/js/users/admin/eventfilter.js"></script>

        <script>
            
        </script>