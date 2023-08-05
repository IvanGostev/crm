<?php

$titlePage = 'Create User';

ob_start(); ?>
        <form method="POST" action="/users/store">
            <div class="mb-3">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="email">Email address</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password">Password</label>
                <input type="text" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password">Confirm password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
<?php $content = ob_get_clean();
require_once "views/layouts/layout.php";

