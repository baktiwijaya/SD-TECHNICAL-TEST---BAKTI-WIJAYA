<table class="table table-hover" id="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Menu</th>
            <th scope="col">Url</th>
            <th scope="col">Icon</th>
            <th scope="col">Active</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($subMenu as $sm) : ?>
        <tr>
            <th scope="row"><?= $i; ?></th>
            <td><?= $sm['title']; ?></td>
            <td><?= $sm['menu']; ?></td>
            <td><?= $sm['url']; ?></td>
            <td><?= $sm['icon']; ?></td>
            <td><?= $sm['is_active']; ?></td>
            <td>
                <a href="" class="badge badge-success">edit</a>
                <a href="" class="badge badge-danger">delete</a>
            </td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable();
    })
</script>