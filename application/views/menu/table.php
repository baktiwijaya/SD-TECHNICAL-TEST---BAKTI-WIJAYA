<table class="table table-hover" id="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Menu</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($menu as $m) : ?>
        <tr>
            <th scope="row"><?= $i; ?></th>
            <td><?= $m['menu']; ?></td>
            <td>
                <a href="" class="badge badge-success">Edit</a>
                <a href="" class="badge badge-danger">Delete</a>
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