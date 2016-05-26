<div class="container">

    <div style="height: 50px;"></div>


    <h1 class="page-header">Сотрудники</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Пользователи
                        </h4>
                    </div>
                    <div class="panel-body">
                        <?php foreach($employees as $key => $val): ?>
                            <?php if($val['access_id'] == 2 ): ?>
                                <div class="col-md-12">
                                    <a href="?view=employees_detail&id=<?=$val['employees_id']?>">
                                        <div class="col-md-12">
                                            <h5><?=$val['fio']?></h5>
                                            <?=$val['email']?><br/>
                                            <?=$val['tel']?>
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Администраторы
                        </h4>
                    </div>
                    <div class="panel-body">
                        <?php foreach($employees as $key => $val): ?>
                            <?php if($val['access_id'] == 3): ?>
                                <div class="col-md-12">
                                    <a href="?view=employees_detail&id=<?=$val['employees_id']?>">
                                        <div class="col-md-12">
                                            <h5><?=$val['fio']?></h5>
                                            <?=$val['email']?><br/>
                                            <?=$val['tel']?>
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">

            <h3>Добавление сотрудника</h3>

            <form class="form-horizontal" role="form" method="post" action="">
                <div class="form-group">
                    <label for="inputText1" class="col-sm-2 control-label">ФИО</label>
                    <div class="col-sm-10">
                        <input type="text" name="fio" class="form-control" id="inputText1" placeholder="Иванов Иван Иванович" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSelect1" class="col-sm-2 control-label">Доступ</label>
                    <div class="col-sm-10">
                        <select name="access_id" class="form-control" id="inputSelect1">
                            <option value="2">Пользователь</option>
                            <option value="3">Администратор</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputTel1" class="col-sm-2 control-label">Телефон</label>
                    <div class="col-sm-10">
                        <input type="tel" name="tel" class="form-control" id="inputTel1" placeholder="8 950 123 4567">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail1" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="inputEmail1" placeholder="mail@mail.ru" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword1" class="col-sm-2 control-label">Пароль</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="inputPassword1" placeholder="Введите временный пароль" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Добавить</button>
                        <?php
                        if($_SESSION['message']){ // если есть сообщение в сессии
                            echo '<br/><br/>'.$_SESSION['message'];
                            unset($_SESSION['message']);
                        }
                        ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div style="height: 100px;"></div>

