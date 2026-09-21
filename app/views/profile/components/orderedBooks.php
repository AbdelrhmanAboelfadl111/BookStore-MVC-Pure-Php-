<?php

/**
 * @var array $orders
 */

?>

<div id="ordered">

    <div class="content table-responsive row">
        <table class="table table-info table-striped table-hover rounded-3 overflow-hidden">

            <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Customer</th>
                    <th scope="col" class="text-center">Total Price</th>
                    <th scope="col" class="text-center">Details</th>
                    <th scope="col" class="text-center">Created_at</th>

                    <?php if (isAuth('admin')): ?>
                        <th scope="col" class="text-center">Options</th>
                    <?php endif; ?>
                </tr>
            </thead>

            <tbody id="products">

                <?php if (!empty($orders['ordered']['data'])): ?>

                    <?php foreach ($orders['ordered']['data'] as $order): ?>

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

                            <?php if (isAuth('admin')): ?>

                                <td class="text-center">

                                    <button class="btn btn-success" onclick="getDoneOrders(<?= $order['id'] ?>); return false;">
                                        Done
                                    </button>

                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop9" onclick="setOrderId(<?= $order['id'] ?>)">
                                        Cancel
                                    </button>

                                </td>

                            <?php endif; ?>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="6" class="text-center">

                            <p class="alert alert-danger mb-0">
                                No ordered orders
                            </p>

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>
    </div>


    <?php

    if (!empty($orders['ordered']['data'])) {

        $prepareLi = "";

        $pagesNumber = ceil($orders['ordered']['total'] / 10);

        $nextPageNumber =
            ($orders['ordered']['current_page'] < $pagesNumber)
            ? $orders['ordered']['current_page'] + 1
            : $pagesNumber;

        $isNextPageDisabled =
            ($orders['ordered']['current_page'] < $pagesNumber)
            ? ''
            : 'disabled';

        $isPrevPageDisabled =
            ($orders['ordered']['current_page'] > 1)
            ? ''
            : 'disabled';

        $prevPageNumber =
            ($orders['ordered']['current_page'] > 1)
            ? $orders['ordered']['current_page'] - 1
            : $orders['ordered']['current_page'];

        $profileLink = route('/profile');

        for ($i = 1; $i <= $pagesNumber; $i++) {

            $isActive =
                ($orders['ordered']['current_page'] == $i)
                ? 'active'
                : '';

            $prepareLi .= "
                <li class='page-item'>
                    <a class='page-link {$isActive}'
                       href='{$profileLink}?Ordered-page={$i}'>
                        {$i}
                    </a>
                </li>
            ";
        }

        echo "
            <nav aria-label='Page navigation example'>

                <ul class='pagination'>

                    <li class='page-item'>
                        <a class='page-link {$isPrevPageDisabled}'
                           href='{$profileLink}?Ordered-page={$prevPageNumber}'>
                            Previous
                        </a>
                    </li>

                    {$prepareLi}

                    <li class='page-item'>
                        <a class='page-link {$isNextPageDisabled}'
                           href='{$profileLink}?Ordered-page={$nextPageNumber}'>
                            Next
                        </a>
                    </li>

                </ul>

            </nav>
        ";
    }

    ?>

</div>