<?php
$books = mysqli_query($connection, "SELECT * FROM buku ORDER BY id DESC");

//hapus data buku
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $queryHapus = mysqli_query($connection, "DELETE FROM buku WHERE id='$id'");
    header('location: ?pg=book&hapusberhasil');
}

// get data update buku
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $queryDataEdit = mysqli_query($connection, "SELECT * FROM buku WHERE id='$id'");
    $dataEdit = mysqli_fetch_assoc($queryDataEdit);
}

if (isset($_POST['edit'])) {
    $id = $_GET['edit'];
    $judulBuku = $_POST['judul_buku'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $id_kategori = $_POST['id_kategori'];

    $queryEditData = mysqli_query($connection, "UPDATE buku SET judul_buku='$judulBuku', pengarang='$pengarang', penerbit='$penerbit', tahun_Terbit='$tahun_terbit', id_kategori='$id_kategori' WHERE id='$id'");
    header('location: ?pg=book');
}

$queryKategori = mysqli_query($connection, "SELECT * FROM kategori");


?>
<div class="container">
    <div class="row">
        <div class="col-sm-8 mx-auto">
            <div class="card p-5 mt-5 mx-5 shadow-lg">
                <fieldset class="border border-black border-2 p-3 shadow">
                    <legend class="float-none w-auto px-3">
                        <?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Buku
                    </legend>
                    <form method="post">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" name="judul_buku" value="<?php echo isset($_GET['edit']) ? $dataEdit['judul_buku'] : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Kategori</label>
                            <select name="id_kategori" id="" class="form-control">
                                <option value="">Pilih Kategori</option>
                                <!-- option yang datanya di ambil dari tabel kategori -->
                                <?php while ($rowKategori = mysqli_fetch_assoc($queryKategori)): ?>
                                    <option <?php echo isset($_GET['edit']) ? ($rowKategori['id'] == $dataEdit['id_kategori'] ? 'selected' : '') : '' ?> value="<?php echo $rowKategori['id'] ?>"> <?php echo $rowKategori['nama_kategori'] ?></option>
                                <?php endwhile ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Pengarang</label>
                            <input type="text" class="form-control" name="pengarang" value="<?php echo isset($_GET['edit']) ? $dataEdit['pengarang'] : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Penerbit</label>
                            <input type="text" class="form-control" name="penerbit" value="<?php echo isset($_GET['edit']) ? $dataEdit['penerbit'] : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tahun Terbit</label>
                            <input type="text" class="form-control" name="tahun_terbit" value="<?php echo isset($_GET['edit']) ? $dataEdit['tahun_terbit'] : '' ?>">
                        </div>
                        <button type="submit" name="<?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?>" class="btn btn-primary"><?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?></button>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
</div>