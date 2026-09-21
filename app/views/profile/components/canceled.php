<?php

/**
 * @var array $orders
 */

?>

<div class="content table-responsive row" id="Canceled">

    <table class="table table-info table-striped table-hover rounded-3 overflow-hidden">

        <thead>
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Customer</th>
                <th scope="col" class="text-center">Total Price</th>
                <th scope="col" class="text-center">Details</th>
                <th scope="col" class="text-center">Created_at</th>

            </tr>
        </thead>

        <tbody id="canceledOrders">

            <?php if (!empty($orders['canceled']['data'])): ?>

                <?php foreach ($orders['canceled']['data'] as $order): ?>

                    <tr data-ordered-id="<?= $order['id'] ?>">

                        <th scope="row">
                            <?= $order['id'] ?>
                        </th>

                        <td class="text-center">
                            <?= $order['users_name'] ?>
                        </td>

                        <td class="text-center">
                            <?= $order['total_price'] ?>
                        </td>

                        <td class="text-center">
                            <a href="#"
                                onclick="getItemsIntoCart(<?= $order['id'] ?>, 'showOrder'); return false;">
                                Show
                            </a>
                        </td>

                        <td class="text-center">
                            <?= $order['created_at'] ?>
                        </td>



                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="6" class="text-center">
                        <p class="alert alert-danger mb-0">
                            No canceled orders
                        </p>
                    </td>
                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</div>





<?php
if (!empty($orders['canceled']['data'])) {

    $prepareLi = "";

    $pagesNumber = ceil($orders['canceled']['total'] / 10);

    $nextPageNumber = ($orders['canceled']['current_page'] < $pagesNumber) ? $orders['canceled']['current_page'] + 1 : $pagesNumber;

    $isNextPageDisabled = ($orders['canceled']['current_page'] < $pagesNumber) ? '' : 'disabled';

    $isPrevPageDisabled = ($orders['canceled']['current_page'] > 1) ? '' : 'disabled';

    $prevPageNumber = ($orders['canceled']['current_page'] > 1) ? $orders['canceled']['current_page'] - 1 : $orders['canceled']['current_page'];

    $profileLink = route('/profile');

    for ($i = 1; $i <= $pagesNumber; $i++) {
        $isActive = ($orders['canceled']['current_page'] == $i) ? 'active' : '';
        $prepareLi .= "
            <li class='page-item'><a class='page-link {$isActive}' href = '{$profileLink}?Canceled-page={$i}'>{$i}</a></li>
        
        
        ";
    }


    echo "
        <nav aria-label='Page navigation example'>
            <ul class='pagination'>
                <li class='page-item'><a class='page-link {$isPrevPageDisabled}' href = '{$profileLink}?Canceled-page={$prevPageNumber}'>Previous</a></li>
                {$prepareLi}
                <li class='page-item'><a class='page-link {$isNextPageDisabled}' href = '{$profileLink}?Canceled-page={$nextPageNumber}'>Next</a></li>
            </ul>
        </nav>    
    ";
}

?>