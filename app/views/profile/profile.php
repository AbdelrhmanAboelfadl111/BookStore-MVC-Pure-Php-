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
 * @var string $totalItemsIntoCart
 * 
 */



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo asset("css/bootstrap.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("css/global.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("css/fonts.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("css/profile/profile.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("css/profile/profile.responsive.css"); ?>">
    <link rel="shortcut icon" href="<?php echo asset("imgs/logo.png"); ?>" type="image/x-icon">
    <title>Profile | <?= ucfirst(auth('role'))  ?></title>
</head>

<body>

    <?php include __DIR__ . "/../components/navBar.php" ?>
    <?php include __DIR__ . "/../profile/components/popUps.php" ?>

    <section class="informations h-100 d-flex">
        <div class="row w-100 m-0">
            <div class="col-xxl-4">
                <aside class="userDetails m-auto h-100 w-100">
                    <div class="infoBox">
                        <div class="imgCon">
                            <img src="<?= asset("imgs/default.png"); ?>">
                        </div>
                        <div class="nameCon mb-3">
                            <img class="edit" src="<?= asset("imgs/people.png"); ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                            <h3><?= ucfirst(auth('name'))  ?></h3>
                        </div>
                        <div class="infoCon ">
                            <div class="mail mb-2">
                                <img class="edit" src="<?= asset("imgs/people.png"); ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                <h3 class="lable">Email :</h3>
                                <h3 class="info"> <?= ucfirst(auth('email'))  ?></h3>
                            </div>
                            <div class="gender mb-2">
                                <img class="edit" src="<?= asset("imgs/people.png"); ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop3">
                                <h3 class="lable">Gender :</h3>
                                <h3 class="info"> <?= ucfirst(auth('gender'))  ?></h3>
                            </div>
                            <div class="Password mb-2">
                                <img class="edit" src="<?= asset("imgs/people.png"); ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop4">
                                <h3 class="lable">Password :</h3>
                                <h3 class="info"> **********</h3>
                            </div>
                        </div>
                    </div>
                </aside>

            </div>
            <div class="col-xxl-8">
                <section class="main m-auto h-100 w-100">
                    <div class="container h-100 h-100 p-3">

                        <div class="item">
                            <ul class="nav nav-tabs " id="myTab" role="tablist">

                                <li class="nav-item me-2" role="presentation">
                                    <button class="nav-link active" id="Statistics-tab" data-bs-toggle="tab" data-bs-target="#Statistics-tab-pane" type="button" role="tab" aria-controls="Statistics-tab-pane" aria-selected="true">Statistics</button>
                                </li>

                                <?php if (isAuth('admin')): ?>

                                    <li class="nav-item me-2" role="presentation">
                                        <button
                                            class="nav-link"
                                            id="home-tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#home-tab-pane"
                                            type="button"
                                            role="tab"
                                            aria-controls="home-tab-pane"
                                            aria-selected="true">
                                            Admins
                                        </button>
                                    </li>

                                    <li class="nav-item me-2" role="presentation">
                                        <button
                                            class="nav-link"
                                            id="Customers-tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#Customers-tab-pane"
                                            type="button"
                                            role="tab"
                                            aria-controls="Customers-tab-pane"
                                            aria-selected="false">
                                            Customers
                                        </button>
                                    </li>

                                    <li class="nav-item me-2" role="presentation">
                                        <button
                                            class="nav-link"
                                            id="Authors-tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#Authors-tab-pane"
                                            type="button"
                                            role="tab"
                                            aria-controls="Authors-tab-pane"
                                            aria-selected="false">
                                            Authors
                                        </button>
                                    </li>

                                <?php endif; ?>





                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-black" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Orders
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li id="Ordered-tab" data-bs-toggle="tab" data-bs-target="#Ordered-tab-pane" type="button" role="tab" aria-controls="Ordered-tab-pane" aria-selected="false">
                                            <a class="dropdown-item">Ordered</a>
                                        </li>

                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>

                                        <li id="Canceled-tab" data-bs-toggle="tab" data-bs-target="#Canceled-tab-pane" type="button" role="tab" aria-controls="Canceled-tab-pane" aria-selected="false">
                                            <a class="dropdown-item">Canceled</a>
                                        </li>

                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>

                                        <li id="Done-tab" data-bs-toggle="tab" data-bs-target="#Done-tab-pane" type="button" role="tab" aria-controls="Done-tab-pane" aria-selected="false">
                                            <a class="dropdown-item">Done</a>
                                        </li>
                                    </ul>
                                </li>

                                <?php if (isAuth('customer')): ?>

                                    <li class="nav-item me-2" role="presentation">
                                        <button class="nav-link" id="Books-tab" data-bs-toggle="tab" data-bs-target="#Books-tab-pane" type="button" role="tab" aria-controls="Books-tab-pane" aria-selected="false">Books</button>
                                    </li>

                                    <li data-bs-toggle="modal" data-bs-target="#staticBackdrop8" onclick="getItemsIntoCart();" class="nav-item cart ms-auto d-flex justify-content-center align-items-center" role="presentation">
                                        <button type="button" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free v7.3.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                                                <path d="M24-16C10.7-16 0-5.3 0 8S10.7 32 24 32l45.3 0c3.9 0 7.2 2.8 7.9 6.6l52.1 286.3c6.2 34.2 36 59.1 70.8 59.1L456 384c13.3 0 24-10.7 24-24s-10.7-24-24-24l-255.9 0c-11.6 0-21.5-8.3-23.6-19.7l-5.1-28.3 303.6 0c30.8 0 57.2-21.9 62.9-52.2L568.9 69.9C572.6 50.2 557.5 32 537.4 32l-412.7 0-.4-2c-4.8-26.6-28-46-55.1-46L24-16zM208 512a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm224 0a48 48 0 1 0 0-96 48 48 0 1 0 0 96z" />
                                            </svg> <span id="countOfOrders" class="badge text-bg-secondary"><?= $totalItemsIntoCart ?></span>
                                        </button>
                                    </li>

                                <?php endif; ?>


                            </ul>
                        </div>

                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active  p-3" id="Statistics-tab-pane" role="tabpanel" aria-labelledby="Statistics-tab" tabindex="0">
                                <?php include __DIR__ . "/components/Statistics.php" ?>
                            </div>



                            <?php if (isAuth('admin')): ?>

                                <div class="tab-pane fade p-3" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                    <?php include __DIR__ . "/components/admins.php" ?>
                                </div>


                                <div class="tab-pane fade  p-3" id="Customers-tab-pane" role="tabpanel" aria-labelledby="Customers-tab" tabindex="0">
                                    <?php include __DIR__ . "/components/customers.php" ?>
                                </div>

                                <div class="tab-pane fade p-3" id="Authors-tab-pane" role="tabpanel" aria-labelledby="Authors-tab" tabindex="0">
                                    <button class="btn btn-success w-100 m-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop6">Add Author</button>
                                    <?php include __DIR__ . "/components/authors.php" ?>

                                </div>

                            <?php endif; ?>





                            <div class="tab-pane fade p-3" id="Books-tab-pane" role="tabpanel" aria-labelledby="Books-tab" tabindex="0">
                                <div id="BooksFilter">
                                    <form action="" id="filterBook">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free v7.3.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                                                            <path d="M144 128a80 80 0 1 1 160 0 80 80 0 1 1 -160 0zm208 0a128 128 0 1 0 -256 0 128 128 0 1 0 256 0zM48 480c0-70.7 57.3-128 128-128l96 0c70.7 0 128 57.3 128 128l0 8c0 13.3 10.7 24 24 24s24-10.7 24-24l0-8c0-97.2-78.8-176-176-176l-96 0C78.8 304 0 382.8 0 480l0 8c0 13.3 10.7 24 24 24s24-10.7 24-24l0-8z" />
                                                        </svg></span>
                                                    <input type="text" name="BookTitle" class="form-control" placeholder="BookTitle" aria-label="BookTitle" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">📖</span>
                                                    <input type="text" name="BookAuthor" class="form-control" placeholder="BookAuthor" aria-label="BookAuthor" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">$</span>
                                                    <input type="text" name="BookMin" class="form-control" placeholder="BookMin" aria-label="BookMin" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">$</span>
                                                    <input type="text" name="BookMax" class="form-control" placeholder="BookMax" aria-label="BookMax" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">#</span>
                                                    <input type="text" name="BookStock" class="form-control" placeholder="BookStock" aria-label="BookStock" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">^
                                                    </span>
                                                    <select class="form-control" name="BookSort" id="BookSort">
                                                        <option value="DESC">DESC</option>
                                                        <option value="ASC">ASC</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <button type="submit" id="filterBooksButton" class="btn btn-success w-100">Filter</button>
                                            </div>
                                        </div>
                                    </form>
                                    <?php include __DIR__ . "/components/books.php" ?>
                                </div>
                            </div>

                            <div class="tab-pane fade  p-3" id="Ordered-tab-pane" role="tabpanel" aria-labelledby="Ordered-tab" tabindex="0">
                                <div class="column w-100">
                                    <div class="content row" id="Ordered">
                                        <?php include __DIR__ . "/components/orderedBooks.php" ?>
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade  p-3" id="Canceled-tab-pane" role="tabpanel" aria-labelledby="Canceled-tab" tabindex="0">
                                <div class="column w-100">
                                    <div class="content row" id="Canceled">
                                        <?php include __DIR__ . "/components/canceled.php" ?>
                                    </div>

                                </div>
                            </div>


                            <div class="tab-pane fade  p-3" id="Done-tab-pane" role="tabpanel" aria-labelledby="Done-tab" tabindex="0">
                                <div class="content row" id="Done">
                                    <?php include __DIR__ . "/components/done.php" ?>
                                </div>

                            </div>
                        </div>

                    </div>










                </section>
            </div>
        </div>
    </section>








    <script src="<?php echo asset("js/bootstrap.js"); ?>"></script>
    <script src="<?php echo asset("js/jQuery.js"); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo asset("js/profile/profile.js"); ?>"></script>

    <?php

    if (isAuth('customer')) {
        echo "<script src='" . asset("js/profile/customer.js") . "'></script>";
    }

    ?>



    <?php $editSuccess = getFlash('editSuccess'); ?>
    <?php $editError = getFlash('editError'); ?>

    <?php if ($editSuccess !== null): ?>
        <script>
            isError(
                "success",
                <?= json_encode($editSuccess, JSON_UNESCAPED_UNICODE) ?>
            );
        </script>
    <?php endif; ?>

    <?php if ($editError !== null): ?>
        <script>
            isError(
                "error",
                <?= json_encode($editError, JSON_UNESCAPED_UNICODE) ?>
            );
        </script>
    <?php endif; ?>


</body>

</html>