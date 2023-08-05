<?php

$titlePage = 'Create Role';
$items = ['/roles/create' => 'Create Role'];
ob_start(); ?>
    <h1>Create Role</h1>
    <form method="POST" action="/roles/store">
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Create</button>
    </form>


<?php $content = ob_get_clean();
require_once "views/layouts/layout.php";

