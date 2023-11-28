<?php
session_start();
?>
<!--Html-Код-->
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title id="pageTitle"></title>
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
            background-color: #A60000 !important;
        }

        .profile:hover {
            background-color: #007929 !important;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
          crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/47ae1cb85a.js" crossorigin="anonymous"></script>

</head>
<body>
<!--Навигационная панель-->
<nav class="navbar navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">PlanetOfHistory</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Переключатель навигации">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!--Панель для авторизованных-->
        <?php if (isset($_SESSION['id'])): ?>
            <div class="d-flex ms-auto" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 dropstart">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            <?php echo $_SESSION['login'] ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="profile dropdown-item" href="/profile"><i
                                            class="fa-solid fa-user pe-2"></i>Профиль</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="exit dropdown-item" href="/logout"><i
                                            class="fa-solid fa-door-open pe-2"></i>Выход</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--Панель для неавторизованных-->
        <?php else: ?>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                </li>
            </ul>
            <a class="me-3 btn" href="/reg" role="button">Регистрация</a>
            <a class="btn" href="/login" role="button">Вход</a>
        </div>
    </div>
    <?php endif; ?>
</nav>
<div class="content">
    <?= $content; ?>
</div>
<!--Футер-->
<div class="footer">
    <footer class="container-fluid text-center py-4 bg-dark text-white mt-auto">
        <p>&copy; 2023 Алексей Никитенко</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
            crossorigin="anonymous">
    </script>
</div>
</body>
</html>

