<?php
$titlePage = 'Edit User';
ob_start();
?>
    <h1>Edit User</h1>
    <form method="POST" action="/users/update">
        <div class="mb-3">
            <label for="username" class="form-label">Login</label>
            <input type="text" class="form-control" id="username" name="username" required value="<?=($data['user'])['username']?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" required value="<?=($data['user'])['email']?>">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-control">
                <?php foreach($data['roles'] as $role) : ?>
                <option value="<?=$role['id']?>" <?= ($data['user'])['role'] == $role['id']  ? 'selected' : ''?>> <?=$role['name'] ?></option>
                <?php endforeach?>
            </select>
        </div>
            <input type="text" name="id" value="<?=($data['user'])['id']?>" hidden="hidden">
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
<?php $content = ob_get_clean();
require_once 'views/layouts/layout.php';
