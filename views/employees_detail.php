<div class="container">

    <div style="height: 50px;"></div>

    <h1 class="page-header">Информация о сотруднике</h1>

    <div class="row">
        <div class="col-md-12">

            <?php if($employees): ?>
                <form class="form-horizontal" role="form" method="post" action="">

                    <input type="hidden" name="employees_id" value="<?=$employees[0]['employees_id']?>">

                    <div class="form-group">
                        <label for="inputText1" class="col-sm-2 control-label">ФИО</label>
                        <div class="col-sm-10">
                            <input type="text" name="fio" class="form-control" id="inputText1" value="<?=$employees[0]['fio']?>" required="">
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
                            <input type="tel" name="tel" class="form-control" id="inputTel1" value="<?=$employees[0]['tel']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="inputEmail1" value="<?=$employees[0]['email']?>" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword1" class="col-sm-2 control-label">Пароль</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="password_old" value="<?=$employees[0]['password']?>">
                            <input type="password" name="password" class="form-control" id="inputPassword1" value="<?=$employees[0]['password']?>" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" name="upd" class="btn btn-success">Сохранить</button>
                            <button type="submit" name="del" class="btn btn-danger">Удалить</button>
                            <a href="?view=employees" class="btn btn-default active" role="button">Назад</a>
                            <?php
                            if($_SESSION['message']){ // если есть сообщение в сессии
                                echo '<br/><br/>'.$_SESSION['message'];
                                unset($_SESSION['message']);
                            }
                            ?>
                        </div>
                    </div>
                </form>
            <?php else: ?>
                <h3>Такого сотрудника в системе нету.</h3>
            <?php endif; ?>
        </div>
    </div>
</div>

<div style="height: 100px;"></div>

