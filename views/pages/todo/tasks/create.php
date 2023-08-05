<?php

$titlePage = 'Create task';

ob_start(); ?>
    <form method="POST" action="/todo/tasks/store">
        <div class="row">
            <!-- Title field -->
            <div class="mb-3 col-12 col-md-12">
                <label for="title" class="form-label">Заголовок</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
        </div>
        <div class="row">
            <!-- Category field -->
            <div class="col-12 col-md-6 mb-3">
                <label for="category_id">Категория</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <?php foreach ($data as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Finish date field -->
            <div class="col-12 col-md-6 mb-3">
                <label for="finish_date">Дата окончания</label>
                <input type="text" class="form-control" id="finish_date" name="finish_date" placeholder="Select date and hour">
            </div>
        </div>
        <input type="text" hidden="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?? 0 ?>">
        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>

<?php $content = ob_get_clean();
require_once "views/layouts/layout.php";

