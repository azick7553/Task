<?php
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <link href="/Content/bootstrap.css" rel="stylesheet" type="text/css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="/">Task</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/">Задачи
                        <!--<span class="sr-only">(current)</span>--></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/TaskManager">Новая задача
                        <!--<span class="sr-only">(current)</span>--></a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-link" style="color:white">
                    <?php if (isset($_SESSION['User'])) {
                        echo $_SESSION['User']->UserName;
                    }
                    ?>
                </li>

                <li class="nav-item">
                    <?php if (isset($_SESSION['User'])) {
                        echo "<a class=\"nav-link\" href=\"/Account/LogOut\">Выход</a>";
                    } else {
                        echo "<a class=\"nav-link\" href=\"/Account/\">Вход</a>";
                    }
                    ?>
                </li>
                <li class="nav-item">
                </li>
            </ul>
        </div>
    </nav>
    <div class="container" style="margin-top:40px">
        <?= $body ?>
    </div>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</body>

</html>
