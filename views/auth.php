<div class="container">

    <div style="height: 50px;"></div>

    <div class="row">
        <div class="col-md-offset-3 col-md-4">
            <h1>Вход в систему</h1>
            <form class="form-horizontal" role="form" method="post" action="">
                <div class="form-group">
                    <label for="input1" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" id="input1" class="form-control" placeholder="Введите email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input2" class="col-sm-2 control-label">Пароль</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" id="input2" class="form-control" placeholder="Введите пароль" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="enter" class="btn btn-default btn-success">Войти</button>
<!--                        <button type="submit" name="exit" class="btn btn-default btn-danger">Выйти</button>-->
                        <?php
                        if($_SESSION['message']){ // если есть сообщение в сессии
                            echo "<br/><br/>".$_SESSION['message'];
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
