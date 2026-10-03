<?php

/**
 * @var string $totalBooks
 * @var string $totalAuthors
 * @var string $totalCustomers
 * @var string  $totalAdmins
 * @var string $totalOrdersOrderd
 * @var string $totalOrdersCanceld
 * @var string $totalOrdersDone
 *  @var string $total
 * @var string $totalBoughtBooks
 * 
 */



?>
<div class="content row" id="Statistics">
    <div class="col-lg-3 column">
        <div class="infoBox  h-100">
            <div class="imgCon mb-3">
                <img src="<?= asset("imgs/book.png"); ?>">
            </div>
            <div class="nameCon mb-3">
                <h3>Total Books</h3>
            </div>
            <div class="count">
                <h5><?= $totalBooks ?></h5>
            </div>

        </div>
    </div>

    <?php if (isAuth('admin')): ?>

    <div class="col-lg-3 column">
        <div class="infoBox h-100">
            <div class="imgCon mb-3">
                <img src="<?= asset('imgs/auth.png'); ?>">
            </div>

            <div class="nameCon mb-3">
                <h3>Auths</h3>
            </div>

            <div class="count">
                <h5><?= $totalAuthors ?></h5>
            </div>
        </div>
    </div>

    <div class="col-lg-3 column">
        <div class="infoBox h-100">
            <div class="imgCon mb-3">
                <img src="<?= asset('imgs/customer.png'); ?>">
            </div>

            <div class="nameCon mb-3">
                <h3>Customers</h3>
            </div>

            <div class="count">
                <h5><?= $totalCustomers ?></h5>
            </div>
        </div>
    </div>

    <div class="col-lg-3 column">
        <div class="infoBox h-100">
            <div class="imgCon mb-3">
                <img src="<?= asset('imgs/admins.png'); ?>">
            </div>

            <div class="nameCon mb-3">
                <h3>Admins</h3>
            </div>

            <div class="count">
                <h5><?= $totalAdmins ?></h5>
            </div>
        </div>
    </div>

<?php endif; ?>

    <?php if (isAuth('customer')): ?>

        <div class="col-lg-3 column">
            <div class="infoBox h-100">

                <div class="imgCon mb-3">
                    <img src="<?= asset('imgs/book.png'); ?>" alt="Books">
                </div>

                <div class="nameCon mb-3">
                    <h3>Total Bought Books</h3>
                </div>

                <div class="count">
                    <h5><?= $totalBoughtBooks ?></h5>
                </div>

            </div>
        </div>

    <?php endif; ?>
    <div class="col-lg-3 column">
        <div class="infoBox  h-100">
            <div class="imgCon mb-3">
                <img src="<?= asset("imgs/pending.png"); ?>">
            </div>
            <div class="nameCon mb-3">
                <h3>Pending Orders</h3>
            </div>
            <div class="count">
                <h5><?= $totalOrdersOrderd ?></h5>
            </div>

        </div>
    </div>
    <div class="col-lg-3 column">
        <div class="infoBox  h-100">
            <div class="imgCon mb-3">
                <img src="<?= asset("imgs/canceled.png"); ?>">
            </div>
            <div class="nameCon mb-3">
                <h3>Canceled Orders</h3>
            </div>
            <div class="count">
                <h5><?= $totalOrdersCanceld ?></h5>
            </div>

        </div>
    </div>
    <div class="col-lg-3 column">
        <div class="infoBox  h-100">
            <div class="imgCon mb-3">
                <img src="<?= asset("imgs/done.svg"); ?>">
            </div>
            <div class="nameCon mb-3">
                <h3>Done Orders</h3>
            </div>
            <div class="count">
                <h5><?= $totalOrdersDone ?></h5>
            </div>

        </div>
    </div>
</div>
