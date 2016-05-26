<div style="height: 100px;"></div>

<div class="container">

    <div class="panel panel-success">
        <div class="panel-heading">
            <h2 class="panel-title">Информация по кредитной заявке</h2>
        </div>
        <div class="panel-body">
            <?php if($_SESSION['client']): ?>

                <form class="form-horizontal" role="form" method="post" action="">
                    <?php if($_SESSION['client']['status_request_id'] > 4): ?>
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h2 class="panel-title">Заключение по кредитной заявке</h2>
                            </div>
                            <div class="panel-body">
                                <textarea name="conclusion" class="form-control" rows="3" placeholder="Текст заключения: выдается кредит или отказ в выдаче кредита" readonly><?=$_SESSION['client']['conclusion']?></textarea>
                                <div class="form-group" style="margin: 10px 0;">
                                    <button type="submit" class="btn btn-success">Сохранить</button>
                                    <a href="?view=credit_request_print&id=<?=$_SESSION['client']['credit_request_id']?>" class="btn btn-default" target="_blank">Скачать приглашение</a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php
                    if($_SESSION['message']){ // если есть сообщение в сессии
                        echo '<br/><br/>'.$_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                    ?>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Номер заявки</label>
                        <div class="col-sm-10">
                            <input type="text" name="credit_request_id" class="form-control" value="<?=$_SESSION['client']['credit_request_id']?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Дата открытия</label>
                        <div class="col-sm-10">
                            <input type="date" name="date_open" class="form-control" value="<?=$_SESSION['client']['date_open']?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Статус заявки</label>
                        <div class="col-sm-10">
                            <?php foreach($status_request as $key_sr => $val_sr): ?>
                                <?php if($val_sr['status_request_id'] == $_SESSION['client']['status_request_id']): ?>
                                    <input type="text" class="form-control" value="<?=$val_sr['name']?>" readonly>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Ответственный сотрудник</label>
                        <div class="col-sm-10">
                            <?php foreach($employees as $key_e => $val_e): ?>
                                <?php if($val_e['employees_id'] == $_SESSION['client']['employees_id']): ?>
                                    <input type="text" class="form-control" value="<?=$val_e['fio']?>" readonly>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Фамилия</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?=$_SESSION['client']['fio']?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Телефон</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?=$_SESSION['client']['phone']?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?=$_SESSION['client']['email']?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Сумма кредита</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?=$_SESSION['client']['sum_credit']?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Срок кредита</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?=$_SESSION['client']['srok_credit']?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Цель кредита</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?=$_SESSION['client']['purpose_credit']?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Процентная ставка</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?=$_SESSION['client']['proc_credit']?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Ежемесячный платеж</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?=$_SESSION['client']['platezh_credit']?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" name="exit" class="btn btn-danger">Выйти</button>
                        </div>
                    </div>
                </form>

        </div>
    </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">История кредитной заявки</h2>
            </div>
            <div class="panel-body">

                <form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
                    <div class="panel panel-success">
                        <div class="panel-body">
                            <input type="hidden" name="credit_request_id" value="<?=$_SESSION['client']['credit_request_id']?>">
                            <input type="hidden" name="employees_id" value="0">
                            <textarea name="message" class="form-control" id="inputTextarea1" placeholder="Ваш текст..." rows="3"></textarea><br/>
                            <input type="file" name="filename">
                            <p class="help-block">При необходимости, прикрепите файл pdf или doc.</p>
                            <button type="submit" name="add" class="btn btn-success">Добавить</button>
                        </div>
                    </div>

                    <?php foreach($history_request as $key => $val): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                #<?=$val['history_request_id']?>, <?=$val['Date_Time']?>
                                <?php if($val['employees_id']== 0): ?>
                                    , <?=$_SESSION['client']['fio']?>
                                <?php else: ?>
                                    , <?=$val['employees_fio']?>
                                <?php endif; ?>
                            </div>
                            <div class="panel-body">
                                <?=$val['message']?><br/>
                                <?php if($val['fileName']): ?>
                                    <a href="<?=PATH?><?=$val['fileName']?>" target="_blank">Файл: <?=$val['fileName']?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </form>

            </div>
        </div>
    <?php else: ?>
        <h3>Данной кредитной заявки нету.</h3>
    <?php endif; ?>

</div>

<div style="height: 100px;"></div>

