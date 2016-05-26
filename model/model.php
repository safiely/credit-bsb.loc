<?php

/* ===== Универсальный SELECT ===== */
function select_table($table){
    $query = "SELECT * FROM $table";
    $res = mysql_query($query);
    $arr = array();
    while ($row = mysql_fetch_assoc($res)){
        $arr[] = $row;
    }

    return $arr;
}
/* ===== Универсальный SELECT ===== */

/* ===== Универсальный DELETE ===== */
function delete_table($table, $field, $id){
    $query = "DELETE FROM $table WHERE $field = $id";
    mysql_query($query);
    if(mysql_affected_rows()>0){
        $_SESSION['message'] = "<div class='alert alert-info'>Запись успешно удалена.</div>";
    }else{
        $_SESSION['message'] = "<div class='alert alert-danger'>Ошибка при удалении записи.</div>";
    }
}
/* ===== Универсальный DELETE ===== */

/* ===== Универсальный INSERT ===== */
function insert_table($table, $array) {
    if($table == 'credit_request'){
        $text = "Номер вашей заявки на получение кредита: ";
    } else {
        $text = "";
    }
    $query = "INSERT INTO ".$table;
    $field_arr = array();
    $val_arr = array();
    foreach($array as $field=>$val) {
        $field_arr[] = "`$field`";

        // если вставка в таблицу Сотрудники
        if($table == 'employees' and $field == "password"){
            $val = md5($val);
        }
        $val_arr[] = "'".clear($val)."'"; // экранируем спец символы + убираем php и html теги
    }
    $query .= " (".implode(", ", $field_arr).") VALUES (".implode(", ", $val_arr).")";
    //echo $query;
    mysql_query($query);
    if(mysql_affected_rows()>0){
        $_SESSION['message'] = "<div class='col-md-12' style='margin: 50px 0;'><div class='alert alert-info'>Запись успешно добавлена.<h2>".$text.mysql_insert_id()."</h2></div></div>";
    }else{
        $_SESSION['message'] = "<div class='col-md-12' style='margin: 50px 0;'><div class='alert alert-danger'>Ошибка при добавлении записи.</div></div>";
    }
}
/* ===== Универсальный INSERT ===== */

/* ===== Универсальный UPDATE ===== */
function update_table($table, $array, $field_id, $id) {
    $set = '';
    $x = 1;

    foreach($array as $field=>$val) {
        $set .= "{$field} = \"{$val}\"";
        if($x < count($array)) {
            $set .= ', ';
        }
        $x++;
    }

    $query = "UPDATE {$table} SET {$set} WHERE {$field_id} = {$id}";
    //echo $query;
    mysql_query($query);
    if(mysql_affected_rows()>0){
        $_SESSION['message'] = "<div class='alert alert-info'>Запись успешно изменена.</div>";
    }else{
        $_SESSION['message'] = "<div class='alert alert-danger'>Ошибка при изменении записи, либо вы ничего не изменили.</div>";
    }
}
/* ===== Универсальный UPDATE ===== */

//--------------------------------------------------------------------

/* ===== Отправить письмо при добавление истории сотрудником ===== */
function send_mail($message, $credit_request_id){

    $credit_request = select_credit_request($credit_request_id);

    $email_org = "credit-bsb@mail.ru";

    // тема письма
    $subject = "Новое сообщение по вашей кредитной заявке в БСБ";

    // заголовки
    $headers = "Content-type:text/html;charset=utf-8\r\n";
    $headers .= "From: ".SHORT_URL." - доставка цветов <$email_org>\r\n";

    // тело письма
    $mail_body = "
        <h2>Здравствуйте, {$credit_request[0]['familiya']} {$credit_request[0]['imya']}!</h2>
            <span style='font-size: 16px; font-family:tahoma,geneva,sans-serif'>
                По вашей заявке №$credit_request_id появилось сообщение:<br/>
                $message<br/><br/>
                Просим Вас зайти в <a href='".PATH."?view=auth_client&id=$credit_request_id&phone={$credit_request[0]['phone']}'>личный кабинет</a> для ответа.
                С уважением, {$credit_request[0]['employees_fio']}
            </span>
    "; // текст сообщения

    @mail($credit_request[0]['email'], $subject, $mail_body, $headers);
}
/* ===== Отправить письмо при добавление истории сотрудником ===== */

