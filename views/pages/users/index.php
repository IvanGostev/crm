<?php

$titlePage = 'User list';

ob_start();
?>



<!--    <table class="table">-->
<!--        <thead>-->
<!--        <tr>-->
<!--            <th scope="col">#</th>-->
<!--            <th scope="col">Username</th>-->
<!--            <th scope="col">Email</th>-->
<!--            <th scope="col">Email verification</th>-->
<!--            <th scope="col">Is admin</th>-->
<!--            <th scope="col">Role</th>-->
<!--            <th scope="col">Is active</th>-->
<!--            <th scope="col">Last login</th>-->
<!--            <th scope="col">Actions</th>-->
<!--        </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--        --><?php //foreach ($users as $user): ?>
<!--            <tr>-->
<!--                <th scope="row">--><?php //echo $user['id']; ?><!-- </th>-->
<!--                <td>--><?php //echo $user['username'] ?><!--</td>-->
<!--                <td>--><?php //echo $user['email'] ?><!--</td>-->
<!--                <td>--><?php //echo $user['email_verification'] ? 'Yes' : 'No'?><!--</td>-->
<!--                <td>--><?php //echo $user['is_admin'] ? 'Yes' : 'No' ?><!--</td>-->
<!--                <td>--><?php //echo $user['role'] ?><!--</td>-->
<!--                <td>--><?php //echo $user['is_active'] ? 'Yes' : 'No'?><!--</td>-->
<!--                <td>--><?php //echo $user['last_login'] ?><!--</td>-->
<!--                <td>-->
<!--                    <a href="/--><?php //= APP_BASE_PATH ?><!--/users/edit/--><?php //echo $user['id'] ?><!--"-->
<!--                       class="btn btn-primary">Edit</a>-->
<!--                    <a href="/--><?php //= APP_BASE_PATH ?><!--/users/delete/--><?php //echo $user['id'] ?><!--" class="btn btn-danger">Delete</a>-->
<!--                </td>-->
<!--            </tr>-->
<!--        --><?php //endforeach ?>
<!--        </tbody>-->
<!--    </table>-->


<div class="col-12">
    <div class="card">
        <div class="card-header">

            <a href="/users/create" class="btn btn-sm btn-outline-success">Create User</a>

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
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Email verification</th>
                    <th>Is admin</th>
                    <th>Role</th>
                    <th>Is active</th>
                    <th>Last login</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data as $user): ?>
                    <tr>
                        <th scope="row"><?php echo $user['id']; ?> </th>
                        <td><?php echo $user['username'] ?></td>
                        <td><?php echo $user['email'] ?></td>
                        <td><?php echo $user['email_verification'] ? 'Yes' : 'No'?></td>
                        <td><?php echo $user['is_admin'] ? 'Yes' : 'No' ?></td>
                        <td><?php echo $user['role'] ?></td>
                        <td><?php echo $user['is_active'] ? 'Yes' : 'No'?></td>
                        <td><?php echo $user['last_login'] ?></td>
                        <td>
                            <a href="/users/edit/<?=$user['id']?>"
                               class="btn btn-sm btn-outline-primary">Edit</a>
                            <form method="POST" action="/users/delete" class="d-inline-block">
                                <input type="text" name="id" hidden="hidden" value="<?=$user['id']?>">
                                 <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Вы уверены?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<?php $content = ob_get_clean();
require_once "views/layouts/layout.php";
?>

