<?php

$titlePage = 'Page list';
$items = ['/pages/create' => 'Create Page'];
ob_start();
?>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Roles</th>
            <th scope="col">Slug</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $page): ?>
            <tr>
                <th scope="row"><?php echo $page['id']; ?> </th>
                <td><?php echo $page['title'] ?></td>
                <td><?php echo $page['roles'] ?></td>
                <td><?php echo $page['slug'] ?></td>
                <td>
                    <a href="/pages/edit/<?=$page['id']?>" class="btn btn-sm btn-outline-primary">Edit</a>
                    <form method="POST" action="/pages/delete" class="d-inline-block">
                        <input type="text" hidden="hidden" name="id" value="<?=$page['id']?>">
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
<?php $content = ob_get_clean();
require_once 'views/layouts/layout.php';