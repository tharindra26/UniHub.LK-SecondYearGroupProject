<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT ?>/css/users/admin/typefilter_style.css">
<h1 class="section-title"></h1>
<table class="user-table">
    <thead>
        <tr>
            <th>Domin Id</th>
            <th>University</th>
            <th>Domain</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data['domains'][0]->domain_id)): ?>
            <?php foreach ($data['domains'] as $domain):
                if (empty($domain)):
                    break;
                endif;
                // $popupId = "popup" . $user->id; 
                $domainId = $domain->domain_id; ?>
                <tr>
                    <td><?php echo $domain->domain_id ?></td>
                    <td><?php echo $domain->university_name ?></td>
                    <td><?php echo $domain->domain ?></td>

                    <td class="action">
                        <div class="unidomain-option" data-id="<?php echo $domain->domain_id ?>">
                            <i class="fa-solid fa-trash-can"></i>
                        </div>
                    </td>
                </tr>

            <?php endforeach;
        else: ?>
            <tr>
                <td colspan="7" class="null-text">
                    No University domain found.
                </td>
            </tr>
        <?php endif; ?>

    </tbody>
</table>

<script>
    var URLROOT = document.querySelector('.urlRootValue').textContent.trim();


    function deleteUnidomain(domainId) {
        $.ajax({
            type: 'POST',
            url: URLROOT + '/universities/deleteDomain',
            data: { domainId: domainId },
            success: function (response) {
                console.log(response);
                $('#search-bar-unidomain').val(null);
                handleUniDomainFilters();
            },
            error: function (xhr, status, error) {
                console.error('Failed to like the post:', error);
            }
        });
    }

    // Attach click event listener to like buttons
    $('.unidomain-option').click(function () {
        var domainId = $(this).data('id');
        var confirmation = confirm("Are you sure you want to delete this university domain?");
        if (confirmation) {
            deleteUnidomain(domainId);
        } else {
            return false;
        }
    });
</script>