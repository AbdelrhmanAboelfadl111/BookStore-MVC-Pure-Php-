<?php

/**
 * @var string  $totalAdmins
 */



?>
<div class="content row" id="Admins">
    <?php
    if (!empty($Admin['data'])) {

        foreach ($Admin['data'] as $admin) {
            $isBadgeBand = ($admin['is_banned']) ? " <span class='badge text-bg-danger position-absolute'>Baned</span>" : '';
            $isBandBtn = ($admin['is_banned'])
                ? "<button type='button' class='btn btn-secondary w-100' onclick=\"banUser({$admin['id']}, 'UnBan', event)\">UnBan</button>"
                : "<button type='button' class='btn btn-danger w-100' onclick=\"banUser({$admin['id']}, 'Ban', event)\">Ban</button>";
            $adminImg = asset('imgs/admin.png');
            echo "
                    <div class='col-lg-6 column'>
                        <div class='infoBox h-100'>
                            {$isBadgeBand}
                            <div class='imgCon'>
                                <img src='{$adminImg}'>
                            </div>
                            <div class='nameCon mb-3'>
                                <h3>{$admin['name']}</h3>
                            </div>
                            <div class='infoCon mb-2'>
                                <div class='mail mb-2'>
                                    <h3 class='lable fw-bold'>Email :</h3>
                                    <h3 class='info'> {$admin['email']}</h3>
                                </div>
                                <div class='gender mb-2'>
                                    <h3 class='lable fw-bold'>Gender :</h3>
                                    <h3 class='info '> {$admin['gender']}</h3>
                                </div>
                                <div class='gender mb-2'>
                                    <h3 class='lable fw-bold'>Phone :</h3>
                                    <h3 class='info '> {$admin['phone']}</h3>
                                </div>
                            </div>
                            <div class='btnCon w-100'>
                                {$isBandBtn}
                            </div>
                        </div>
                    </div>
                
                
                ";
        }
    } else {
        echo "<p class= 'alert alert-danger'>No Admins</p>";
    }

    ?>




</div>

<?php
if (!empty($Admin['data'])) {

    $prepareLi = "";

    $pagesNumber = ceil($Admin['total'] / 10);

    $nextPageNumber = ($Admin['current_page'] < $pagesNumber) ? $Admin['current_page'] + 1 : $pagesNumber;

    $isNextPageDisabled = ($Admin['current_page'] < $pagesNumber) ? '' : 'disabled';

    $isPrevPageDisabled = ($Admin['current_page'] > 1) ? '' : 'disabled';

    $prevPageNumber = ($Admin['current_page'] > 1) ? $Admin['current_page'] - 1 : $Admin['current_page'];

    $profileLink = route('/profile');

    for ($i = 1; $i <= $pagesNumber; $i++) {
        $isActive = ($Admin['current_page'] == $i) ? 'active' : '';
        $prepareLi .= "
            <li class='page-item'><a class='page-link {$isActive}' href = '{$profileLink}?home-page={$i}'>{$i}</a></li>
        
        
        ";
    }


    echo "
        <nav aria-label='Page navigation example'>
            <ul class='pagination'>
                <li class='page-item'><a class='page-link {$isPrevPageDisabled}' href = '{$profileLink}?home-page={$prevPageNumber}'>Previous</a></li>
                {$prepareLi}
                <li class='page-item'><a class='page-link {$isNextPageDisabled}' href = '{$profileLink}?home-page={$nextPageNumber}'>Next</a></li>
            </ul>
        </nav>    
    ";
}

?>