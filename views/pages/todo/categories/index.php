<?php

$titlePage= 'Category list';
ob_start();
?>


    <div class="col-12">
    <div class="card">
    <div class="card-header">
        <a href="/todo/categories/create" class="btn btn-sm btn-outline-success">Create Role</a>

        <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Usability</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $category): ?>
            <tr>
                <th scope="row"><?=$category['id']; ?> </th>
                <td><?=$category['title'] ?></td>
                <td><?=$category['description'] ?></td>
                <td><?=($category['usability']) === 1? 'Yes' : 'No'?></td>
                <td>
                    <a href="/todo/categories/edit/<?=$category['id']?>"  class="btn btn-sm btn-outline-primary">Edit</a>
                    <form method="POST" action="todo/categories/delete" class="d-inline-block">
                        <input type="text" hidden="hidden" name="id" value="<?=$category['id']?>">
                         <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
<?php $content = ob_get_clean();
require_once 'views/layouts/layout.php';