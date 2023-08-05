<?php

$titlePage = 'Todo list';
ob_start();
?>

    <div class="card mb-4">
        <div class="card-header">
            <h1 class="card-title">
                <i class="fa-solid fa-square-up-right"></i> <strong><?php echo $data['task']['title']; ?> </strong>
            </h1>
        </div>
        <div class="card-body">
            <p class="row">
                <span class="col-12 col-md-6"><strong><i class="fa-solid fa-layer-group"></i> Category:</strong> <?php echo htmlspecialchars($data['category']['title'] ?? 'N/A'); ?></span>
                <span class="col-12 col-md-6"><strong><i class="fa-solid fa-battery-three-quarters"></i> Status:</strong> <?php echo htmlspecialchars($data['task']['status']); ?></span>
            </p>
            <p class="row">
                <span class="col-12 col-md-6"><strong><i class="fa-solid fa-person-circle-question"></i> Priority:</strong> <?php echo htmlspecialchars($data['task']['priority']); ?></span>
                <span class="col-12 col-md-6"><strong><i class="fa-solid fa-hourglass-start"></i> Start Date:</strong> <?php echo htmlspecialchars($data['task']['created_at']); ?></span>
            </p>
            <p class="row">
                <span class="col-12 col-md-6"><strong><i class="fa-solid fa-person-circle-question"></i> Updated:</strong> <?php echo htmlspecialchars($data['task']['updated_at']); ?></span>
                <span class="col-12 col-md-6"><strong><i class="fa-solid fa-hourglass-start"></i> Due Date:</strong> <?php echo htmlspecialchars($data['task']['finish_date']); ?></span>
            </p>
            <p><strong><i class="fa-solid fa-file-prescription"></i> Tags:</strong>
                <?php foreach ($data['tags'] as $tag): ?>
                    <a href="/todo/tasks/by-tag/<?= $tag['id'] ?>" class="tag"><?= htmlspecialchars($tag['title']) ?></a>
                <?php endforeach; ?>
            </p>
            <hr>
            <p><strong><i class="fa-solid fa-file-prescription"></i> Description:</strong> <em><?php echo htmlspecialchars($data['task']['description'] ?? ''); ?></em></p>
            <hr>
            <div class="d-flex justify-content-start action-task">
                <form action="/todo/tasks/update-status" method="post" class="me-2">
                    <input type="hidden" name="status" value="cancelled">
                    <input type="hidden" name="id" value="<?=$data['task']['id']?>">
                    <button type="submit" class="btn <?= $data['task']['status'] == 'cancelled' ? 'btn-warning' : 'btn-secondary' ?>">Cancelled</button>
                </form>
                <form action="/todo/tasks/update-status" method="post" class="me-2">
                    <input type="hidden" name="status" value="new">
                    <input type="hidden" name="id" value="<?=$data['task']['id']?>">
                    <button type="submit" class="btn <?= $data['task']['status'] == 'new' ? 'btn-warning' : 'btn-secondary' ?>">New</button>
                </form>
                <form action="/todo/tasks/update-status" method="post" class="me-2">
                    <input type="hidden" name="status" value="in_progress">
                    <input type="hidden" name="id" value="<?=$data['task']['id']?>">
                    <button type="submit" class="btn <?= $data['task']['status'] == 'in_progress' ? 'btn-warning' : 'btn-secondary' ?>">In progress</button>
                </form>
                <form action="/todo/tasks/update-status" method="post" class="me-2">
                    <input type="hidden" name="status" value="on_hold">
                    <input type="hidden" name="id" value="<?=$data['task']['id']?>">
                    <button type="submit" class="btn <?= $data['task']['status'] == 'on_hold' ? 'btn-warning' : 'btn-secondary' ?>">On hold</button>
                </form>
                <form action="/todo/tasks/update-status" method="post" class="me-2">
                    <input type="hidden" name="status" value="completed">
                    <input type="hidden" name="id" value="<?=$data['task']['id']?>">
                    <button type="submit" class="btn <?= $data['task']['status'] == 'completed' ? 'btn-warning' : 'btn-secondary' ?>">Completed</button>
                </form>
                <a href="/todo/tasks/edit/<?=$data['task']['id']?>" class="btn btn-primary me-2">Edit</a>

            </div>
        </div>
    </div>

<?php $content = ob_get_clean();

require_once 'views/layouts/layout.php';
?>