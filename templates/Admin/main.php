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

    <link rel="stylesheet" href="/templates/Admin/libs/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/templates/Admin/libs/Font_Awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/templates/Admin/style/admin.css">

    <link rel="shortcut icon" href="/templates/Admin/img/favicon/favicon.ico" type="image/x-icon">

    <script type="text/javascript" src="/templates/Admin/js/jquery.js"></script>
    <script type="text/javascript" src="/templates/Admin/libs/Bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/templates/Admin/js/common.js"></script>

</head>

<body>
</body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/adminpanel"><i class="fa fa-home"></i> AdminPanel</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">

            <li class="dropdown">
                <a href="/" target="_blank">
                    <i class="fa fa-eye"></i> La Sait
                </a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $_SESSION['USER_LOGIN'] ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="/profile/view/<?= $_SESSION['USER_LOGIN'] ?>"><i class="fa fa-fw fa-user"></i> Profilu</a>
                    </li>
                    <li>
                        <a href="/profile/edit/<?= $_SESSION['USER_LOGIN'] ?>"><i class="fa fa-fw fa-gear"></i> Setari</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="/" id="logout"><i class="fa fa-fw fa-power-off"></i> Iesire</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li id="stats">
                    <a href="/adminpanel"><i class="fa fa-pie-chart"></i> Statistica</a>
                </li>
                <li id="anunt">
                    <a href="/adminpanel/anunts"><i class="fa fa-newspaper-o"></i> Anunturile</a>
                </li>
                <li id="user">
                    <a href="/adminpanel/users"><i class="fa fa-users"></i> Utilizatorii</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">
            <?php include TPLADM . $content; ?>
        </div>
    </div>

</div>

<div class="notice" id="notice" style="display: none;"></div>

<script>
    var h = window.innerHeight;
    var id = document.getElementById('page-wrapper');
    id.style.minHeight = (h - 50) + 'px';
</script>

</html>