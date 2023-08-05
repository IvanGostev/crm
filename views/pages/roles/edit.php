<?php
$titlePage = 'Edit role';
$items = ['/roles/create' => 'Create Role'];
ob_start();
?>
    <h1>Edit role</h1>
    <form method="POST" action="/roles/update">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required value="<?=$data['name']?>">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" required value="<?=$data['description']?>">
        </div>
        <input type="text" name="id" value="<?=$data['id']?>" hidden="hidden">
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
<?php $content = ob_get_clean();
require_once 'views/layouts/layout.php';
