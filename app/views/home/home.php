<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo asset("css/bootstrap.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("css/global.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("css/fonts.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("css/home/index.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("css/home/index.responsive.css"); ?>">
    <link rel="shortcut icon" href="<?php echo asset("imgs/logo.png"); ?>" type="image/x-icon">
    <title>Home</title>
</head>

<body>

    <?php include __DIR__ . "/../components/navBar.php" ?>

    <header class="vh-100">
        <div id="carouselExampleDark" class="carousel carousel-dark slide h-100 overflow-hidden">
            <div class="carousel-indicators ">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner h-100">
                <div class="carousel-item active h-100" data-bs-interval="10000">
                    <div class="container h-100">
                        <div class="row h-100 d-flex justify-content-center align-items-center">

                            <div class="col-sm-12 col-md-6 col-lg-6 column column1">
                                <div class="item">
                                    <h5>SEARCH BOOKS EASILY</h5>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum, quod velit error excepturi sint distinctio culpa quo consequatur architecto aperiam.</p>
                                    <button class="btn btn-success">Read More</button>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 column column2">
                                <img src="<?= asset("imgs/page1.png"); ?>" class=" " alt="...">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="carousel-item h-100" data-bs-interval="2000">
                    <div class="container h-100">
                        <div class="row h-100 d-flex justify-content-center align-items-center">

                            <div class="col-sm-12 col-md-6 col-lg-6 column column1">
                                <div class="item">
                                    <h5>SEARCH BOOKS EASILY</h5>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum, quod velit error excepturi sint distinctio culpa quo consequatur architecto aperiam.</p>
                                    <button class="btn btn-success">Read More</button>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 column column2">
                                <img src="<?= asset("imgs/page2.png"); ?>" class=" " alt="...">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="carousel-item h-100">
                    <div class="container h-100">
                        <div class="row h-100 d-flex justify-content-center align-items-center">

                            <div class="col-sm-12 col-md-6 col-lg-6 column column1">
                                <div class="item">
                                    <h5>SEARCH BOOKS EASILY</h5>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum, quod velit error excepturi sint distinctio culpa quo consequatur architecto aperiam.</p>
                                    <button class="btn btn-success">Read More</button>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 column column2">
                                <img src="<?= asset("imgs/page3.png"); ?>" class=" " alt="...">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev justify-content-start ps-5" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next justify-content-end pe-5" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </header>









    <script src="<?php echo asset("js/bootstrap.js"); ?>"></script>
    <script src="<?php echo asset("js/jQuery.js"); ?>"></script>
    <script src="<?php echo asset("js/home/index.js"); ?>"></script>

</body>

</html>