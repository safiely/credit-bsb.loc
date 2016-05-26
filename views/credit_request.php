<div class="container">

    <div style="height: 50px;"></div>

    <h1 class="page-header">Кредитные заявки</h1>

    <div class="row">
        <div class="col-md-12">

            <h3 class="sub-header">Поиск кредитной заявки</h3>

            <div class="col-md-6">
                <form class="form-horizontal" role="form" method="post" action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Номер заявки" name="orders_id">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit" name="search_id">Поиск</button>
                    </span>
                    </div>
                </form>
            </div>

            <div class="col-md-6">
                <form class="form-horizontal" role="form" method="post" action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Номер и серия паспорта" name="name">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit" name="search_name">Поиск</button>
                    </span>
                    </div>
                </form>
            </div>

            <br/>

            <h3 class="sub-header">Список кредитных заявок</h3>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>Дата откр.</th>
                        <th>Статус заявки</th>
                        <th>Сумма</th>
                        <th>Срок</th>
                        <th>%</th>
                        <th>Ежемес.платеж</th>
                        <th>Цель</th>
                        <th>Скоринг</th>
                        <th>ФИО клиента</th>
                        <th>Телефон</th>
                        <th>Email</th>
                        <th>Ответственный сотрудник</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($credit_request as $key => $val): ?>
                        <tr>
                            <td><?=$val['credit_request_id']?></td>
                            <td><?=$val['dateOpen']?></td>
                            <td>
                                <div class="btn-group" style="margin-top: 5px">
                                    <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown"><?=$val['status_request_name']?> <span class="caret"></span></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <?php foreach($status_request as $key_s => $val_s): ?>
                                            <li><a href="?view=credit_request&action=new_status&credit_request_id=<?=$val['credit_request_id']?>&status_request_id=<?=$val_s['status_request_id']?>"><?=$val_s['name']?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div class="btn-group" style="margin-top: 5px">
                                    <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown">Действие<span class="caret"></span></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="?view=credit_request_detail&id=<?=$val['credit_request_id']?>">Просмотр/Изменить</a></li>
                                        <li><a href="?view=credit_request&action=del&id=<?=$val['credit_request_id']?>">Удалить</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td><?=$val['sum_credit']?> руб.</td>
                            <td><?=$val['srok_credit']?> мес.</td>
                            <td><?=$val['proc_credit']?></td>
                            <td><?=$val['platezh_credit']?> руб.</td>
                            <td><?=$val['purpose_credit']?></td>
                            <td><?=$val['sum_points']?> <?=$val['sum_points']*100/1000?>%</td>
                            <td><?=$val['fio']?></td>
                            <td><?=$val['phone']?></td>
                            <td><?=$val['email']?></td>
                            <td><?=$val['employees_fio']?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>