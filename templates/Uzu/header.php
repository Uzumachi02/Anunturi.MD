<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="ru"> <!--<![endif]-->

<head>

    <meta charset="utf-8">

    <title><?=$title?></title>
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="<?=THEME?>libs/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=THEME?>libs/FotoRama/fotorama.css">
    <link rel="stylesheet" href="<?=THEME?>libs/Font_Awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=THEME?>style/header.css">
    <link rel="stylesheet" href="<?=THEME?>style/main.css">
    <link rel="stylesheet" href="<?=THEME?>style/fonts.css">
    <link rel="stylesheet" href="<?=THEME?>style/media.css">

    <link rel="shortcut icon" href="<?=THEME?>img/favicon/favicon.ico" type="image/x-icon">

    <script type="text/javascript" src="<?=THEME?>js/jquery.js"></script>
    <script type="text/javascript" src="<?=THEME?>libs/Bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=THEME?>libs/FotoRama/fotorama.js"></script>
    <script type="text/javascript" src="<?=THEME?>js/common.js"></script>

</head>

<body>
<header class="header">

    <div class="logo">
        <h1>Anunturi.MD</h1>
    </div>
    <nav class="nav">
        <ul>
            <li><a href="/" id="home_page">Principala</a></li>
            <li><a href="/anunt/add" id="add_page">Adaugarea anuntului</a></li>

            <?php if (User::getUserGroup() >= 1): ?>

                <li class="sub-nav">
                    <a href="/profile/view/<?=$_SESSION['USER_LOGIN']?>" id="profile_page">
                        Salut, <?=$_SESSION['USER_LOGIN']?> <i class="fa fa-angle-down"></i>
                    </a>
                    <ul>

                        <?php if (User::getUserGroup() >= 2): ?>
                            <li>
                                <a href="/adminpanel">
                                    <i class="fa fa-cogs"></i> AdminPanel
                                </a>
                            </li>
                        <?php endif; ?>

                        <li>
                            <a href="/profile/view/<?=$_SESSION['USER_LOGIN']?>">
                                <i class="fa fa-user"></i> Profilu
                            </a>
                        </li>
                        <li>
                            <a href="/" id="logout"><i class="fa fa-unlock">

                                </i> Iesire
                            </a>
                        </li>
                    </ul>

                </li>
            <?php else: ?>
                <li><a id="login" href="#"> Logare</a></li>
                <li><a id="register" href="#">Inregistrare</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