/* ===== Авторизация в системе ===== */
function authorization(){
    $email = clear($_POST['email']);
    $password = md5($_POST['password']);
    $query = "SELECT employees_id, `fio`, `email`, `tel`, `password`, access_id
                FROM employees
                WHERE email = '$email'
                AND password = '$password'
                LIMIT 1";
    $res = mysql_query($query) or die(mysql_error());
    if(mysql_num_rows($res) == 1){
        // если авторизация успешна
        $row = mysql_fetch_row($res);
        $_SESSION['auth']['employees_id'] = $row[0];
        $_SESSION['auth']['fio'] = $row[1];
        $_SESSION['auth']['email'] = $row[2];
        $_SESSION['auth']['tel'] = $row[3];
        $_SESSION['auth']['password'] = $row[4];
        $_SESSION['auth']['access_id'] = $row[5];
    } else {
        // если неверен логин/пароль
        $_SESSION['auth']['employees_id'] = 0;
        $_SESSION['message'] = "<div class='alert alert-danger' style='margin-top: 10px;'>Такого пользователя нет либо ввели неправильные данные.</div>";
    }
}
/* ===== Авторизация в системе ===== */

/* ===== Список заявок на кредит ===== */
function select_credit_request($id = 0){
    if($id){
        $str = " AND credit_request_id = $id ";
    } else {
        $str = "";
    }
    $query = "SELECT
                *,
                DATE_FORMAT(date_open,'%d.%m.%Y') as dateOpen,
                (SELECT name FROM status_request WHERE status_request.status_request_id = credit_request.status_request_id) as status_request_name,
                (SELECT fio FROM employees WHERE employees.employees_id = credit_request.employees_id) as employees_fio,
                (SELECT name FROM type_employ WHERE type_employ.type_employ_id = credit_request.type_employ_id) as type_employ_name,
                (SELECT name FROM count_child WHERE count_child.count_child_id = credit_request.count_child_id) as count_child_name,
                (SELECT name FROM marital_status WHERE marital_status.marital_status_id = credit_request.marital_status_id) as marital_status_name,
                (SELECT name FROM education WHERE education.education_id = credit_request.education_id) as education_name,
                (SELECT name FROM car WHERE car.car_id = credit_request.car_id) as car_name,
                (SELECT name FROM age WHERE age.age_id  = credit_request.age_id) as age_name,
                (SELECT name FROM monthly_income WHERE monthly_income.monthly_income_id = credit_request.monthly_income_id) as monthly_income_name,
                (SELECT name FROM experience WHERE experience.experience_id = credit_request.experience_id) as experience_name
                    FROM `credit_request`, `clients`
                    WHERE credit_request.clients_id = clients.clients_id
                    $str
                    ORDER BY `credit_request`.credit_request_id DESC";
    $res = mysql_query($query);
    $arr = array();
    while ($row = mysql_fetch_assoc($res)){
        $arr[] = $row;
    }

    return $arr;
}
/* ===== Список заявок на кредит ===== */

/* ===== Информация по одному пользователю ===== */
function select_one_employees($employees_id){
    $query = "SELECT * FROM employees WHERE employees_id = $employees_id LIMIT 1";
    $res = mysql_query($query);
    $arr = array();
    while ($row = mysql_fetch_assoc($res)){
        $arr[] = $row;
    }

    return $arr;
}
/* ===== Информация по одному пользователю ===== */

/* ===== Редактирование пользователя ===== */
function update_employees(){
    $employees_id = abs((int)($_POST['employees_id']));
    $fio = clear($_POST['fio']);
    $access_id = abs((int)$_POST['access_id']);
    $tel = clear($_POST['tel']);
    $email = clear($_POST['email']);

    if($_POST['password_old'] == $_POST['password']){
        // если пароль остался без изменения, то ничего с паролем не делаем
        $password = $_POST['password'];
    } else {
        // если придуман новый пароль, то шифруем его
        $password = md5($_POST['password']);
    }

    $query = "UPDATE `employees`
                SET `fio`='$fio', `tel`='$tel', `email`='$email', `password`='$password', `access_id`='$access_id'
                WHERE employees_id = $employees_id";
    mysql_query($query);
    if(mysql_affected_rows()>0){
        $_SESSION['message'] = "<div class='alert alert-info'>Пользователь изменен.</div>";
    }else{
        $_SESSION['message'] = "<div class='alert alert-danger'>Ошибка при изменении пользователя.</div>";
    }
}
/* ===== Редактирование пользователя ===== */

