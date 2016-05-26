<?php
session_start();

// подключение модели
require_once 'model/model.php';

// подключение библиотеки функций
require_once 'functions/functions.php';

// получение динаминой части шаблона
if(empty($_GET['view'])){
    $view = 'main';
} else {
    $view = $_GET['view'];
}

switch($view){
    case('main'):
        // главная страница
        $javascript = "<script src='views/js/MyJavascript.js'></script>";

        $type_employ = select_table('type_employ');
        $experience = select_table('experience');
        $count_child = select_table('count_child');
        $marital_status = select_table('marital_status');
        $education = select_table('education');
        $car = select_table('car');
        $position_employ = select_table('position_employ');
        $age = select_table('age');
        $monthly_income = select_table('monthly_income');

        // Если нажата кнопка Отправить
        if(isset($_POST['add'])){
            insert_credit_request();
            redirect();
        }
        break;

    case('auth'):
        // авторизация сотрудника по кредитам

        // если нажата кнопка Войти
        if(isset($_POST['enter'])){
            authorization();
            if($_SESSION['auth']['access_id'] == 3){
                header("location: ?view=employees");
            }
            if($_SESSION['auth']['access_id'] == 2){
                header("location: ?view=credit_request");
            }
        }

        // если Администратор авторизовался, то перенаправить на страницу Сотрудники
        if($_SESSION['auth']['access_id'] == 3){
            header("location: ?view=employees");
        }

        // если Пользователь авторизовался, то перенаправить на страницу Кредитные заявки
        if($_SESSION['auth']['access_id'] == 2){
            header("location: ?view=credit_request");
        }

        // если нажата кнопка Выйти
        if(isset($_POST['exit']) or $_GET['action'] == 'exit'){
            unset($_SESSION['auth']); // очистить сессию
            redirect();
        }
        break;

    case('auth_client'):
        // авторизация клиента


        if(
            (isset($_GET['id']) and isset($_GET['phone'])) // если на страницу попали через почту
            or (isset($_POST['enter'])) // если нажата кнопка Войти
        )
        {
            get_credit_request_client();
            header("location: ?view=credit_request_client");
        }

        break;

    case('credit_request_client'):
        //информация по кредитной заявке для клиента

        $status_request = select_table('status_request');
        $employees = select_table('employees');
        $history_request = select_history_request($_SESSION['client']['credit_request_id']); // получение истории по кредитной заявке

        // добавление истории по заявке
        if(isset($_POST['add'])) {
            insert_history_request();
            redirect();
        }

        // если нажата кнопка Выйти
        if(isset($_POST['exit'])){
            unset($_SESSION['client']); // очистить сессию
            header("location: ?view=auth_client");
        }
        break;

    case('employees'):
        // сотрудники
        verifying_access(); // проверка авторизации

        // получение списка сотрудников
        $employees = select_table('employees');

        // добавление сотрудника
        if(isset($_POST['fio'])){
            insert_table('employees', $_POST);
            redirect();
        }
        break;

    case('employees_detail'):
        // детальная информация по сотруднику
        verifying_access(); // проверка авторизации

        // открыть 1 пользователя
        if(isset($_GET['id'])){
            $employees_id = clear($_GET['id']);
            $employees = select_one_employees($employees_id);
        }

        // изменение пользователя
        if(isset($_POST['upd'])){
            update_employees();
            redirect();
        }

        // удаление пользователя
        if(isset($_POST['del'])){
            $id = abs((int)$_POST['employees_id']);
            delete_table('employees', 'employees_id', $id);
            header("location: ?view=employees");
        }

        break;

    case('credit_request'):
        // список кредитных заявок
        verifying_access(); // проверка авторизации

        $status_request = select_table('status_request');
        $credit_request = select_credit_request();

        // изменение статуса заявки
        if($_GET['action'] == 'new_status'){
            $credit_request_id = abs((int)$_GET['credit_request_id']);
            $status_request_id = abs((int)$_GET['status_request_id']);
            update_status_request($credit_request_id, $status_request_id);
            redirect();
        }

        // удаление кредитной заявки
        if($_GET['action'] == "del"){
            $id = abs((int)$_GET['id']);
            delete_table('credit_request', 'credit_request_id', $id);
            header("location: ?view=credit_request");
        }
        break;

    case('credit_request_detail'):
        // детальная информация по одной кредитной заявке
        verifying_access(); // проверка авторизации

        // открыть информацию по 1 кредитной заявке
        if(isset($_GET['id'])){
            $id = clear($_GET['id']);


            $credit_request = select_credit_request($id); // получение инфо по кредитной заявке

            $status_request = select_table('status_request'); // получить инфу из таблицы Статус кред.заявки
            $employees = select_table('employees'); // получить инфу из таблицы Статус кред.заявки
            $type_employ = select_table('type_employ'); // получить инфу из таблицы Тип занятости
            $count_child = select_table('count_child'); // получить инфу из таблицы Количество детей
            $marital_status = select_table('marital_status'); // получить инфу из таблицы Семейное положение
            $education = select_table('education'); // получить инфу из таблицы Образование
            $car = select_table('car'); // получить инфу из таблицы Автомобиль
            $experience = select_table('experience'); // получить инфу из таблицы Стаж на последнем месте
            $age = select_table('age'); // получить инфу из таблицы Возраст
            $monthly_income = select_table('monthly_income'); // получить инфу из таблицы Месячный доход
            $position_employ = select_table('position_employ'); // получить инфу из таблицы Квалификация

            $history_request = select_history_request($id); // получение истории по кредитной заявке
        }

        // удалить кредитную заявку
        if(isset($_POST['del'])){
            $id = abs((int)$_POST['credit_request_id']);
            delete_table('credit_request', 'credit_request_id', $id);
            header("location: ?view=credit_request");
        }
        // добавление истории по заявке
        elseif(isset($_POST['add'])) {
            insert_history_request();
            redirect();
        }
        // изменить кредитную заявку
        elseif(isset($_POST['credit_request_id'])){
            update_credit_request();
            update_clients();
            redirect();
        }
        break;

    case('credit_request_print'):
        // печать заявки на кредит
        if(isset($_GET['id'])) {
            $id = clear($_GET['id']);
            $credit_request = select_credit_request($id);
        }

        break;

    default:
        // если из адресной строки получено имя несуществуюшего шаблона
        $view = 'main';

        break;
}

// подключение вида
require_once 'views/index.php';

?>