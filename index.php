<?php

require_once('helpers.php');
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);
// массив
$categories = ["Входящие", "Учеба", "Работа", "Домашние дела", "Авто"];
$tasks = [
["problem" => "Собеседование в IT компании", "data" => "01.12.2018", "category" => "Работа", "ready" => "Нет"],
["problem" => "Выполнить тестовое задание", "data" => "25.12.2018", "category" => "Работа", "ready" => "Нет"],
["problem" => "Сделать задание первого раздела", "data" => "21.12.2018", "category" => "Учеба", "ready" => "Да"],
["problem" => "Встреча с другом", "data" => "22.12.2018", "category" => "Входящие", "ready" => "Нет"],
["problem" => "Купить корм для кота", "data" => "Нет", "category" => "Домашние дела", "ready" => "Нет"],
["problem" => "Заказать пиццу", "data" => "Нет", "category" => "Домашние дела", "ready" => "Нет"]
];
//скрываем выполненное
function add_class($show_complete_tasks, $get_ready) {
    if ($get_ready === "Да" AND $show_complete_tasks === 0) {
        $hidden = "visually-hidden";
    }
    return $hidden;
}
//считаем задачи
function countTasks($tasks, $category) {
    $count = 0;
    foreach ($tasks as $key => $task) {
        if ($task["category"] === $category) {
            $count ++;
        }
    }
    return $count;
}

$page_content = include_template("index.php", ["tasks" => $tasks, "show_complete_tasks" => $show_complete_tasks]);

$layout_content = include_template("layout.php", ["content" => $page_content, "title" => "Дела в порядке", "categories" => $categories, "tasks" => $tasks] );
print($layout_content);


?>
