<div style="height: 100px;"></div>

<div class="container">

    <div class="panel panel-success">
        <div class="panel-heading">
            <h2 class="panel-title">Информация по кредитной заявке</h2>
        </div>
        <div class="panel-body">
            <?php if($credit_request): ?>
                <form class="form-horizontal" role="form" method="post" action="">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h2 class="panel-title">Заключение по кредитной заявке</h2>
                    </div>
                    <div class="panel-body">
                        <textarea name="conclusion" class="form-control" rows="3" placeholder="Текст заключения: выдается кредит или отказ в выдаче кредита"><?=$credit_request[0]['conclusion']?></textarea>
                        <div class="form-group" style="margin: 10px 0;">
                            <button type="submit" class="btn btn-success">Сохранить</button>
                            <a href="?view=credit_request_print&id=<?=$credit_request[0]['credit_request_id']?>" class="btn btn-default" target="_blank">Скачать приглашение</a>
                        </div>
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h2 class="panel-title">Заключение скоринг-системы</h2>
                    </div>
                    <div class="panel-body">
                        <?=skoring_money($credit_request[0]['credit_request_id'])?><br/>
                        Вероятность выдачи кредита <?=$credit_request[0]['sum_points']*100/1000?>%.
                        <?php if($credit_request[0]['sum_points'] > 650): ?>
                            Больше необходимого уровня.
                        <?php else: ?>
                            Меньше необходимого уровня.
                        <?php endif; ?>
                    </div>
                </div>

                <?php
                if($_SESSION['message']){ // если есть сообщение в сессии
                    echo '<br/><br/>'.$_SESSION['message'];
                    unset($_SESSION['message']);
                }
                ?>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Номер заявки</label>
                    <div class="col-sm-10">
                        <input type="text" name="credit_request_id" class="form-control" value="<?=$credit_request[0]['credit_request_id']?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Дата открытия</label>
                    <div class="col-sm-10">
                        <input type="date" name="date_open" class="form-control" value="<?=$credit_request[0]['date_open']?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Статус заявки</label>
                    <div class="col-sm-10">
                        <select name="status_request_id" class="form-control">
                            <?php foreach($status_request as $key_sr => $val_sr): ?>
                                <?php if($val_sr['status_request_id'] == $credit_request[0]['status_request_id']): ?>
                                    <option value="<?=$val_sr['status_request_id']?>" selected><?=$val_sr['name']?></option>
                                <?php else: ?>
                                    <option value="<?=$val_sr['status_request_id']?>"><?=$val_sr['name']?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Ответственный сотрудник</label>
                    <div class="col-sm-10">
                        <select name="employees_id" class="form-control">
                            <?php foreach($employees as $key_e => $val_e): ?>
                                <?php if($val_e['employees_id'] == $credit_request[0]['employees_id']): ?>
                                    <option value="<?=$val_e['employees_id']?>" selected><?=$val_e['fio']?></option>
                                <?php else: ?>
                                    <option value="<?=$val_e['employees_id']?>"><?=$val_e['fio']?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Сумма кредита</label>
                    <div class="col-sm-10">
                        <input type="text" name="sum_credit" class="form-control" value="<?=$credit_request[0]['sum_credit']?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Срок кредита</label>
                    <div class="col-sm-10">
                        <input type="text" name="srok_credit" class="form-control" value="<?=$credit_request[0]['srok_credit']?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Цель кредита</label>
                    <div class="col-sm-10">
                        <input type="text" name="purpose_credit" class="form-control" value="<?=$credit_request[0]['purpose_credit']?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Процентная ставка</label>
                    <div class="col-sm-10">
                        <input type="text" name="proc_credit" class="form-control" value="<?=$credit_request[0]['proc_credit']?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Ежемесячный платеж</label>
                    <div class="col-sm-10">
                        <input type="text" name="platezh_credit" class="form-control" value="<?=$credit_request[0]['platezh_credit']?>" required="">
                    </div>
                </div>
                <h3 class="page-header">Общая информация</h3>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">ФИО</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="clients_id" class="form-control" value="<?=$credit_request[0]['clients_id']?>">
                        <input type="text" name="fio" class="form-control" value="<?=$credit_request[0]['fio']?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Телефон</label>
                    <div class="col-sm-10">
                        <input type="text" name="phone" class="form-control" value="<?=$credit_request[0]['phone']?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control" value="<?=$credit_request[0]['email']?>" required="">
                    </div>
                </div>
                <h3 class="page-header">Паспортные данные</h3>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Серия паспорта</label>
                    <div class="col-sm-10">
                        <input type="text" name="passport_serial" class="form-control" value="<?=$credit_request[0]['passport_serial']?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Номер паспорта</label>
                    <div class="col-sm-10">
                        <input type="text" name="passport_number" class="form-control" value="<?=$credit_request[0]['passport_number']?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Код подразделения</label>
                    <div class="col-sm-10">
                        <input type="text" name="code_podrazd" class="form-control" value="<?=$credit_request[0]['code_podrazd']?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Дата выдачи</label>
                    <div class="col-sm-10">
                        <input type="date" name="date_vydachi" class="form-control" value="<?=$credit_request[0]['date_vydachi']?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Дата рождения</label>
                    <div class="col-sm-10">
                        <input type="date" name="date_rozhd" class="form-control" value="<?=$credit_request[0]['date_rozhd']?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Место рождения</label>
                    <div class="col-sm-10">
                        <input type="text" name="mesto_rozhd" class="form-control" value="<?=$credit_request[0]['mesto_rozhd']?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Кем выдан</label>
                    <div class="col-sm-10">
                        <input type="text" name="kem_vydan" class="form-control" value="<?=$credit_request[0]['kem_vydan']?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Индекс адреса регистрации</label>
                    <div class="col-sm-10">
                        <input type="text" name="index_address_reg" class="form-control" value="<?=$credit_request[0]['index_address_reg']?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Адрес регистрации</label>
                    <div class="col-sm-10">
                        <input type="text" name="address_reg" class="form-control" value="<?=$credit_request[0]['address_reg']?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Индекс адреса проживания</label>
                    <div class="col-sm-10">
                        <input type="text" name="index_address_fact" class="form-control" value="<?=$credit_request[0]['index_address_fact']?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Адрес проживания</label>
                    <div class="col-sm-10">
                        <input type="text" name="address_fact" class="form-control" value="<?=$credit_request[0]['address_fact']?>" required="">
                    </div>
                </div>
                <h3 class="page-header">Место работы</h3>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Тип занятости</label>
                    <div class="col-sm-10">
                        <select name="type_employ_id" class="form-control">
                            <?php foreach($type_employ as $key_te => $val_te): ?>
                                <?php if($val_te['type_employ_id'] == $credit_request[0]['type_employ_id']): ?>
                                    <option value="<?=$val_te['type_employ_id']?>" selected><?=$val_te['name']?></option>
                                <?php else: ?>
                                    <option value="<?=$val_te['type_employ_id']?>"><?=$val_te['name']?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Название организации</label>
                    <div class="col-sm-10">
                        <input type="text" name="name_org" class="form-control" value="<?=$credit_request[0]['name_org']?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Стаж на последнем месте работы</label>
                    <div class="col-sm-10">
                        <select name="experience_id" class="form-control">
                            <?php foreach($experience as $key_ex => $val_ex): ?>
                                <?php if($val_ex['experience_id'] == $credit_request[0]['experience_id']): ?>
                                    <option value="<?=$val_ex['experience_id']?>" selected><?=$val_ex['name']?></option>
                                <?php else: ?>
                                    <option value="<?=$val_ex['experience_id']?>"><?=$val_ex['name']?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Квалификация</label>
                    <div class="col-sm-10">
                        <select name="position_employ_id" class="form-control">
                            <?php foreach($position_employ as $key_pe => $val_pe): ?>
                                <?php if($val_pe['position_employ_id'] == $credit_request[0]['position_employ_id']): ?>
                                    <option value="<?=$val_pe['position_employ_id']?>" selected><?=$val_pe['name']?></option>
                                <?php else: ?>
                                    <option value="<?=$val_pe['position_employ_id']?>"><?=$val_pe['name']?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Среднемесячный доход</label>
                    <div class="col-sm-10">
                        <select name="monthly_income_id" class="form-control">
                            <?php foreach($monthly_income as $key_mi => $val_mi): ?>
                                <?php if($val_mi['monthly_income_id'] == $credit_request[0]['monthly_income_id']): ?>
                                    <option value="<?=$val_mi['monthly_income_id']?>" selected><?=$val_mi['name']?></option>
                                <?php else: ?>
                                    <option value="<?=$val_mi['monthly_income_id']?>"><?=$val_mi['name']?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <h3 class="page-header">Дополнительные сведения</h3>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Количество детей</label>
                    <div class="col-sm-10">
                        <select name="count_child_id" class="form-control">
                            <?php foreach($count_child as $key_cc => $val_cc): ?>
                                <?php if($val_cc['count_child_id'] == $credit_request[0]['count_child_id']): ?>
                                    <option value="<?=$val_cc['count_child_id']?>" selected><?=$val_cc['name']?></option>
                                <?php else: ?>
                                    <option value="<?=$val_cc['count_child_id']?>"><?=$val_cc['name']?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Семейное положение</label>
                    <div class="col-sm-10">
                        <select name="marital_status_id" class="form-control">
                            <?php foreach($marital_status as $key_ms => $val_ms): ?>
                                <?php if($val_ms['marital_status_id'] == $credit_request[0]['marital_status_id']): ?>
                                    <option value="<?=$val_ms['marital_status_id']?>" selected><?=$val_ms['name']?></option>
                                <?php else: ?>
                                    <option value="<?=$val_ms['marital_status_id']?>"><?=$val_ms['name']?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Образование</label>
                    <div class="col-sm-10">
                        <select name="education_id" class="form-control">
                            <?php foreach($education as $key_edu => $val_edu): ?>
                                <?php if($val_edu['education_id'] == $credit_request[0]['education_id']): ?>
                                    <option value="<?=$val_edu['education_id']?>" selected><?=$val_edu['name']?></option>
                                <?php else: ?>
                                    <option value="<?=$val_edu['education_id']?>"><?=$val_edu['name']?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Автомобиль</label>
                    <div class="col-sm-10">
                        <select name="car_id" class="form-control">
                            <?php foreach($car as $key_car => $val_car): ?>
                                <?php if($val_car['car_id'] == $credit_request[0]['car_id']): ?>
                                    <option value="<?=$val_car['car_id']?>" selected><?=$val_car['name']?></option>
                                <?php else: ?>
                                    <option value="<?=$val_car['car_id']?>"><?=$val_car['name']?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Возраст</label>
                    <div class="col-sm-10">
                        <select name="age_id" class="form-control">
                            <?php foreach($age as $key_ag => $val_ag): ?>
                                <?php if($val_ag['age_id'] == $credit_request[0]['age_id']): ?>
                                    <option value="<?=$val_ag['age_id']?>" selected><?=$val_ag['name']?></option>
                                <?php else: ?>
                                    <option value="<?=$val_ag['age_id']?>"><?=$val_ag['name']?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Постоянный доход</label>
                        <div class="col-sm-10">
                            <input type="text" name="fixed_income" class="form-control" value="<?=$credit_request[0]['fixed_income']?>" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Дополнительный доход</label>
                        <div class="col-sm-10">
                            <input type="text" name="additional_income" class="form-control" value="<?=$credit_request[0]['additional_income']?>" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Постоянный расход</label>
                        <div class="col-sm-10">
                            <input type="text" name="fixed_outcome" class="form-control" value="<?=$credit_request[0]['fixed_outcome']?>" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Сохранить</button>
                            <button type="submit" name="del" class="btn btn-danger">Удалить</button>
                            <a href="?view=credit_request" class="btn btn-default active" role="button">Назад</a>
                        </div>
                    </div>
                </form>
            <?php else: ?>
                <h3>Данной кредитной заявки нету.</h3>
            <?php endif; ?>
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
                            <input type="hidden" name="credit_request_id" value="<?=$credit_request[0]['credit_request_id']?>">
                            <input type="hidden" name="employees_id" value="<?=$credit_request[0]['employees_id']?>">
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
                                    , <?=$credit_request[0]['fio']?>
                                <?php else: ?>
                                    <?=$val['employees_fio']?>
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

</div>

<div style="height: 100px;"></div>

