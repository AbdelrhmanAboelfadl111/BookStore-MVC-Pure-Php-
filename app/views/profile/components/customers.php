<?php

/**
 * @var string  $totalcustomers
 */



?>
<div class="content row" id="customers">
    <?php
    if (!empty($customer['data'])) {
        foreach ($customer['data'] as $customerItem) {
            $customerImg = asset('imgs/client.png');
            $isBadgeBand = ($customerItem['is_banned']) ? " <span class='badge text-bg-danger position-absolute'>Baned</span>" : '';
            $isBandBtn = ($customerItem['is_banned'])
                ? "<button type='button' class='btn btn-secondary w-100' onclick=\"banUser({$customerItem['id']}, 'UnBan', event)\">UnBan</button>"
                : "<button type='button' class='btn btn-danger w-100' onclick=\"banUser({$customerItem['id']}, 'Ban', event)\">Ban</button>";
            echo "
                    <div class='col-lg-6 column'>
                        <div class='infoBox h-100'>
                        {$isBadgeBand}
                            <div class='imgCon'>
                                <img src='{$customerImg}'>
                            </div>
                            <div class='nameCon mb-3'>
                                <h3>{$customerItem['name']}</h3>
                            </div>
                            <div class='infoCon mb-2'>
                                <div class='mail mb-2'>
                                    <h3 class='lable fw-bold'>Email :</h3>
                                    <h3 class='info'> {$customerItem['email']}</h3>
                                </div>
                                <div class='gender mb-2'>
                                    <h3 class='lable fw-bold'>Gender :</h3>
                                    <h3 class='info '> {$customerItem['gender']}</h3>
                                </div>
                                <div class='gender mb-2'>
                                    <h3 class='lable fw-bold'>Phone :</h3>
                                    <h3 class='info '> {$customerItem['phone']}</h3>
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
        echo "<p class= 'alert alert-danger'>No customers</p>";
    }

    ?>




</div>



<?php
if (!empty($customer['data'])) {

    $prepareLi = "";

    $pagesNumber = ceil($customer['total'] / 10);

    $nextPageNumber = ($customer['current_page'] < $pagesNumber) ? $customer['current_page'] + 1 : $pagesNumber;

    $isNextPageDisabled = ($customer['current_page'] < $pagesNumber) ? '' : 'disabled';

    $isPrevPageDisabled = ($customer['current_page'] > 1) ? '' : 'disabled';

    $prevPageNumber = ($customer['current_page'] > 1) ? $customer['current_page'] - 1 : $customer['current_page'];

    $profileLink = route('/profile');

    for ($i = 1; $i <= $pagesNumber; $i++) {
        $isActive = ($customer['current_page'] == $i) ? 'active' : '';
        $prepareLi .= "
            <li class='page-item'><a class='page-link {$isActive}' href = '{$profileLink}?Customers-page={$i}'>{$i}</a></li>
        
        
        ";
    }


    echo "
        <nav aria-label='Page navigation example'>
            <ul class='pagination'>
                <li class='page-item'><a class='page-link {$isPrevPageDisabled}' href = '{$profileLink}?Customers-page={$prevPageNumber}'>Previous</a></li>
                {$prepareLi}
                <li class='page-item'><a class='page-link {$isNextPageDisabled}' href = '{$profileLink}?Customers-page={$nextPageNumber}'>Next</a></li>
            </ul>
        </nav>    
    ";
}

?>