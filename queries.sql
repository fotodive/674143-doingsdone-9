/*Существующий список проектов;*/
insert into projects (title, user_id)
values ('Входящие', 1), ('Учеба', 2), ('Работа', 3), ('Домашние дела', 2), ('Авто', 1);
/*Придумайте пару пользователей;*/
insert into users (email, name, password)
values ('kostay@mail.ru', 'Константин', '123321'), ('masha@mail.ru', 'Маша', '321123'), ('irina@mail.ru', 'Ирина', 'aaa123');
/*Существующий список задач.*/
insert into tasks set status_task = 0, title = 'Собеседование в IT компании', deadline = '2019-06-09', user_id = 3, project_id = 3;
insert into tasks set status_task = 0, title = 'Выполнить тестовое задание', deadline = '2019-06-10', user_id = 3, project_id = 3;
insert into tasks set status_task = 1, title = 'Сделать задание первого раздела', deadline = '2018-12-21', user_id = 2, project_id = 2;
insert into tasks set status_task = 0, title = 'Встреча с другом', deadline = '2018-12-22', user_id = 1, project_id = 1;
insert into tasks set status_task = 0, title = 'Купить корм для кота', deadline = null, user_id = 2, project_id = 4;
insert into tasks set status_task = 0, title = 'Заказать пиццу', deadline = null, user_id = 2, project_id = 4;

/*получить список из всех проектов для одного пользователя. */
select p.project_id, p.title, p.user_id as user_projects from projects p where p.user_id = 2;
/*Объедините проекты с задачами, чтобы посчитать количество задач в каждом проекте и в дальнейшем выводить эту цифру рядом с именем проекта;*/
select p.project_id, p.title, count(t.id) as count_tasks from projects p left join tasks t on p.project_id = t.project_id where p.user_id = 2 group by p.project_id;
/*получить список из всех задач для одного проекта;*/
select id, data_add, status_task, title, file_task, deadline, user_id, project_id from tasks where project_id = 2;
/*пометить задачу как выполненную;*/
update tasks set status_task = 1 where id = 4;
/*обновить название задачи по её идентификатору.*/
update tasks set title = 'Купить подукты' where id = 5;