/* ===== Изменеие статуса в заказе на новый ===== */
function update_status_request($credit_request_id, $status_request_id){

    $query = "UPDATE `credit_request`
                SET `status_request_id` = $status_request_id
                WHERE `credit_request_id` = $credit_request_id";
    mysql_query($query);
    if(mysql_affected_rows()>0){
        $_SESSION['message'] = "<div class='alert alert-info'>Новый статус у заявки $orders_id.</div>";
    }else{
        $_SESSION['message'] = "<div class='alert alert-danger'>Ошибка при изменении статуса заявки.</div>";
    }
}
/* ===== Изменеие статуса в заказе на новый ===== */

/* ===== История по одной кредитной заявке ===== */
function select_history_request($id){
    $query = "SELECT
                `history_request_id`,
                `credit_request_id`,
                DATE_FORMAT(datetime_message,'%d.%m.%Y %H:%i') as Date_Time,
                employees_id,
                (SELECT fio FROM employees WHERE employees.employees_id = history_request.employees_id) as employees_fio,
                `message`,
                `fileName`
                    FROM `history_request`
                    WHERE `credit_request_id` = $id
                    ORDER BY history_request_id DESC";
    mysql_query($query);
    $res = mysql_query($query);
    $arr = array();
    while ($row = mysql_fetch_assoc($res)){
        $arr[] = $row;
    }
    return $arr;
}
/* ===== История по одной кредитной заявке ===== */

/* ===== Добавление истории по кредитной заявке ===== */
function insert_history_request(){
    $filename = rus_to_eng($_FILES['filename']['name']);
    //$uploadfile = __DIR__.'\documents\\'.$filename;
    $uploadfile = $filename;
    move_uploaded_file($_FILES['filename']['tmp_name'], $uploadfile);

    $credit_request_id = abs((int)$_POST['credit_request_id']);
    $employees_id = abs((int)$_POST['employees_id']);
    $message = clear($_POST['message']);
    $query = "INSERT INTO `history_request`(`credit_request_id`, `datetime_message`, `employees_id`, `message`, `fileName`)
                VALUES ($credit_request_id, NOW(), $employees_id, '$message', '$filename')";
    mysql_query($query);
    if(mysql_affected_rows()>0){
        // если сообщение добавил сотрудник
        if($employees_id){
            send_mail($message, $credit_request_id); // отправить письмо клиенту
        }
        $_SESSION['message'] = "<div class='alert alert-info'>Сообщение по кредитной заявке добавлена.</div>";
    }else{
        $_SESSION['message'] = "<div class='alert alert-danger'>Ошибка при добавлении сообщения по кредитной заявке.</div>";
    }
}
/* ===== Добавление истории по кредитной заявке ===== */

/* ===== Одна кредитная заявка по определеннному клиенту ===== */
function get_credit_request_client(){
    if($_POST['credit_request_id']){
        $credit_request_id = clear($_POST['credit_request_id']);
    } elseif ($_GET['id']){
        $credit_request_id = clear($_GET['id']);
    }
    if($_POST['phone']){
        $phone = clear($_POST['phone']);
    } elseif ($_GET['phone']){
        $phone = clear($_GET['phone']);
    }

    $query = "SELECT
                  credit_request_id, fio, phone,
                  email, date_open, sum_credit, srok_credit, proc_credit,
                  platezh_credit, purpose_credit, status_request_id, employees_id, conclusion
                FROM credit_request, clients
                 WHERE credit_request.clients_id = clients.clients_id
                 AND credit_request.credit_request_id = $credit_request_id
                 AND clients.phone = '$phone'
                 LIMIT 1";
    mysql_query($query);
    $res = mysql_query($query);
    if(mysql_num_rows($res) == 1){
        $row = mysql_fetch_row($res);
        $_SESSION['client']['credit_request_id'] = $row[0];
        $_SESSION['client']['fio'] = $row[1];
        $_SESSION['client']['phone'] = $row[2];

        $_SESSION['client']['email'] = $row[3];
        $_SESSION['client']['date_open'] = $row[4];
        $_SESSION['client']['sum_credit'] = $row[5];
        $_SESSION['client']['srok_credit'] = $row[6];
        $_SESSION['client']['proc_credit'] = $row[7];

        $_SESSION['client']['platezh_credit'] = $row[8];
        $_SESSION['client']['purpose_credit'] = $row[9];
        $_SESSION['client']['status_request_id'] = $row[10];
        $_SESSION['client']['employees_id'] = $row[11];
        $_SESSION['client']['conclusion'] = $row[12];
    } else {
        // если такой заявки нет или ошибка в данных
        $_SESSION['message'] = "<div class='alert alert-danger' style='margin-top: 10px;'>Такой кредитной заявки нет, либо ввели неправильные данные.</div>";
    }

}
/* ===== Одна кредитная заявка по определеннному клиенту ===== */

