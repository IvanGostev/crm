<?php
$titlePage = 'Edit page';
$items = ['/pages/create' => 'Create Page'];
ob_start();
?>

    <h1>Edit page</h1>
    <form method="POST" action="/pages/update">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required value="<?= ($data['page'])['title'] ?>">
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" required value="<?= ($data['page'])['slug'] ?>">
        </div>
        <div class="mb-3" id="roles-container">
            <label for="roles" class="form-label">Roles</label>
            <?php $selectedRoles = explode(',' , ($data['page'])['roles']);
            foreach (($data['roles']) as $role) : ?>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="roles[]" value="<?php echo $role['id']?>" <?php echo in_array($role['id'], $selectedRoles) ? 'checked' : " "?>>
                <label for="roles" class="form-check-label"><?php echo $role['name']?></label>
            </div>
            <?php endforeach; ?>
        </div>
        <input type="text" name="id" value="<?=($data['page'])['id']?>" hidden="hidden">
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
<?php $content = ob_get_clean();
require_once 'views/layouts/layout.php';
