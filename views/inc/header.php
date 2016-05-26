<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<?=PATH?>favicon.ico" type="image/x-icon">

<title>Заявка на кредит - Белгородсоцбанк</title>

<link rel="stylesheet" type="text/css" href="views/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="views/css/style.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="views/bootstrap/js/bootstrap.js"></script>
<?=$javascript?>

</head>

<body>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=PATH?>">Заявка на кредит в Белгородсоцбанке</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Меню <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header">Для клиентов</li>
                        <li><a href="<?=PATH?>#anchor2">Оформить кредитную заявку</a></li>
                        <li><a href="?view=auth_client">Статус заявки</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Для сотрудников</li>
                        <li><a href="?view=auth">Рабочий стол</a></li>
                    </ul>
                </li>
                <?php if($view == "main"): ?>
                <li>
                    <div class="form-group has-success">
                        <input type="text" class="form-control" id="sum_points" style="margin-top: 7px; width: 500px;" readonly>
                        <span class="glyphicon glyphicon-info-sign form-control-feedback" style="margin-top: 7px;"></span>
                    </div>
                </li>
                <?php endif; ?>
                <li><p class="navbar-text"><?=$_SESSION['auth']['fio']?></p></li>
                <?php if($_SESSION['auth']['access_id'] > 1): ?>
                <li><a href="?view=auth&action=exit">Выйти</a></li>
                <?php endif; ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>