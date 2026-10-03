<nav class="navbar navbar-expand-lg p-3">

    <div class="container px-5 py-2 rounded-2">

        <a class="navbar-brand" href="<?= route("") ?>">
            <img src="<?= asset("imgs/logo.png"); ?>" class="img-fluid" alt="">
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                <li class="nav-item me-3">
                    <a class="nav-link active" aria-current="page" href="<?= route("") ?>">
                        Home
                    </a>
                </li>

                <?php

                if (isAuth('admin')) {

                    $userName = auth('name');
                    $profileLink = route('/profile');
                    $registerLink = route('/auth/register');
                    $logOut = route('/auth/logout');

                    echo "
                        <li class='nav-item dropdown'>

                            <a
                                class='nav-link dropdown-toggle'
                                href='#'
                                role='button'
                                data-bs-toggle='dropdown'
                                aria-expanded='false'
                            >
                                Hallo, {$userName}
                            </a>

                            <ul class='dropdown-menu'>

                                <li>
                                    <a class='dropdown-item' href='{$profileLink}'>
                                        Profile
                                    </a>
                                </li>

                                <li>
                                    <hr class='dropdown-divider'>
                                </li>

                                <li>
                                    <a class='dropdown-item' href='{$registerLink}'>
                                        Create Admin
                                    </a>
                                </li>

                                <li>
                                    <hr class='dropdown-divider'>
                                </li>

                                <li>
                                    <a class='dropdown-item' href='{$logOut}'>
                                        Logout
                                    </a>
                                </li>

                            </ul>

                        </li>
                    ";
                } elseif (isAuth('customer')) {

                    $userName = auth('name');
                    $profileLink = route('/profile');
                    $logOut = route('/auth/logout');

                    echo "
                        <li class='nav-item dropdown'>

                            <a
                                class='nav-link dropdown-toggle'
                                href='#'
                                role='button'
                                data-bs-toggle='dropdown'
                                aria-expanded='false'
                            >
                                Hallo, {$userName}
                            </a>

                            <ul class='dropdown-menu'>

                                <li>
                                    <a class='dropdown-item' href='{$profileLink}'>
                                        Profile
                                    </a>
                                </li>

                                <li>
                                    <hr class='dropdown-divider'>
                                </li>

                                <li>
                                    <a class='dropdown-item' href='{$logOut}'>
                                        Logout
                                    </a>
                                </li>

                            </ul>

                        </li>
                    ";
                } else {

                    $loginLink = route('/auth/login');
                    $registerLink = route('/auth/register');

                    echo "
                        <li class='nav-item dropdown'>

                            <a
                                class='nav-link dropdown-toggle'
                                href='#'
                                role='button'
                                data-bs-toggle='dropdown'
                                aria-expanded='false'
                            >
                                Account
                            </a>

                            <ul class='dropdown-menu'>

                                <li>
                                    <a class='dropdown-item' href='{$loginLink}'>
                                        Login
                                    </a>
                                </li>

                                <li>
                                    <hr class='dropdown-divider'>
                                </li>

                                <li>
                                    <a class='dropdown-item' href='{$registerLink}'>
                                        Register
                                    </a>
                                </li>

                            </ul>

                        </li>
                    ";
                }

                ?>

            </ul>

        </div>

    </div>

</nav>