/* ===== Скоринг-система ===== */
function skoring_money($credit_request_id){
    $query = "SELECT fixed_income, additional_income, fixed_outcome, platezh_credit
                FROM credit_request
                 WHERE credit_request_id = $credit_request_id
                 LIMIT 1";
    mysql_query($query);
    $res = mysql_query($query);
    if(mysql_num_rows($res) == 1) {
        $row = mysql_fetch_row($res);
        $fixed_income = $row[0];
        $additional_income = $row[1];
        $fixed_outcome = $row[2];
        $platezh_credit = $row[3];
    }

    $life_min = 8526; // прожиточный минимум в Белгороде
    $koef_need_pay = 0.4; // 40% - коэффициент платежеспособности (минимальный необходимый остаток средств от суммы дохода)
    $koef_dop_dohod = 0.3; // 30% - учитываемая доля дополнительного дохода клиента
    $need_money = $fixed_income * $koef_need_pay; // какой минимальной суммой должен распологать клиент

    // Расчет реального остатка после всех расходов = постоянный доход + 3-ья часть от дополнительного дохода - постоянные расходы - прожиточный минимум
    $real_money = $fixed_income + $additional_income*$koef_dop_dohod - $fixed_outcome - $life_min;

    // если реальный остаток средств больше необходимой суммы
    // и больше ежемесячного платежа по кредиту
    if($real_money >= $need_money and $real_money >= $platezh_credit){
        echo "Достаточно дохода для получение кредита. ";
    } else {
        echo "Недостаточно дохода для получение кредита. ";
    }
}
/* ===== Скоринг-система ===== */

/* ===== Добавление нового клиента ===== */
function insert_clients(){
    $fio = clear($_POST['fio']);
    $phone = clear($_POST['phone']);
    $email = clear($_POST['email']);

    $passport_serial = abs((int)$_POST['passport_serial']);
    $passport_number = abs((int)$_POST['passport_number']);
    $code_podrazd = clear($_POST['code_podrazd']);
    $date_vydachi = clear($_POST['date_vydachi']);
    $date_rozhd = clear($_POST['date_rozhd']);
    $mesto_rozhd = clear($_POST['mesto_rozhd']);
    $kem_vydan = clear($_POST['kem_vydan']);

    $index_address_reg = abs((int)$_POST['index_address_reg']);
    $address_reg = clear($_POST['address_reg']);
    $index_address_fact = abs((int)$_POST['index_address_fact']);
    $address_fact = clear($_POST['address_fact']);

    $query = "INSERT INTO `clients`(
                `fio`, `phone`, `email`, `passport_serial`,
                `passport_number`, `code_podrazd`, `date_vydachi`, `date_rozhd`, `mesto_rozhd`,
                `kem_vydan`, `index_address_reg`, `address_reg`, `index_address_fact`, `address_fact`)
                  VALUES (
                      '$fio', '$phone', '$email', '$passport_serial',
                      '$passport_number', '$code_podrazd', '$date_vydachi', '$date_rozhd', '$mesto_rozhd',
                      '$kem_vydan', '$index_address_reg', '$address_reg', '$index_address_fact', '$address_fact'
                  )";
    mysql_query($query);
    return mysql_insert_id();
}
/* ===== Добавление нового клиента ===== */

/* ===== Расчет баллов по скоринг-системе ===== */
function points_calculation($table, $field_id, $val_id){ // в эту функцию нужно передать название таблицы, имя ключевого поля, значение ключа
    $query = "SELECT points FROM $table WHERE $field_id = $val_id";
    mysql_query($query);
    $res = mysql_query($query);
    $row = mysql_fetch_row($res);
    if(mysql_num_rows($res) == 1) {
        //echo "<script>alert('".$row[0]."');</script>";
        return $row[0];
    } else {
        return 0;
    }
}
/* ===== Расчет баллов по скоринг-системе ===== */

