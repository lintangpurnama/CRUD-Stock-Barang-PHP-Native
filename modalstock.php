<?php
?>
<!-- button edit -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit">
    <i class="fas fa-edit"></i>
</button>

<!-- Modal Edit -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-dark"><strong>Edit Stock</strong> </h4>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <label>Nama Barang</label>
                    <input class="form-control" value="<?= $namabarang; ?>" name="namabarang" type="text" required>

                    <label for="">Deskripsi Barang</label>
                    <input class="form-control" value="<?= $deskripsi; ?>" name="deskripsi" type="text" required>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="edit" name="addnewbarang" class="btn btn-primary">Edit</button>
            </form>
        </div>


    </div>
</div>
</div>
</div>






<!-- MODAL HAPUS -->
<!-- BUTTON HAPUS -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus">
    <i class="fas fa-trash"></i>
</button>
<!-- Modal hapus -->
<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-dark text-center "><strong>Apakah Anda Ingin Menghapus <?= $namabarang; ?>?</strong> </h4>
            </div>
            <form method="POST">

                <div class="modal-footer">
                    <button type="submit" name="hapusbarang" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </form>
        </div>


    </div>
</div>
</div>
</div>




<!-- Modal tambah stock -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-dark"><strong>Tambah Barang</strong> </h4>
                <!-- tombol x  -->
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
            </div>
            <form method="POST">
                <div class="modal-body">
                    <label>Nama Barang</label>
                    <input class="form-control " name="namabarang" type="text" required>

                    <label for="">Deskripsi Barang</label>
                    <input class="form-control " name="deskripsi" type="text" required>

                    <label for="">Stock</label>
                    <input class="form-control " name="stock" type="number">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="addnewbarang" class="btn btn-primary">Submit</button>
            </form>
        </div>


    </div>
</div>
</div>
</div>