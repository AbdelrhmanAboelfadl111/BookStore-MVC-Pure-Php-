<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo asset("css/bootstrap.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("css/global.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("css/fonts.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("css/auth/register/register.css"); ?>">
    <link rel="stylesheet" href="<?php echo asset("css/auth/register/register.responsive.css"); ?>">
    <title>Register</title>
</head>

<body>

    <?php include __DIR__ . "/../components/navBar.php" ?>
    <section class="vh-100 d-flex justify-content-center align-items-center">

        <div class="container h-100 d-flex justify-content-center align-items-center ">
            <div class="row w-100 justify-content-center align-items-center">
                <div class="col-sm-12 col-xxl-8 column column1 d-flex justify-content-center align-items-center">
                    <div class="box position-relative p-5 rounded-2 ">
                        <div class="title mb-4 w-100 text-center  ">
                            <h2>Register</h2>
                        </div>
                        <form class="w-100" method="POST" action="<?= route('/auth/register') ?>">
                            <fieldset class="w-100">
                                <div class="item d-flex justify-content-center align-items-center">
                                    <div class="mb-3 w-50 me-2">
                                        <label for="TextInput" class="form-label">Role</label>
                                        <select name="Role" type="Role" id="RoleInput" class="form-control" placeholder="Role">
                                            <?php 
                                            if(isAuth('admin')){
                                                echo "<option value='admin'>Admin</option>";
                                            }else{
                                                echo "<option value='customer'>Customer</option>";
                                            }
                                            
                                            
                                            
                                            
                                            
                                            ?>
                                        
                                        
                                        
                                            <option value="" selected hidden>Role</option>
                                            
                                        </select>
                                        <?= getErrors('Role') ?>
                                    </div>

                                    <div class="mb-3 w-50">
                                        <label for="GenderInput" class="form-label">Gender</label>
                                        <select name="Gender" type="Gender" id="GenderInput" class="form-control" placeholder="Gender">
                                            <option value="" selected hidden>Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <?= getErrors('Gender') ?>
                                    </div>
                                </div>
                                <div class="item d-flex justify-content-center align-items-center">
                                    <div class="mb-3 me-2">
                                        <label for="UsernameInput" class="form-label">Username</label>
                                        <input type="text" id="UsernameInput" class="form-control" placeholder="Username" name="Username" value="<?= getOld('Username') ?>">
                                        <?= getErrors('Username') ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="TextInput" class="form-label">Email</label>
                                        <input type="email" id="EmailInput" class="form-control" placeholder="Email" name="Email" value="<?= getOld('Email') ?>">
                                        <?= getErrors('Email') ?>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="disabledSelect" class="form-label">Password</label>
                                    <input type="password" id="PasswordInput" class="form-control" placeholder="Password" name="Password" value="<?= getOld('Password') ?>">
                                    <?= getErrors('Password') ?>
                                </div>
                                <div class="mb-3">
                                    <label for="PhoneInput" class="form-label">Phone</label>
                                    <input type="text" id="PhoneInput" class="form-control" placeholder="Phone" name="Phone" value="<?= getOld('Phone') ?>">
                                    <?= getErrors('Phone') ?>
                                </div>

                                <div class="item w-100 d-flex justify-content-center align-items-center mb-3">
                                    <button type="submit" class="btn btn-primary w-75 m-auto">Submit</button>
                                </div>
                            </fieldset>
                        </form>
                        <?= getSuccess('success') ?>
                        <?= getErrors('invalid') ?>
                    </div>
                </div>

            </div>

        </div>
    </section>





    <script src="<?php echo asset("js/bootstrap.js"); ?>"></script>
    <script src="<?php echo asset("js/jQuery.js"); ?>"></script>
    <script src="<?php echo asset("js/auth/register.js"); ?>"></script>
</body>

</html>