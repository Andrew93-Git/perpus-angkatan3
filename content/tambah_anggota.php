<?php
$anggota = mysqli_query($connection, "SELECT * FROM anggota ORDER BY id DESC");

//hapus data buku
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $queryHapus = mysqli_query($connection, "DELETE FROM anggota WHERE id='$id'");
    header('location: ?pg=anggota&hapusberhasil');
}

// get data update buku
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $queryDataEdit = mysqli_query($connection, "SELECT * FROM anggota WHERE id='$id'");
    $dataEdit = mysqli_fetch_assoc($queryDataEdit);
}

if (isset($_POST['edit'])) {
    $id = $_GET['edit'];
    $nama_anggota = $_POST['nama_anggota'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    $queryEditData = mysqli_query($connection, "UPDATE anggota SET nama_anggota='$nama_anggota', telepon='$telepon', email='$email', alamat='$alamat' WHERE id='$id'");
    header('location: ?pg=anggota');
}

$queryAnggota = mysqli_query($connection, "SELECT * FROM anggota");


?>
<div class="container">
    <div class="row">
        <div class="col-sm-8 mx-auto">
            <div class="card p-5 mt-5 mx-5 shadow-lg">
                <fieldset class="border border-black border-2 p-3 shadow">
                    <legend class="float-none w-auto px-3">
                        <?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?>Anggota
                    </legend>
                    <form method="post">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Anggota</label>
                            <input type="text" class="form-control" name="nama_anggota" value="<?php echo isset($_GET['edit']) ? $dataEdit['nama_anggota'] : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Telepon</label>
                            <input type="text" class="form-control" name="telepon" value="<?php echo isset($_GET['edit']) ? $dataEdit['telepon'] : '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" value="<?php echo isset($_GET['edit']) ? $dataEdit['email'] : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="<?php echo isset($_GET['edit']) ? $dataEdit['alamat'] : '' ?>">
                        </div>
                        <button type="submit" name="<?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?>" class="btn btn-primary"><?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?></button>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
</div>