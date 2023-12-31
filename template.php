<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title id="pageTitle"></title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet"/>
    <style>
        .navbar {
            background-color: #472400 !important;
        }

        .btn {
            background-color: #B28C66 !important;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
        }

        footer {
            margin-top: auto;
        }

        .exit:hover {
            background-color: #A60000;
        }

        .profile:hover {
            background-color: #007929;
        }
    </style>
</head>
<body>
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Historium</a>
                <!-- Для авторизованных пользователей -->
                <?php if (isset($_SESSION['id'])): ?>
                    <div class="d-flex ms-auto" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 dropstart">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <?php echo $_SESSION['login'] ?>
                                </a>
                                <ul class="dropdown-menu bg-dark">
                                    <li><a class="profile dropdown-item text-light" href="/profile"><i
                                                    class="fa-solid fa-user pe-2"></i>Профиль</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="exit dropdown-item text-light" href="/logout"><i
                                                    class="fa-solid fa-door-open pe-2"></i>Выход</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- Для неавторизованных пользователей -->
                <?php else: ?>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">-->
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                            </li>
                        </ul>
                        <a class="me-3 btn btn-secondary" href="/reg" role="button">Регистрация</a>
                        <a class="btn btn-secondary" href="/login" role="button">Вход</a>
                    </div>
                <?php endif; ?>
    </div>
</nav>
<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Welcome to Blog Home!</h1>
            <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
        </div>
    </div>
