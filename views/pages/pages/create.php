<?php

$titlePage = 'Create Page';
$items = ['/pages/create' => 'Create Page'];
ob_start(); ?>
    <!--    <h1>Create Page</h1>-->
    <!--    <form method="POST" action="/pages/store">-->
    <!--        <div class="mb-3">-->
    <!--            <label for="title">Title</label>-->
    <!--            <input type="text" class="form-control" id="title" name="title" required>-->
    <!--        </div>-->
    <!--        <div class="mb-3">-->
    <!--            <label for="slug">Slug</label>-->
    <!--            <input type="text" class="form-control" id="slug" name="slug" required>-->
    <!--        </div>-->
    <!--        <div class="mb-3">-->
    <!--            <label for="roles" class="">Roles</label>-->
    <!--            <br>-->
    <!--            --><?php //foreach ($data as $role) : ?>
    <!--                <div class="from-check">-->
    <!--                    <input type="checkbox" class="form-check-input" id="roles" name="roles[]"-->
    <!--                           value="--><?php //=$role['id']?><!--">-->
    <!--                    <label for="roles" class="form-check-label">--><?php //=$role['name']?><!--</label>-->
    <!--                </div>-->
    <!--            --><?php //endforeach ?>
    <!--        </div>-->
    <!---->
    <!--        <button type="submit" class="btn btn-primary">Create</button>-->
    <!--    </form>-->
    <!--    <div class="card card-primary">-->
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="/pages/store">
        <div class="card-body">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" required>
            </div>
            <div class="form-check">
                <?php foreach ($data as $role) : ?>
                    <div class="from-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="roles[]"
                               value="<?= $role['id'] ?>">
                        <label for="exampleCheck1" class="form-check-label"><?= $role['name'] ?></label>
                    </div>
                <?php endforeach ?>
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
    </div>
<?php $content = ob_get_clean();
require_once "views/layouts/layout.php";

