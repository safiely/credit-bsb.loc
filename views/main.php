<div class="container">

    <h2 style="margin-top: 50px;">
        <img src="<?=PATH?>views/images/logo.jpg">
    </h2>

    <div class="row">

        <?php
        if($_SESSION['message']){ // если есть сообщение в сессии
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        ?>

        <div class="col-md-12">
            <h2 class="page-header"><a name="anchor2"></a>Анкета на получение кредита</h2>

            <form class="form-inline" role="form" method="post" action="">
                <div class="col-md-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Желаемый кредит</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group col-md-4">
                                <h2><small>Сумма кредита</small></h2>
                                <div class="input-group">
                                    <input type="text" id="sum_credit" name="sum_credit" class="form-control input-lg" style="width: 260px;" value="50000">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <h2><small>Срок кредита</small></h2>
                                <div class="input-group">
                                    <input type="text" id="srok_credit" name="srok_credit" class="form-control input-lg" style="width: 260px;" value="12">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <h2><small>Процентная ставка</small></h2>
                                <div class="input-group">
                                    <input type="text" id="proc_credit" name="proc_credit" class="form-control input-lg" style="width: 260px;" value="35" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <h2><small>Ежемесячный платеж</small></h2>
                                <div class="input-group">
                                    <input type="text" id="platezh_credit" name="platezh_credit" class="form-control input-lg"  style="width: 260px;" value="4998.15" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <h2><small>Цель кредита</small></h2>
                                <div class="input-group">
                                    <input type="text" name="purpose_credit" class="form-control input-lg" style="width: 620px;" placeholder="Например, покупка смартфона*" required="">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <h2><small>Постоянный <br/>месячный доход</small></h2>
                                <div class="input-group">
                                    <input type="text" id="fixed_income" name="fixed_income" class="form-control input-lg" style="width: 260px;" placeholder="30000*" required="">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <h2><small>Дополнительный <br/>месячный доход</small></h2>
                                <div class="input-group">
                                    <input type="text" id="additional_income" name="additional_income" class="form-control input-lg" style="width: 260px;" placeholder="10000*" required="">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <h2><small>Постоянные <br/>месячные расходы</small></h2>
                                <div class="input-group">
                                    <input type="text" id="fixed_outcome" name="fixed_outcome" class="form-control input-lg" style="width: 260px;" placeholder="15000*">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-offset-5" style="margin-top: 20px;">
                                    <button type="button" id="raschet_skoring" class="btn btn-success btn-lg">Рассчитать</button>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <h2><small>Предварительное заключение скоринг системы</small></h2>
                                <div class="input-group">
                                    <textarea class="form-control" id="conclusion_credit" name="conclusion" rows="3" style="width: 980px;" readonly></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Общая информация - шаг 1 из 6</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group col-md-12">
                                <h2><small>Как вас зовут?</small></h2>
                                <div class="input-group">
                                    <input type="text" name="fio" id="inp1" class="form-control input-lg" style="width: 980px;" placeholder="Фамилия Имя Отчество*" required="">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <h2><small>Мобильный телефон</small></h2>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
                                    <input type="text" name="phone" class="form-control input-lg" style="width: 220px;" placeholder="89101234567*" required>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <h2><small>Ваш контактный email</small></h2>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                    <input type="email" name="email" class="form-control input-lg" style="width: 220px;" placeholder="mail@mail.ru*" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Паспортные данные - шаг 2 из 6</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group col-md-4">
                                <h2><small>Серия</small></h2>
                                <div class="input-group">
                                    <input type="text" name="passport_serial" class="form-control input-lg" style="width: 260px;" placeholder="1234*" required="">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <h2><small>Номер</small></h2>
                                <div class="input-group">
                                    <input type="text" name="passport_number" class="form-control input-lg" style="width: 260px;" placeholder="123456*" required="">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <h2><small>Код подразделения</small></h2>
                                <div class="input-group">
                                    <input type="text" name="code_podrazd" class="form-control input-lg" style="width: 260px;" placeholder="123-456*" required="">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <h2><small>Дата выдачи</small></h2>
                                <div class="input-group">
                                    <input type="date" name="date_vydachi" class="form-control input-lg" style="width: 260px;" required="">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <h2><small>Дата рождения</small></h2>
                                <div class="input-group">
                                    <input type="date" name="date_rozhd" class="form-control input-lg" style="width: 260px;" required="">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <h2><small>Место рождения</small></h2>
                                <div class="input-group">
                                    <input type="text" name="mesto_rozhd" class="form-control input-lg" style="width: 260px;" placeholder="г. Белгород*" required="">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <h2><small>Кем выдан</small></h2>
                                <div class="input-group">
                                    <textarea class="form-control" name="kem_vydan" rows="3" style="width: 260px;" placeholder="ОУФМС России...*" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Адрес по месту постоянной регистрации - шаг 3 из 6</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group col-md-4">
                                <h2><small>Индекс</small></h2>
                                <div class="input-group">
                                    <input type="text" name="index_address_reg" class="form-control input-lg" style="width: 260px;" placeholder="123456*" required>
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <h2><small>Адрес</small></h2>
                                <div class="input-group">
                                    <input type="text" name="address_reg" class="form-control input-lg" style="width: 400px;" placeholder="г.Белгород, ул.Победы, д.1, кв.1*" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Адрес фактического проживания - шаг 4 из 6</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group col-md-4">
                                <h2><small>Индекс</small></h2>
                                <div class="input-group">
                                    <input type="text" name="index_address_fact"  class="form-control input-lg" style="width: 260px;" placeholder="123456*" required>
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <h2><small>Адрес</small></h2>
                                <div class="input-group">
                                    <input type="text" name="address_fact" class="form-control input-lg" style="width: 400px;" placeholder="г.Белгород, ул.Победы, д.1, кв.1*" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Место работы - шаг 5 из 6</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group col-md-4">
                                <h2><small>Тип занятости</small></h2>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                                    <select name="type_employ_id" id="type_employ_id" class="form-control input-lg" style="width: 220px;">
                                        <?php foreach($type_employ as $key_te => $val_te): ?>
                                            <?php if($val_te['type_employ_id'] == 1): ?>
                                                <option value="<?=$val_te['type_employ_id']?>" data-points="<?=$val_te['points']?>" selected><?=$val_te['name']?></option>
                                            <?php else: ?>
                                                <option value="<?=$val_te['type_employ_id']?>" data-points="<?=$val_te['points']?>"><?=$val_te['name']?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <h2><small>Название организации</small></h2>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                                    <input type="text" name="name_org" class="form-control input-lg" style="width: 220px;" placeholder="ООО Рога и Копыта*" required>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <h2><small>Стаж на посл.месте работы</small></h2>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                    <select name="experience_id" id="experience_id" class="form-control input-lg" style="width: 220px;">
                                        <?php foreach($experience as $key_ex => $val_ex): ?>
                                            <?php if($val_ex['experience_id'] == 1): ?>
                                                <option value="<?=$val_ex['experience_id']?>" data-points="<?=$val_ex['points']?>" selected><?=$val_ex['name']?></option>
                                            <?php else: ?>
                                                <option value="<?=$val_ex['experience_id']?>" data-points="<?=$val_ex['points']?>"><?=$val_ex['name']?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <h2><small>Квалификация</small></h2>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></span>
                                    <select name="position_employ_id" id="position_employ_id" class="form-control input-lg" style="width: 220px;">
                                        <?php foreach($position_employ as $key_ps => $val_ps): ?>
                                            <?php if($val_ps['position_employ_id'] == 1): ?>
                                                <option value="<?=$val_ps['position_employ_id']?>" data-points="<?=$val_ps['points']?>" selected><?=$val_ps['name']?></option>
                                            <?php else: ?>
                                                <option value="<?=$val_ps['position_employ_id']?>" data-points="<?=$val_ps['points']?>"><?=$val_ps['name']?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <h2><small>Среднемесячный доход</small></h2>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-credit-card"></span></span>
                                    <select name="monthly_income_id" id="monthly_income_id" class="form-control input-lg" style="width: 220px;">
                                        <?php foreach($monthly_income as $key_mi => $val_mi): ?>
                                            <?php if($val_mi['monthly_income_id'] == 1): ?>
                                                <option value="<?=$val_mi['monthly_income_id']?>" data-points="<?=$val_mi['points']?>" selected><?=$val_mi['name']?></option>
                                            <?php else: ?>
                                                <option value="<?=$val_mi['monthly_income_id']?>" data-points="<?=$val_mi['points']?>"><?=$val_mi['name']?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Дополнительные сведения - шаг 6 из 6</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group col-md-4">
                                <h2><small>Колиество детей</small></h2>
                                <div class="input-group">
                                    <select name="count_child_id" id="count_child_id" class="form-control input-lg" style="width: 260px;">
                                        <?php foreach($count_child as $key_cc => $val_cc): ?>
                                            <?php if($val_cc['count_child_id'] == 1): ?>
                                                <option value="<?=$val_cc['count_child_id']?>" data-points="<?=$val_cc['points']?>" selected><?=$val_cc['name']?></option>
                                            <?php else: ?>
                                                <option value="<?=$val_cc['count_child_id']?>" data-points="<?=$val_cc['points']?>"><?=$val_cc['name']?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <h2><small>Семейное положение</small></h2>
                                <div class="input-group">
                                    <select name="marital_status_id" id="marital_status_id" class="form-control input-lg" style="width: 260px;">
                                        <?php foreach($marital_status as $key_ms => $val_ms): ?>
                                            <?php if($val_ms['marital_status_id'] == 1): ?>
                                                <option value="<?=$val_ms['marital_status_id']?>" data-points="<?=$val_ms['points']?>" selected><?=$val_ms['name']?></option>
                                            <?php else: ?>
                                                <option value="<?=$val_ms['marital_status_id']?>" data-points="<?=$val_ms['points']?>"><?=$val_ms['name']?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <h2><small>Образование</small></h2>
                                <div class="input-group">
                                    <select name="education_id" id="education_id" class="form-control input-lg" style="width: 260px;">
                                        <?php foreach($education as $key_ed => $val_ed): ?>
                                            <?php if($val_ed['education_id'] == 1): ?>
                                                <option value="<?=$val_ed['education_id']?>" data-points="<?=$val_ed['points']?>" selected><?=$val_ed['name']?></option>
                                            <?php else: ?>
                                                <option value="<?=$val_ed['education_id']?>" data-points="<?=$val_ed['points']?>"><?=$val_ed['name']?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <h2><small>Автомобиль</small></h2>
                                <div class="input-group">
                                    <select name="car_id" id="car_id" class="form-control input-lg" style="width: 260px;">
                                        <?php foreach($car as $key_ca => $val_ca): ?>
                                            <?php if($val_ca['car_id'] == 1): ?>
                                                <option value="<?=$val_ca['car_id']?>" data-points="<?=$val_ca['points']?>" selected><?=$val_ca['name']?></option>
                                            <?php else: ?>
                                                <option value="<?=$val_ca['car_id']?>" data-points="<?=$val_ca['points']?>"><?=$val_ca['name']?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <h2><small>Возраст</small></h2>
                                <div class="input-group">
                                    <select name="age_id" id="age_id" class="form-control input-lg" style="width: 260px;">
                                        <?php foreach($age as $key_ag => $val_ag): ?>
                                            <?php if($val_ag['age_id'] == 1): ?>
                                                <option value="<?=$val_ag['age_id']?>" data-points="<?=$val_ag['points']?>"><?=$val_ag['name']?></option>
                                            <?php else: ?>
                                                <option value="<?=$val_ag['age_id']?>" data-points="<?=$val_ag['points']?>" selected><?=$val_ag['name']?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-offset-5" style="margin-top: 20px;">
                        <button type="submit" name="add" class="btn btn-success btn-lg">Отправить заявку</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div style="height: 50px;"></div>

    <div class="row">

    </div>
</div>

<div style="height: 100px;"></div>
