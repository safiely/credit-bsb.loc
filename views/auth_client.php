<div class="container">

    <div style="height: 50px;"></div>

    <div class="row">
        <div class="col-md-offset-2 col-md-5">
            <h1>Узнать статус заявки</h1>
            <form class="form-horizontal" role="form" method="post" action="">
                <div class="form-group">
                    <label for="input1" class="col-sm-6 control-label">Номер кредитной заявки</label>
                    <div class="col-sm-6">
                        <input type="text" name="credit_request_id" id="input1" class="form-control" placeholder="1234">
                    </div>
                </div>
                <div class="form-group">
                    <label for="input2" class="col-sm-6 control-label">Телефон</label>
                    <div class="col-sm-6">
                        <input type="text" name="phone" id="input2" class="form-control" placeholder="89101234567">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-12">
                        <button type="submit" name="enter" class="btn btn-success">Войти</button>
                        <button type="submit" name="exit" class="btn btn-danger">Выйти</button>
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
