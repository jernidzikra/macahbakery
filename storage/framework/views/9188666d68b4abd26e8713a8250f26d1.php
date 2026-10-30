<div class="row g-3">
    <div class="col-md-8">
        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" value="<?php echo e(old('nama_produk', $produk->nama_produk)); ?>" required>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Kategori</label>
                <input type="text" name="kategori" class="form-control" value="<?php echo e(old('kategori', $produk->kategori)); ?>" placeholder="mis. Bolu, Roti-Kue, Hampers">
            </div>
            <div class="col-md-3">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" step="1" min="0" name="harga_produk" class="form-control" value="<?php echo e(old('harga_produk', $produk->harga_produk ?: 0)); ?>" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Stok</label>
                <input type="number" min="0" name="stok_produk" class="form-control" value="<?php echo e(old('stok_produk', $produk->stok_produk ?: 0)); ?>" required>
            </div>
        </div>

        <div class="mb-3 mt-3">
            <label class="form-label">Jumlah Terjual</label>
            <input type="number" min="0" name="terjual" class="form-control" value="<?php echo e(old('terjual', $produk->terjual ?: 0)); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi Produk</label>
            <textarea name="desk_produk" rows="4" class="form-control"><?php echo e(old('desk_produk', $produk->desk_produk)); ?></textarea>
        </div>
    </div>

    <div class="col-md-4">
        <label class="form-label">Foto Produk</label>
        <div class="mb-2">
            <?php if($produk->exists && $produk->foto_produk && file_exists(public_path($produk->foto_produk))): ?>
                <img src="<?php echo e(asset($produk->foto_produk)); ?>" alt="<?php echo e($produk->nama_produk); ?>" class="img-fluid rounded-3 border" id="preview-img">
            <?php else: ?>
                <div class="border rounded-3 d-flex align-items-center justify-content-center text-muted" style="height:180px;" id="preview-placeholder">
                    <i class="fas fa-image fa-2x"></i>
                </div>
                <img src="" alt="" class="img-fluid rounded-3 border d-none" id="preview-img">
            <?php endif; ?>
        </div>
        <input type="file" name="foto_produk" accept="image/*" class="form-control" onchange="previewFoto(this)">
        <div class="form-text">Format JPG/PNG/WEBP, maksimal 2MB. Kosongkan jika tidak ingin mengubah foto.</div>
    </div>
</div>

<script>
    function previewFoto(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            const img = document.getElementById('preview-img');
            const placeholder = document.getElementById('preview-placeholder');
            reader.onload = function (e) {
                img.src = e.target.result;
                img.classList.remove('d-none');
                if (placeholder) placeholder.classList.add('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?php /**PATH C:\laragon\www\macahbakery\resources\views/admin/products/_form.blade.php ENDPATH**/ ?>