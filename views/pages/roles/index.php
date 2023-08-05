<?php

$titlePage = 'Role list';
$items = ['/roles/create' => 'Create Role'];
ob_start();
?>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $role): ?>
            <tr>
                <th scope="row"><?php echo $role['id']; ?> </th>
                <td><?php echo $role['name'] ?></td>
                <td><?php echo $role['description'] ?></td>
                <td><a href="/roles/edit/<?= $role['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a></td>
                <td>
                    <form method="POST" action="/roles/delete" class="d-inline-block">
                        <input type="text" hidden="hidden" name="id" value="<?= $role['id'] ?>">
                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Are you sure?')">Delete
                        </button>
                    </form>
                </td>

            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
<?php $content = ob_get_clean();
require_once 'views/layouts/layout.php';