</header>
<!-- Page content-->
<div class="container">
    <!-- Page content-->
    <div class="content">
            <?= $content ?>
    </div>
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <!-- Featured blog post-->
            <div class="card mb-4">
                <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg"
                                  alt="..."/></a>
                <div class="card-body">
                    <div class="small text-muted">January 1, 2023</div>
                    <h2 class="card-title">Featured Post Title</h2>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid
                        atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero
                        voluptate voluptatibus possimus, veniam magni quis!</p>
                    <a class="btn btn-primary" href="#!">Read more →</a>
                </div>
            </div>
            <!-- Nested row for non-featured blog posts-->
            <div class="row">
                <div class="col-lg-6">
                    <!-- Blog post-->
                    <div class="card mb-4">
                        <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg"
                                          alt="..."/></a>
                        <div class="card-body">
                            <div class="small text-muted">January 1, 2023</div>
                            <h2 class="card-title h4">Post Title</h2>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis
                                aliquid atque, nulla.</p>
                            <a class="btn btn-primary" href="#!">Read more →</a>
                        </div>
                    </div>
                    <!-- Blog post-->
                    <div class="card mb-4">
                        <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg"
                                          alt="..."/></a>
                        <div class="card-body">
                            <div class="small text-muted">January 1, 2023</div>
                            <h2 class="card-title h4">Post Title</h2>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis
                                aliquid atque, nulla.</p>
                            <a class="btn btn-primary" href="#!">Read more →</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Blog post-->
                    <div class="card mb-4">
                        <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg"
                                          alt="..."/></a>
                        <div class="card-body">
                            <div class="small text-muted">January 1, 2023</div>
                            <h2 class="card-title h4">Post Title</h2>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis
                                aliquid atque, nulla.</p>
                            <a class="btn btn-primary" href="#!">Read more →</a>
                        </div>
                    </div>
                    <!-- Blog post-->
                    <div class="card mb-4">
                        <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg"
                                          alt="..."/></a>
                        <div class="card-body">
                            <div class="small text-muted">January 1, 2023</div>
                            <h2 class="card-title h4">Post Title</h2>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis
                                aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam.</p>
                            <a class="btn btn-primary" href="#!">Read more →</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pagination-->
            <nav aria-label="Pagination">
                <hr class="my-0"/>
                <ul class="pagination justify-content-center my-4">
                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a>
                    </li>
                    <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                    <li class="page-item"><a class="page-link" href="#!">2</a></li>
                    <li class="page-item"><a class="page-link" href="#!">3</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                    <li class="page-item"><a class="page-link" href="#!">15</a></li>
                    <li class="page-item"><a class="page-link" href="#!">Older</a></li>
                </ul>
            </nav>
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-header">Search</div>
                <div class="card-body">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Enter search term..."
                               aria-label="Enter search term..." aria-describedby="button-search"/>
                        <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                    </div>
                </div>
            </div>
            <!-- Categories widget-->
            <div class="card mb-4">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!">Web Design</a></li>
                                <li><a href="#!">HTML</a></li>
                                <li><a href="#!">Freebies</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!">JavaScript</a></li>
                                <li><a href="#!">CSS</a></li>
                                <li><a href="#!">Tutorials</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Side widget-->
            <div class="card mb-4">
                <div class="card-header">Side Widget</div>
                <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use,
                    and feature the Bootstrap 5 card component!
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
-------------------------
<!--<!DOCTYPE html>-->
<!--<html lang="ru">-->
<!--<head>-->
<!--    <meta charset="utf-8"/>-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>-->
<!--    <meta name="description" content=""/>-->
<!--    <meta name="author" content=""/>-->
<!--    <title id="pageTitle"></title>-->
<!--    <!-- Favicon-->-->
<!--    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico"/>-->
<!--    <!-- Core theme CSS (includes Bootstrap)-->-->
<!--    <link href="/css/styles.css" rel="stylesheet"/>-->
<!--    <script src="https://kit.fontawesome.com/47ae1cb85a.js" crossorigin="anonymous"></script>-->
<!--    <style>-->
<!--        .navbar {-->
<!--            background-color: #472400 !important;-->
<!--        }-->
<!---->
<!--        .btn {-->
<!--            background-color: #B28C66 !important;-->
<!--        }-->
<!---->
<!--        body {-->
<!--            display: flex;-->
<!--            flex-direction: column;-->
<!--            min-height: 100vh;-->
<!--        }-->
<!---->
<!--        .content {-->
<!--            flex: 1;-->
<!--        }-->
<!---->
<!--        footer {-->
<!--            margin-top: auto;-->
<!--        }-->
<!---->
<!--        .exit:hover {-->
<!--            background-color: #A60000;-->
<!--        }-->
<!---->
<!--        .profile:hover {-->
<!--            background-color: #007929;-->
<!--        }-->
<!--    </style>-->
<!--</head>-->
<!--<body>-->
<!--<!-- Responsive navbar-->-->
<!--<nav class="navbar navbar-expand-lg navbar-dark bg-dark">-->
<!--    <div class="container">-->
<!--        <a class="navbar-brand" href="/">PlanetOfHistory</a>-->
<!--        <!-- Для авторизованных пользователей -->-->
<!--        --><?php //if (isset($_SESSION['id'])): ?>
<!--            <div class="d-flex ms-auto" id="navbarSupportedContent">-->
<!--                <ul class="navbar-nav me-auto mb-2 mb-lg-0 dropstart">-->
<!--                    <li class="nav-item dropdown">-->
<!--                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">-->
<!--                            --><?php //echo $_SESSION['login'] ?>
<!--                        </a>-->
<!--                        <ul class="dropdown-menu bg-dark">-->
<!--                            <li><a class="profile dropdown-item text-light" href="/profile"><i-->
<!--                                            class="fa-solid fa-user pe-2"></i>Профиль</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <hr class="dropdown-divider">-->
<!--                            </li>-->
<!--                            <li><a class="exit dropdown-item text-light" href="/logout"><i-->
<!--                                            class="fa-solid fa-door-open pe-2"></i>Выход</a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </div>-->
<!--            <!-- Для неавторизованных пользователей -->-->
<!--        --><?php //else: ?>
<!--            <div class="collapse navbar-collapse" id="navbarSupportedContent">-->-->
<!--                <ul class="navbar-nav me-auto mb-2 mb-lg-0">-->
<!--                    <li class="nav-item">-->
<!--                    </li>-->
<!--                </ul>-->
<!--                <a class="me-3 btn btn-secondary" href="/reg" role="button">Регистрация</a>-->
<!--                <a class="btn btn-secondary" href="/login" role="button">Вход</a>-->
<!--            </div>-->
<!--        --><?php //endif; ?>
<!--    </div>-->
<!--</nav>-->
<!--<!-- Page header with logo and tagline-->-->
<!--<header class="py-5 bg-light border-bottom mb-4">-->
<!--    <div class="container">-->
<!--        <div class="text-center my-5">-->
<!--            <h1 class="fw-bolder">Welcome to Blog Home!</h1>-->
<!--            <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>-->
<!--        </div>-->
<!--    </div>-->
<!--</header>-->
<!--<!-- Page content-->-->
<!--<div class="content">-->
<!--    <div class="container">-->
<!--        --><?php //= $content ?>
<!--    </div>-->
<!--</div>-->
<!--<!-- Footer-->-->
<!--<footer class="py-5 bg-dark">-->
<!--    <div class="container"><p class="m-0 text-center text-white">&copy; Алексей Никитенко 2023</p></div>-->
<!--</footer>-->
<!--<!-- Bootstrap core JS-->-->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>-->
<!--<!-- Core theme JS-->-->
<!--<script src="/js/scripts.js"></script>-->
<!--</body>-->
<!--</html>-->
<!---->