/* ===== Добавление новой кредитной заявки ===== */
function insert_credit_request(){
    $sum_points = 0; // сумма баллов скоринг-системы

    $sum_credit = abs((int)$_POST['sum_credit']);
    $srok_credit = abs((int)$_POST['srok_credit']);
    $proc_credit = clear($_POST['proc_credit']);
    $platezh_credit = clear($_POST['platezh_credit']);
    $purpose_credit = clear($_POST['purpose_credit']);
    $fixed_income = abs((int)$_POST['fixed_income']);
    $additional_income = abs((int)$_POST['additional_income']);
    $fixed_outcome = abs((int)$_POST['fixed_outcome']);
    $conclusion = clear($_POST['conclusion']);

    $type_employ_id = abs((int)$_POST['type_employ_id']);
    $sum_points += points_calculation('type_employ', 'type_employ_id', $type_employ_id);
    $name_org = clear($_POST['name_org']);
    $experience_id = abs((int)$_POST['experience_id']);
    $sum_points += points_calculation('experience', 'experience_id', $experience_id);
    $position_employ_id = abs((int)$_POST['position_employ_id']);
    $sum_points += points_calculation('position_employ', 'position_employ_id', $position_employ_id);
    $monthly_income_id = abs((int)$_POST['monthly_income_id']);
    $sum_points += points_calculation('monthly_income', 'monthly_income_id', $monthly_income_id);

    $count_child_id = abs((int)$_POST['count_child_id']);
    $sum_points += points_calculation('count_child', 'count_child_id', $count_child_id);
    $marital_status_id = abs((int)$_POST['marital_status_id']);
    $sum_points += points_calculation('marital_status', 'marital_status_id', $marital_status_id);
    $education_id = abs((int)$_POST['education_id']);
    $sum_points += points_calculation('education', 'education_id', $education_id);
    $car_id = abs((int)$_POST['car_id']);
    $sum_points += points_calculation('car', 'car_id', $car_id);
    $age_id = abs((int)$_POST['age_id']);
    $sum_points += points_calculation('age', 'age_id', $age_id);

    // добавление клиента в БД
    $clients_id = insert_clients();

    // добавление кредитной заявки в БД
    $query = "INSERT INTO `credit_request`(
                `date_open`, `clients_id`,`sum_credit`, `srok_credit`, `proc_credit`, `platezh_credit`, `purpose_credit`,
                `type_employ_id`, `name_org`, `experience_id`, `position_employ_id`, `count_child_id`, `marital_status_id`,
                `education_id`, `age_id`, `monthly_income_id`, `fixed_income`, `additional_income`,
                `fixed_outcome`, `car_id`, `conclusion`, `sum_points`
                )
                  VALUES (
                      NOW(), '$clients_id', '$sum_credit', '$srok_credit', '$proc_credit', '$platezh_credit', '$purpose_credit',
                      '$type_employ_id', '$name_org', '$experience_id', '$position_employ_id', '$count_child_id', '$marital_status_id',
                      '$education_id', '$age_id', '$monthly_income_id', '$fixed_income', '$additional_income',
                      '$fixed_outcome', '$car_id', '$conclusion', '$sum_points'
                  )";
    mysql_query($query);
    if(mysql_affected_rows()>0){
        // если кредитная заявка добавлена
        $_SESSION['message'] = "<div class='alert alert-info'>Кредитная завяка добавлена.</div>";
    }else{
        $_SESSION['message'] = "<div class='alert alert-danger'>Ошибка при добавлении кредитной заявке.</div>";
    }
}
/* ===== Добавление нового клиента и кредитной заявки ===== */

