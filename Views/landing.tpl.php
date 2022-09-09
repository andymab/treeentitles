<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex, nofollow" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <style>
        body,
        html {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Verdana, sans-serif;
        }

        .wrapper {
            display: flex;
            width: 100%;
            height: 100%;
            background: url(/assets/skyscrapers.jpeg);
            filter: grayscale(0.3);
            background-size: cover;
        }

        .bg-dark-transparent {
            background-color: rgba(0, 0, 0, 0.33);
        }

        .adaptive-form {
            padding: 0 25px;
            min-width: 300px;
            width: 100%;
        }

        /*.dropdown-menu.nvbr{
                
                width: 100%;
                position: fixed !important;
                
                top: 54px;
                left: 0;
                z-index: 1000;
                float: left;
                min-width: 160px;
                padding: 5px 0;
                margin: 0 auto;
                text-align: left;
                border-radius:0;
            }*/

        /*.dropdown-menu.nvbr li {
                display: inline-block;
            }*/

        .dropdown-menu.nvbr li.dropdown .dropdown-menu {
            top: 210px;
        }

        .dropdown-menu.nvbr li a {
            /*color:rgb(58, 63, 64) !important;*/
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark-transparent">
            <a class="navbar-brand" href="/">3550010.ru</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#"></a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <?php if ($registration = \Access::ishe('User')) : ?>

                    <?php elseif ($registration = \Access::isAdmin()) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Админ</a>
                            <ul class="dropdown-menu nvbr bg-light" role="menu" aria-labelledby="dLabel">
                                <li class="nav-item"><a class="nav-link text-dark" href="/notes">Рабочие записи</a></li>
                                <li class="nav-item"><a class="nav-link text-dark" href="/work">Old Рабочие записи</a></li>
                                <li class="nav-item"><a class="nav-link text-dark" href="/users">Пользователи</a></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Dropdown
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if ($registration) : ?>
                        <a class="nav-link" href="/exit">Выйти</a>
                    <?php else : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Вход</a>
                            <div class="dropdown-menu dropdown-menu-right bg-dark-transparent mt-3" aria-labelledby="dropdown01">
                                <form method="POST" action="#" class="adaptive-form">
                                    <!--<h3 class="text-light">Войти</h3>-->
                                    <div class="form-group">
                                        <label class="text-light">ваш email:</label>
                                        <input type="text" class="form-control" name="userEmail">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-light">ваш пароль:</label>
                                        <input type="password" class="form-control" name="userPassword">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-outline-light btn-block" type="submit">Войти</button>
                                    </div>
                                </form>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>
    <div class="wrapper">
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>