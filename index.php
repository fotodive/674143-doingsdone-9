<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set("Europe/Moscow");
require_once('helpers.php');
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);
// массив
/*$categories = ["Входящие", "Учеба", "Работа", "Домашние дела", "Авто"];
$tasks = [
["problem" => "Собеседование в IT компании", "data" => "09.06.2019", "category" => "Работа", "ready" => "Нет"],
["problem" => "Выполнить тестовое задание", "data" => "10.06.2019", "category" => "Работа", "ready" => "Нет"],
["problem" => "Сделать задание первого раздела", "data" => "21.12.2018", "category" => "Учеба", "ready" => "Да"],
["problem" => "Встреча с другом", "data" => "22.12.2018", "category" => "Входящие", "ready" => "Нет"],
["problem" => "Купить корм для кота", "data" => "Нет", "category" => "Домашние дела", "ready" => "Нет"],
["problem" => "Заказать пиццу", "data" => "Нет", "category" => "Домашние дела", "ready" => "Нет"]
];*/

//подключение к базе
$connect = mysqli_connect("localhost", "root", "", "doingsdone");
mysqli_set_charset($connect, "utf8");

//проверка на ошибку
function check_error ($result) {
    if (!$result) {
        $error = mysqli_error($connect);
        return print("Ошибка MySQL:" . $error);
    }
}
//проверка подключения
if ($connect == false) {
    print("Ошибка подключения:" . mysqli_connect_error());
}
else {
    $sql_tasks = "SELECT t.title, t.status_task, t.deadline, p.project FROM tasks t LEFT JOIN projects p ON p.project_id = t.project_id WHERE t.user_id = 3";
    $sql_projects = "SELECT p.project, count(t.id) AS count_tasks FROM projects p LEFT JOIN tasks t ON p.project_id = t.project_id WHERE p.user_id = 3 GROUP BY p.project_id;";
    $result_projects = mysqli_query($connect, $sql_projects);
    $result_tasks = mysqli_query($connect, $sql_tasks);
    check_error($result_projects);
    check_error($result_tasks);
    $projects = mysqli_fetch_all($result_projects, MYSQLI_ASSOC);
    $tasks = mysqli_fetch_all($result_tasks, MYSQLI_ASSOC);

}

//скрываем выполненное
function add_class($show_complete_tasks, $get_ready) {
    $hidden = "";
    if ($get_ready === "1" AND $show_complete_tasks === 0) {
        $hidden = "visually-hidden";
    }
    return $hidden;
}
//считаем задачи
//function countTasks($tasks, $category) {
//    $count = 0;
//    foreach ($tasks as $key => $task) {
//        if ($task["category"] === $category) {
//            $count ++;
//        }
//    }
//    return $count;
//}
//считаем даты
function check_deadline($task_data) {
    if ($task_data !== "NULL") {
        $today = time();
        $date = date_parse_from_format("Y-m-d", $task_data);
        $deadline = mktime(23, 59, 59, $date["month"], $date["day"], $date["year"]);
        $diff_time = floor(($deadline - $today)/3600);
        if ($diff_time <= 24) {
            $new_class = "task--important";
        }
    }
    return $new_class;
}

$page_content = include_template("index.php", ["tasks" => $tasks, "show_complete_tasks" => $show_complete_tasks]);

$layout_content = include_template("layout.php", ["content" => $page_content, "title" => "Дела в порядке", "projects" => $projects, "tasks" => $tasks] );
print($layout_content);

?>
