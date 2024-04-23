<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/typefilter_style.css">
<h1 class="section-title"></h1>
<table class="user-table">
        <thead>
            <tr>
                <th>organization ID</th>
                <th>organization Title</th>
                <th>User ID</th>
                <th>Category</th>
                <th>Contact Email</th>
                <th>University</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data['organizations'][0]->organization_id)) : ?> 
            <?php foreach ($data['organizations'] as $organization):
                if (empty($organization)):
                    break;
                endif;
                // $popupId = "popup" . $user->id; 
                $organizationId = $organization->organization_id;?>
                    <tr>
                        <td><?php echo $organization->organization_id ?></td>
                        <td><?php echo $organization->organization_name ?></td>
                        <td><?php echo $organization->user_id ?></td>
                        <td><?php echo $organization->category_names ?></td>
                        <td><?php echo $organization->contact_email ?></td>
                        <td><?php echo $organization->university ?></td>
                        <td>
                        <div class="<?php echo ($organization->status == 1) ? 'activated' : 'deactivated'; ?>"><?php
                            if ($organization->status == 1):
                                echo "Active";
                            else:
                                echo "Deactivated";
                            endif;
                        ?></div>
                        </td>
                        <td class="action">
                            <a href="<?php echo URLROOT ?>/organizations/show/<?php echo $organization->organization_id ?>" class="view"><i class="fa-solid fa-eye"></i><a>
                            <a href="<?php echo URLROOT ?>/organizations/settings/<?php echo $organization->organization_id ?>" class="update"><i class="fa-solid fa-pen-to-square"></i></a>
                            <?php
                            if ($organization->status == 0): ?>
                                <div class="activate">
                                    <a href="#" class="delete" onclick="openPopup('<?php echo $organizationId; ?>')"><i
                                            class="fa-solid fa-bell"></i></a>
                                    <!-- popupModal -->
                                <span class="overlay"></span>
                                <div class="modal-box" id="<?php echo $organizationId; ?>">
                                    <!-- <i class="fa-solid fa-xmark"></i> -->
                                    <i class="fa-solid fa-circle-check"></i>
                                    <h2>Confirm Activation</h2>
                                    <p>Are you sure you want to active the Event. EventId:<?php echo $organizationId ?> </p>
                                <div class="btn">
                                    <button class="confirm-btn"
                                                onclick="confirmActivate('<?php echo $organizationId; ?>')">Activate</button>
                                            <button class="confirm-btn"
                                                onclick="closePopup('<?php echo $organizationId; ?>')">Cancel</button>
                                </div>
                            </div>
                        <!-- popupModal -->
                                </div>

                            <?php else: ?>
                                <div class="deactivate">
                                    <a href="#" class="delete" onclick="openPopup('<?php echo $organizationId; ?>')"><i
                                            class="fa-solid fa-trash-can"></i></a>
                                          <!-- popupModal -->
                                <span class="overlay"></span>
                                <div class="modal-box" id="<?php echo $organizationId; ?>">
                                    <!-- <i class="fa-solid fa-xmark"></i> -->
                                    <i class="fa-solid fa-circle-check"></i>
                                    <h2>Confirm Activation</h2>
                                    <p>Are you sure you want to active the Event. EventId:<?php echo $organizationId ?> </p>
                                <div class="btn">
                                    <button class="confirm-btn"
                                                onclick="confirmDeactivate('<?php echo $organizationId; ?>')">Activate</button>
                                            <button class="confirm-btn"
                                                onclick="closePopup('<?php echo $organizationId; ?>')">Cancel</button>
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
                        No organizations found.
                    </td>
                </tr>
                <?php endif; ?>
                   
            </tbody>
        </table>

        <script src="<?php echo URLROOT ?>/js/users/admin/organizationfilter.js"></script>

        <script>
            
        </script>