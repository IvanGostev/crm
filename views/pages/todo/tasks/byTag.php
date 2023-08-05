<?php
$titlePage = 'By tag: ' . $data[0]['tag'];
$items = ['/todo/tasks/create' => 'Create task'];
ob_start();
?>
    <div class="d-flex justify-content-around row filter-priority">
        <a data-priority="low" class="btn mb-3 col-2 sort-btn bg-info">Low</a>
        <a data-priority="medium" class="btn mb-3 col-2 sort-btn bg-success">Medium</a>
        <a data-priority="high" class="btn mb-3 col-2 sort-btn bg-warning">High</a>
        <a data-priority="urgent" class="btn mb-3 col-2 sort-btn bg-danger">Urgent</a>
    </div>

    <div class="row" id="task-container">
        <?php foreach ($data as $task): ?>
            <div class="col-md-4" id="task-container__item">
                <div class="card card-outline collapsed-card card-<?= $task['color'] ?>">
                    <div class="card-header">
                <span class="col-12 col-md-5"><i
                            class="fa-solid fa-square-up-right"></i> <strong><?php echo $task['title']; ?> </strong></span>
                        <span class="col-5 col-md-3"><i
                                    class="fa-solid fa-person-circle-question"></i> <?php echo htmlspecialchars($task['category'] ?? 'N/A'); ?> </span>
                        <span class="col-5 col-md-3"><i class="fa-solid fa-hourglass-start"></i><span
                                    class="due-date"><?php echo $task['finish_date']; ?></span></span>

                        <div class="card-tools">
                            <button type="button" data-priority="<?=$task['priority']?>" class="btn btn-tool btn-priority" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="display: none;">
                        <p><strong><i class="fa-solid fa-layer-group"></i>
                                Category:</strong> <?php echo htmlspecialchars($task['category'] ?? 'N/A'); ?></p>
                        <p><strong><i class="fa-solid fa-battery-three-quarters"></i>
                                Status:</strong> <?php echo htmlspecialchars($task['status']); ?></p>
                        <p><strong><i class="fa-solid fa-person-circle-question"></i>
                                Priority:</strong> <?php echo htmlspecialchars($task['priority']); ?></p>
                        <p><strong><i class="fa-solid fa-hourglass-start"></i> Дата
                                Finish date:</strong> <?php echo htmlspecialchars($task['finish_date']); ?></p>
                        <p><strong><i class="fa-solid fa-file-prescription"></i>
                                Description:</strong> <?php echo htmlspecialchars($task['description'] ?? 'Отсутствует'); ?>
                        </p>
                        <p><strong><i class="fa-solid fa-file-prescription"></i> Tags:</strong>
                            <?php foreach ($task['tags'] as $tag): ?>
                                <a href="/todo/tasks/by-tag/<?= $tag['id'] ?>"
                                   class="tag"><?= htmlspecialchars($tag['title']) ?></a>
                            <?php endforeach; ?>
                        </p>
                        <div class="d-flex justify-content-end">
                            <a href="/todo/tasks/edit/<?= $task['id'] ?>"
                               class="btn btn-sm btn-outline-primary  me-2">Edit</a>
                            <form method="POST" action="/tasks/delete" class="d-inline-block">
                                <input type="text" name="id" hidden="hidden" value="<?= $task['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Вы уверены?')">Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        <?php endforeach; ?>
    </div>


<?php $content = ob_get_clean();
require_once 'views/layouts/layout.php';