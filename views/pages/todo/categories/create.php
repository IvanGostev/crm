<?php

$titlePage = 'Create Category';
$items = ['/todo/categories/create' => 'Create Category'];
ob_start(); ?>
    <form method="POST" action="/todo/categories/store">
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>
        <input type="text" hidden="hidden" name="userId" value="<?= $_SESSION['user_id'] ?? 0 ?>">
            <br>
            <button type="submit" class="btn btn-primary">Create</button>
    </form>


<?php $content = ob_get_clean();
require_once "views/layouts/layout.php";

