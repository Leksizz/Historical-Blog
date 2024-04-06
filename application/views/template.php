<?php

$stylesDir = 'public/css';
$scriptsDir = 'public/js';

function getFiles($dir, $files = [])
{
    $dir = scandir($dir);
    foreach ($dir as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'css' || (pathinfo($file, PATHINFO_EXTENSION) === 'js')) {
            $files[] = $file;
        }
    }
    return $files;
}

function loadFiles($files, $dir)
{
    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'css') {
            echo '<link rel="stylesheet" href="' . $dir . '/' . $file . '">';
        } else {
            echo '<script type="text/javascript" src="' . $dir . '/' . $file . '"></script>';
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title id="title"><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script type="text/javascript" src="/public/js/jquery.js"></script>
    <?php
    loadFiles(getFiles($stylesDir), $stylesDir);
    ?>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Historium</a>
        <?php if (isset($_SESSION['id'])): ?>
            <div class="d-flex ms-auto" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 dropstart">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <?= $_SESSION['login'] ?>
                        </a>
                        <ul class="dropdown-menu bg-dark">
                            <li><a class="profile dropdown-item text-light" href="../../index.php"><i
                                            class="fa-solid fa-user pe-2"></i>Профиль</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="exit dropdown-item text-light" href="../../index.php"><i
                                            class="fa-solid fa-door-open pe-2"></i>Выход</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        <?php else: ?>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">-->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    </li>
                </ul>
                <a class="me-3 btn btn-secondary" href="/register" role="button">Регистрация</a>
                <a class="btn btn-secondary" href="/login" role="button">Вход</a>
            </div>
        <?php endif; ?>
    </div>
</nav>
<div class="container-fluid content">
    <?php require_once("$content"); ?>
</div>
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">&copy; Алексей Никитенко 2023</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/47ae1cb85a.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>

