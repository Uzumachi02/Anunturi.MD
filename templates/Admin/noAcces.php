<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>AdminPanel - Anunturi.Md</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="/templates/Admin/libs/Bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" href="/templates/Admin/img/favicon/favicon.ico" type="image/x-icon">

    <style>
        body { background-color: #222; color: #ffffff; font-size: 2em; }
        .center { margin: auto; width: 50%; margin-top: 10%; }
    </style>
</head>
<body>

<div id="wrapper">
    <div class="center">
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" id="redirect" class="close"><span aria-hidden="true">&times;</span></button>
            <strong>Atentie!</strong> Nu aveti acces la aceasta pagina.
        </div>
    </div>
</div>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
    $("#redirect").click(function () {
        $(location).attr('href','/');
    });
</script>

</body>
</html>