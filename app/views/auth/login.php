<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo asset("css/bootstrap.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("css/global.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("css/fonts.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("css/auth/login/login.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("css/auth/login/login.responsive.css"); ?>">
    <title>Login</title>
</head>

<body>
    <?php include __DIR__ . "/../components/navBar.php" ?>
    <section class="vh-100 d-flex justify-content-center align-items-center">

        <div class="container h-100 d-flex justify-content-center align-items-center ">
            <div class="row w-100">
                <div class="col-sm-12 col-md-6 col-lg-6 column column1 d-flex justify-content-center align-items-center">
                    <div class="box position-relative p-5 rounded-2 ">
                        <div class="title mb-4 w-100 text-center  ">
                            <h2>Login</h2>
                        </div>
                        <form class="w-100" action="<?= route('/auth/login') ?>" method="post">
                            <fieldset class="w-100">
                                <div class="mb-3">
                                    <label for="TextInput" class="form-label">Email</label>
                                    <input type="email" id="EmailInput" class="form-control" placeholder="Email" name="Email" value="<?= getOld('Email') ?>">
                                    <?= getErrors('Email') ?>
                                </div>
                                <div class="mb-3">
                                    <label for="disabledSelect" class="form-label">Password</label>
                                    <input type="password" id="PasswordInput" class="form-control" placeholder="Password" name="Password" value="<?= getOld('Password') ?>">
                                    <?= getErrors('Password') ?>
                                </div>
                                <div class="item w-100 d-flex justify-content-center align-items-center mb-3">
                                    <button type="submit" class="btn btn-primary w-75 m-auto">Submit</button>
                                </div>
                            </fieldset>
                        </form>
                        <?= getErrors('invalid') ?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 column column2 d-flex justify-content-center">
                    <img class="bgImg" src="<?= asset("imgs/login.jpg") ?>" alt="">
                </div>
            </div>

        </div>
    </section>



    <script src="<?php echo asset("js/bootstrap.js"); ?>"></script>
    <script src="<?php echo asset("js/jQuery.js"); ?>"></script>
    <script src="<?php echo asset("js/auth/login.js"); ?>"></script>
</body>

</html>