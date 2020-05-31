<form action="<?= base_url('menu/save'); ?>" method="post">
    <div class="form-group">
        <label>Nama Menu</label>
        <input type="text" class="form-control col-md-6" id="menu" name="menu" placeholder="Nama Menu">
    </div>
    
    <div class="form-group">
        <button type="button" class="btn btn-danger" onclick="tampil()">Kembali</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>