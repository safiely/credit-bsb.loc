<div class="container">

    <h2 style="margin-top: 50px;">
        <img src="<?=PATH?>views/images/logo.jpg">
    </h2>
    <h2>Приглашение в кредитный отдел БСБ</h2>

    <div class="panel panel-success">
        <div class="panel-body" style="font-size: 24px;">
            Номер кредитной заявки: <?=$credit_request[0]['credit_request_id']?><br/><br/>

            Сумма кредита: <?=$credit_request[0]['sum_credit']?> руб.<br/>
            Срок кредита: <?=$credit_request[0]['srok_credit']?> мес.<br/>
            Процент по кредиту: <?=$credit_request[0]['proc_credit']?>%<br/>
            Ежемесячный платеж: <?=$credit_request[0]['platezh_credit']?> руб.<br/>
            Цель кредита: <?=$credit_request[0]['purpose_credit']?><br/><br/>

            Клиент: <?=$credit_request[0]['fio']?><br/>
            Телефон: <?=$credit_request[0]['phone']?><br/>
            Email: <?=$credit_request[0]['email']?><br/><br/>

            Заключение: <?=$credit_request[0]['conclusion']?><br/>
            Вероятность выдачи кредита <?=$credit_request[0]['sum_points']*100/1000?>%.
            <?php if($credit_request[0]['sum_points'] > 650): ?>
                Больше необходимого уровня.
            <?php else: ?>
                Меньше необходимого уровня.
            <?php endif; ?>
        </div>
    </div>

    Ответственный сотрудник <?=$credit_request[0]['employees_fio']?>

</div>