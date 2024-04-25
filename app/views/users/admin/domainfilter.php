<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/typefilter_style.css">
<h1 class="section-title"></h1>

<table class="user-table">
    <thead>
        <tr>
            <th>Domain ID</th>
            <th>Website</th>
            <th>Domain</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['domains'][0]->post_domain_id)): ?>
            <?php foreach ($data['domains'] as $domain):
                if (empty($domain)):
                    break;
                endif;
                // $popupId = "popup" . $user->id; 
                $domainId = $domain->post_domain_id; ?>
                <tr>
                    <td><?php echo $domain->post_domain_id ?></td>
                    <td><?php echo $domain->website ?></td>
                    <td><?php echo $domain->domain ?></td>


                    <td class="action">

                        <div class="domain-option" data-id="<?php echo $domain->post_domain_id ?>">
                            <i class="fa-solid fa-trash-can"></i>
                        </div>

                    </td>
                </tr>

            <?php endforeach;
        else: ?>
            <tr>
                <td colspan="7" class="null-text">
                    No domains found.
                </td>
            </tr>
        <?php endif; ?>

    </tbody>
</table>

<script>
    var URLROOT = document.querySelector('.urlRootValue').textContent.trim();

    function deleteDomain(domainId) {
        $.ajax({
            type: 'POST',
            url: URLROOT + '/posts/deleteDomain',
            data: { domainId: domainId },
            success: function (response) {
                $('#search-bar-post-domain').val(null);
                handleDomainFilters();
            },
            error: function (xhr, status, error) {
                console.error('Failed to like the post:', error);
            }
        });
    }

    // Attach click event listener to like buttons
    $('.domain-option').click(function () {
        var domainId = $(this).data('id');
        var confirmation = confirm("Are you sure you want to delete this domain?");
        if (confirmation) {
            deleteDomain(domainId);
        } else {
            return false;
        }
    });

    // Check if the user has liked each post and update the heart icon accordingly

</script>