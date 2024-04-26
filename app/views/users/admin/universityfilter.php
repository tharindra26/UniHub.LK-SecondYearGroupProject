<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/typefilter_style.css">
<h1 class="section-title"></h1>
<table class="user-table">
    <thead>
        <tr>
            <th>University Id</th>
            <th>Name</th>
            <th>Unicode</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['universities'][0]->id)): ?>
            <?php foreach ($data['universities'] as $uni):
                if (empty($uni)):
                    break;
                endif;
                // $popupId = "popup" . $user->id; 
                $uniId = $uni->id; ?>
                <tr>
                    <td><?php echo $uni->id ?></td>
                    <td><?php echo $uni->name ?></td>
                    <td><?php echo $uni->unicode ?></td>

                    <td class="action">
                        <div class="university-option" data-id="<?php echo $uni->id ?>">
                            <i class="fa-solid fa-trash-can"></i>
                        </div>
                    </td>
                </tr>

            <?php endforeach;
        else: ?>
            <tr>
                <td colspan="7" class="null-text">
                    No University found.
                </td>
            </tr>
        <?php endif; ?>

    </tbody>
</table>

<script>
    var URLROOT = document.querySelector('.urlRootValue').textContent.trim();

    function deleteUniversity(universityId) {
        $.ajax({
            type: 'POST',
            url: URLROOT + '/universities/deleteUniversity',
            data: { universityId: universityId },
            success: function (response) {
                console.log(response);
                $('#search-bar-university').val(null);
                handleUniversityFilters();
            },
            error: function (xhr, status, error) {
                console.error('Failed to like the post:', error);
            }
        });
    }

    // Attach click event listener to like buttons
    $('.university-option').click(function () {
        var universityId = $(this).data('id');
        var confirmation = confirm("Are you sure you want to delete this university?");
        if (confirmation) {
            deleteUniversity(universityId);
        } else {
            return false;
        }
    });
</script>