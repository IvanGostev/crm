<?php

$titlePage = 'Opened task';
$items = ['/todo/tasks/create' => 'Create Task'];
ob_start();

?>

    <html lang='en'>
    <head>
        <meta charset='utf-8'/>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
        <script>
            // Получение данных о задачах, из нашего PHP-контроллера
            const tasksJson = <?= json_encode(json_encode($data)) ?>;
            const tasks = JSON.parse(tasksJson); // tasks это массив объектов
            // Преобразование данных (массива) в задачи для календаря
            const events = tasks.map((task) => {
                return {
                    title: task.title,
                    start: new Date(task.created_at), // Используйте created_at вместо start_date
                    end: new Date(task.finish_date), // Используйте finish_date вместо end_date
                    extendedProps: {
                        task_id: task.id, // добавьте ID задачи в расширенные свойства
                    },
                };
            });

            // Обработчик событий загрузки DOM
            document.addEventListener('DOMContentLoaded', function () {
                const calendarEl = document.getElementById('calendar');

                // Инициализация календаря с настройками
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    // initialView: 'dayGridMonth',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth',
                    themeSystem: 'bootstrap5',
                    events: events, // Задачи в виде событий на календаре
                    eventClick: function (info) {
                        const taskId = info.event.extendedProps.task_id;

                        // URL для  адреса страницы конкретной задачи
                        const taskUrl = `/todo/tasks/show/${taskId}`;

                        //переход на страницу задачи
                        window.location.href = taskUrl;
                    },
                });

                calendar.render();
            });
        </script>
    </head>
    <body>
    <div id='calendar'></div>
    </body>
    </html>

<?php $content = ob_get_clean();
require_once 'views/layouts/layout.php';