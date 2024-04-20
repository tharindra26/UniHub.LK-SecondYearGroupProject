<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/typefilter_style.css">
<h1 class="section-title"></h1>

<table class="user-table">
        <thead>
            <tr>
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
                        <td><?php echo $event->title ?></td>
                        <td><?php echo $event->user_id ?></td>
                        <td><?php echo $event->category_names ?></td>
                        <td><?php echo $event->contact_number ?></td>
                        <td><?php
                            if ($event->approval == "approved"):
                                echo "Approved";
                            elseif($event->approval == "rejected"):
                                echo "Rejected";
                            else:
                                echo "Pending";
                            endif;
                        ?></td>
                        <td><?php
                            if ($event->status == 1):
                                echo "Active";
                            else:
                                echo "Deactivated";
                            endif;
                        ?></td>
                        <td>
                            <a href="#" class="view"><i class="fa-solid fa-eye"></i></a>
                            <a href="#" class="update"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="#" class="delete"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>

                <?php endforeach; ?>
                <?php endif; ?>
                   
            </tbody>
        </table>

        <script src="<?php echo URLROOT ?>/js/users/admin/eventfilter.js"></script>