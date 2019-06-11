<h2 class="content__main-heading">Список задач</h2>

<form class="search-form" action="index.php" method="post" autocomplete="off">
    <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

    <input class="search-form__submit" type="submit" name="" value="Искать">
</form>

<div class="tasks-controls">
    <nav class="tasks-switch">
        <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
        <a href="/" class="tasks-switch__item">Повестка дня</a>
        <a href="/" class="tasks-switch__item">Завтра</a>
        <a href="/" class="tasks-switch__item">Просроченные</a>
    </nav>

    <label class="checkbox">
        <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
        <input class="checkbox__input visually-hidden show_completed" type="checkbox"
        <?php if ($show_complete_tasks === 1): ?>checked<?php endif; ?> >
        <span class="checkbox__text">Показывать выполненные</span>
    </label>
</div>

<table class="tasks">
    <?php foreach($tasks as $key => $task): ?>
        <tr class="tasks__item task <?=check_deadline($task["deadline"]); ?><?php if ($task["status_task"] === "1"): ?> task--completed <?php endif; ?><?=add_class($show_complete_tasks, $task["status_task"]); ?>">
            <td class="task__select">
                <label class="checkbox task__checkbox">
                    <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1" <?php if ($task["status_task"] === "1"): ?>checked<?php endif; ?>>
                    <span class="checkbox__text"><?=htmlspecialchars($task["title"]);?></span>
                </label>
            </td>
            <td class="task__category"><?=htmlspecialchars($task["project"]);?></td>
            <td class="task__date"><?=$task["deadline"] ;?></td>
        </tr>
    <?php endforeach; ?>
</table>


