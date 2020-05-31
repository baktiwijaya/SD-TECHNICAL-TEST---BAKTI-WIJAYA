<form action="<?= base_url('menu/save_submenu'); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <input type="text" class="form-control col-md-6" id="title" name="title" placeholder="Submenu title">
        </div>
        <div class="form-group">
            <select name="menu_id" id="menu_id" class="form-control col-md-6">
                <option value="">Select Menu</option>
                <?php foreach ($menu as $m) : ?>
                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <input type="text" class="form-control col-md-6" id="url" name="url" placeholder="Submenu url">
        </div>
        <div class="form-group">
            <input type="text" class="form-control col-md-6" id="icon" name="icon" placeholder="Submenu icon">
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                <label class="form-check-label" for="is_active">
                    Active ?
                </label>
            </div>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-danger" onclick="tampil()">Kembali</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
    </div>
    
</form>