<?php
$titlePage = 'Edit category';
$items = ['odo/categories/create' => 'Create Category'];
ob_start();
?>
    <form method="POST" action="/todo/categories/update">
        <div class="mb-3">
            <label for="title" class="form-label">Name</label>
            <input type="text" class="form-control" id="title" name="title" required value="<?=$data['title']?>">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" required value="<?=$data['description']?>">
        </div>
        <div class="mb-3">
            <input type="checkbox" id="usability" name="usability" <?=$data['usability'] != 0 ? 'checked' : ''?>>
            <label for="usability">Usability</label>
        </div>
        <input type="text" name="id" value="<?=$data['id']?>" hidden="hidden">

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
<?php $content = ob_get_clean();
require_once 'views/layouts/layout.php';
