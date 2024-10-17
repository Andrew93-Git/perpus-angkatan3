<?php
include '../koneksi.php';

if (isset($_POST['tambah'])) {
    $nama_kategori = $_POST['nama_kategori'];


    $queryInsert = mysqli_query($connection, "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')");

    if (!$queryInsert) {
        echo "Gagal";
    } else {
        header('location: ?pg=kategori');
    }
} // query untuk insert data

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $queryHapus = mysqli_query($connection, "DELETE FROM kategori WHERE id='$id'");
    header('location: ?pg=kategori&hapus=berhasil');
} // query untuk delete

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $queryEdit = mysqli_query($connection, "SELECT * FROM kategori WHERE id='$id'");
    $rowEdit = mysqli_fetch_assoc($queryEdit);
} // query untuk get data edit

if (isset($_POST['edit'])) {
    $id = $_GET['edit'];
    $nama_kategori = $_POST['nama_kategori'];

    $queryEdit = mysqli_query($connection, "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id='$id'");
    header('location: ?pg=kategori');
} //query untuk post edit
?>

<div class="container">
    <div class="row">
        <div class="col-sm-6 mt-5 mx-auto">
            <fieldset class="border border-black border-2 p-3 shadow">
                <legend class="float-none w-auto px-3">
                    <?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah ' ?> Kategori
                </legend>
                <form method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" name="nama_kategori" placeholder="Masukan nama kategori" value="<?php echo isset($_GET['edit']) ? $rowEdit['nama_kategori'] : '' ?>">
                    </div>

                    <button type="submit" name="<?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?>" class="btn btn-primary"><?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?></button>
                </form>
            </fieldset>
        </div>

    </div>
</div>