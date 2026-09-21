<?php

/**
 * @var string $totalbooks
 */

?>

<div class="content row" id="books">

    <?php if (isAuth('customer')): ?>

        <?php if (!empty($books['data'])): ?>

            <?php foreach ($books['data'] as $book): ?>

                <?php
                $bookImg = ($book['image'] == null)
                    ? asset('imgs/uploads/book.png')
                    : asset("imgs/uploads/{$book['image']}");
                ?>

                <div class="col-lg-6 column">
                    <div class="infoBox h-100">

                        <div class="imgCon">
                            <img src="<?= $bookImg ?>">
                        </div>

                        <div class="nameCon mb-3">
                            <h3><?= $book['title'] ?></h3>
                        </div>

                        <div class="infoCon mb-2">

                            <div class="mail mb-2">
                                <h3 class="lable fw-bold">Author :</h3>
                                <h3 class="info">
                                    <?= $book['author_name'] ?>
                                </h3>
                            </div>

                            <div class="gender mb-2">
                                <h3 class="lable fw-bold">Price :</h3>
                                <h3 class="info">
                                    <?= $book['price'] ?>
                                </h3>
                            </div>

                            <div class="gender mb-2">
                                <h3 class="lable fw-bold">Stock :</h3>
                                <h3 class="info">
                                    <?= $book['stock'] ?>
                                </h3>
                            </div>

                        </div>
                        <?php if (isAuth('customer')): ?>

                            <div class="input-group mb-3">
                                <button class="btn btn-outline-success" type="button" id="button-addon1" onclick="addToCart(<?= $book['id'] ?>,this)">
                                    Add To Cart
                                </button>

                                <input
                                    type="number"
                                    class="form-control"
                                    placeholder="Quantity"
                                    min="1"
                                    id="input-quantity-<?= $book['id'] ?>">
                            </div>

                        <?php endif; ?>

                    </div>
                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <p class="alert alert-danger">No books</p>

        <?php endif; ?>

    <?php endif; ?>

</div>


<?php

if (isAuth('customer') && !empty($books['data'])) {

    $prepareLi = "";

    $pagesNumber = ceil($books['total'] / 10);

    $currentPage = $books['current_page'];

    $nextPageNumber = ($currentPage < $pagesNumber)
        ? $currentPage + 1
        : $pagesNumber;

    $prevPageNumber = ($currentPage > 1)
        ? $currentPage - 1
        : 1;

    $isNextPageDisabled = ($currentPage >= $pagesNumber)
        ? 'disabled'
        : '';

    $isPrevPageDisabled = ($currentPage <= 1)
        ? 'disabled'
        : '';

    $profileLink = route('/profile');


    for ($i = 1; $i <= $pagesNumber; $i++) {

        $isActive = ($currentPage == $i)
            ? 'active'
            : '';

        $prepareLi .= "
            <li class='page-item'>
                <a
                    class='page-link {$isActive}'
                    href='{$profileLink}?Books-page={$i}'
                >
                    {$i}
                </a>
            </li>
        ";
    }


    echo "
        <nav aria-label='Page navigation'>
            <ul class='pagination'>

                <li class='page-item {$isPrevPageDisabled}'>
                    <a
                        class='page-link'
                        href='{$profileLink}?Books-page={$prevPageNumber}'
                    >
                        Previous
                    </a>
                </li>

                {$prepareLi}

                <li class='page-item {$isNextPageDisabled}'>
                    <a
                        class='page-link'
                        href='{$profileLink}?Books-page={$nextPageNumber}'
                    >
                        Next
                    </a>
                </li>

            </ul>
        </nav>
    ";
}