/* ===== Редактирование кредитной заявки ===== */
function update_credit_request(){

    $sum_points = 0; // сумма баллов скоринг-системы

    $credit_request_id = abs((int)$_POST['credit_request_id']);

    $sum_credit = abs((int)$_POST['sum_credit']);
    $srok_credit = abs((int)$_POST['srok_credit']);
    $proc_credit = clear($_POST['proc_credit']);
    $platezh_credit = clear($_POST['platezh_credit']);
    $purpose_credit = clear($_POST['purpose_credit']);
    $fixed_income = abs((int)$_POST['fixed_income']);
    $additional_income = abs((int)$_POST['additional_income']);
    $fixed_outcome = abs((int)$_POST['fixed_outcome']);
    $conclusion = clear($_POST['conclusion']);

    $type_employ_id = abs((int)$_POST['type_employ_id']);
    $sum_points += points_calculation('type_employ', 'type_employ_id', $type_employ_id);
    $name_org = clear($_POST['name_org']);
    $experience_id = abs((int)$_POST['experience_id']);
    $sum_points += points_calculation('experience', 'experience_id', $experience_id);
    $position_employ_id = abs((int)$_POST['position_employ_id']);
    $sum_points += points_calculation('position_employ', 'position_employ_id', $position_employ_id);
    $monthly_income_id = abs((int)$_POST['monthly_income_id']);
    $sum_points += points_calculation('monthly_income', 'monthly_income_id', $monthly_income_id);

    $count_child_id = abs((int)$_POST['count_child_id']);
    $sum_points += points_calculation('count_child', 'count_child_id', $count_child_id);
    $marital_status_id = abs((int)$_POST['marital_status_id']);
    $sum_points += points_calculation('marital_status', 'marital_status_id', $marital_status_id);
    $education_id = abs((int)$_POST['education_id']);
    $sum_points += points_calculation('education', 'education_id', $education_id);
    $car_id = abs((int)$_POST['car_id']);
    $sum_points += points_calculation('car', 'car_id', $car_id);
    $age_id = abs((int)$_POST['age_id']);
    $sum_points += points_calculation('age', 'age_id', $age_id);

    $query = "UPDATE `credit_request`
                SET `sum_credit` = '$sum_credit', `srok_credit` = '$srok_credit', `proc_credit` = '$proc_credit', `platezh_credit` = '$platezh_credit', `purpose_credit` = '$purpose_credit',
                `type_employ_id` = '$type_employ_id', `name_org` = '$name_org', `experience_id` = '$experience_id', `position_employ_id` = '$position_employ_id', `count_child_id` = '$count_child_id', `marital_status_id` = '$marital_status_id',
                `education_id` = '$education_id', `age_id` = '$age_id', `monthly_income_id` = '$monthly_income_id', `fixed_income` = '$fixed_income', `additional_income` = '$additional_income',
                `fixed_outcome` = '$fixed_outcome', `car_id` = '$car_id', `conclusion` = '$conclusion', `sum_points` = '$sum_points'
                  WHERE `credit_request_id` = $credit_request_id";
    //echo "<pre>$query</pre>";
    mysql_query($query);
}
/* ===== Редактирование кредитной заявки ===== */

/* ===== Редактирование клиента ===== */
function update_clients(){
    $clients_id = abs((int)$_POST['clients_id']);

    $fio = clear($_POST['fio']);
    $phone = clear($_POST['phone']);
    $email = clear($_POST['email']);

    $passport_serial = abs((int)$_POST['passport_serial']);
    $passport_number = abs((int)$_POST['passport_number']);
    $code_podrazd = clear($_POST['code_podrazd']);
    $date_vydachi = clear($_POST['date_vydachi']);
    $date_rozhd = clear($_POST['date_rozhd']);
    $mesto_rozhd = clear($_POST['mesto_rozhd']);
    $kem_vydan = clear($_POST['kem_vydan']);

    $index_address_reg = abs((int)$_POST['index_address_reg']);
    $address_reg = clear($_POST['address_reg']);
    $index_address_fact = abs((int)$_POST['index_address_fact']);
    $address_fact = clear($_POST['address_fact']);

    $query = "UPDATE `clients`
                SET `fio` = '$fio', `phone` = '$phone', `email` = '$email', `passport_serial` = '$passport_serial',
                `passport_number` = '$passport_number', `code_podrazd` = '$code_podrazd', `date_vydachi` = '$date_vydachi', `date_rozhd` = '$date_rozhd', `mesto_rozhd` = '$mesto_rozhd',
                `kem_vydan` = '$kem_vydan', `index_address_reg` = '$index_address_reg', `address_reg` = '$address_reg', `index_address_fact` = '$index_address_fact', `address_fact` = '$address_fact'
                WHERE `clients_id` = $clients_id";
    mysql_query($query);
}
/* ===== Редактирование клиента ===== */
?>