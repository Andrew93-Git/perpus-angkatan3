<?php
include '../koneksi.php';

if (isset($_POST['tambah'])) {
    $level = $_POST['level'];


    $queryInsert = mysqli_query($connection, "INSERT INTO kategori (nama_level) VALUES ('$level')");

    if (!$queryInsert) {
        echo "Gagal";
    } else {
        header('location: ?pg=level');
    }
} // query untuk insert data

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $queryHapus = mysqli_query($connection, "DELETE FROM level WHERE id='$id'");
    header('location: ?pg=level&hapus=berhasil');
} // query untuk delete

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $queryEdit = mysqli_query($connection, "SELECT * FROM level WHERE id='$id'");
    $rowEdit = mysqli_fetch_assoc($queryEdit);
} // query untuk get data edit

if (isset($_POST['edit'])) {
    $id = $_GET['edit'];
    $nama_level = $_POST['nama_level'];

    $queryEdit = mysqli_query($connection, "UPDATE level SET nama_level='$nama_level' WHERE id='$id'");
    header('location: ?pg=level');
}
?>

<div class="container">
    <div class="row">
        <div class="col-sm-6 mt-5 mx-auto">
            <fieldset class="border border-black border-2 p-3 shadow">
                <legend class="float-none w-auto px-3">
                    <?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah ' ?> level
                </legend>
                <form method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Level</label>
                        <input type="text" class="form-control" name="nama_level" placeholder="Masukan nama level" value="<?php echo isset($_GET['edit']) ? $rowEdit['nama_level'] : '' ?>">
                       
                    </div>

                    <button type="submit" name="<?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?>" class="btn btn-primary"><?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?>
                </button>
                </form>
            </fieldset>
        </div>

    </div>
</div>