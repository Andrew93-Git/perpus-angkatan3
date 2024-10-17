<?php
include '../koneksi.php';

if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $jenisKelamin = $_POST['jenis_kelamin'];

    $queryInsert = mysqli_query($connection, "INSERT INTO user (nama, telepon, email, jenis_kelamin) VALUES ('$nama','$telepon', '$email', '$jenisKelamin')");

    if (!$queryInsert) {
        echo "Gagal";
    } else {
        header('location: ?pg=user');
    }
} // query untuk insert data

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $queryHapus = mysqli_query($connection, "DELETE FROM user WHERE id='$id'");
    header('location: ?pg=user');
} // query untuk delete

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $queryEdit = mysqli_query($connection, "SELECT * FROM user WHERE id='$id'");
    $rowEdit = mysqli_fetch_assoc($queryEdit);
} // query untuk get data edit

if (isset($_POST['edit'])) {
    $id = $_GET['edit'];
    $nama = $_POST['nama'];
    $password = ($_POST['password']) ? sha1($_POST['password']) : $rowEdit['password'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];
    $jenisKelamin = $_POST['jenis_kelamin'];

    $queryEdit = mysqli_query($connection, "UPDATE user SET nama='$nama', telepon='$telepon', email='$email', jenis_kelamin='$jenisKelamin', password='$password' WHERE id='$id'");
    header('location: ?pg=user');
} //query untuk post edit
?>

<div class="container">
    <div class="row">
        <div class="col-sm-6 mt-5 mx-auto">
            <fieldset class="border border-black border-2 p-3 shadow">
                <legend class="float-none w-auto px-3">
                    <?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah ' ?> User
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

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>