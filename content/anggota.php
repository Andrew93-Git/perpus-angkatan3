<?php
$anggota = mysqli_query($connection, "SELECT * FROM anggota   ORDER BY id DESC");

if (isset($_POST['tambah'])) {
    $nama_anggota = $_POST['nama_anggota'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    $queryTambah = mysqli_query($connection, "INSERT INTO anggota (nama_anggota, telepon, email, alamat)
     VALUES('$nama_anggota', '$telepon', '$email', '$alamat')");

    if (!$queryTambah) {
        echo "Gagal menambahkan data";
    } else {
        header('location:?pg=anggota');
    }
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $queryEdit = mysqli_query($connection, "SELECT * FROM anggota WHERE id='$id'");
    $rowEdit = mysqli_fetch_assoc($queryEdit);
} // query untuk get data edit

if (isset($_GET['edit'])) {
    $nama_anggota = $_POST['nama_anggota'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    $queryEdit = mysqli_query($connection, "UPDATE anggota SET nama_anggota='$nama_anggota', telepon='$telepon', email='$email', alamat='$alamat' WHERE id='$id'");
    header('location: ?pg=anggota');
} //query untuk post edit



$queryAnggota = mysqli_query($connection, "SELECT * FROM anggota");


?>

<div class="card p-5 mt-5 mx-5 shadow-lg">
    <div class="card-header">
        <h5 class="card-title">Anggota</h5>
    </div>
    <div class="button-card mt-5 ">
        <a href="?pg=tambah-anggota" type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah</a>
    </div>
    <div class="table-anggota mt-5">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Anggota</th>
                    <th scope="col">Telepon</th>
                    <th scope="col">Email</th>
                    <th scope="col">alamat</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($rowAnggota = mysqli_fetch_assoc($anggota)) :
                ?>
                    <tr>
                        <th scope="row"><?php echo $no++ ?></th>
                        <td><?php echo $rowAnggota['nama_anggota'] ?></td>
                        <td><?php echo $rowAnggota['telepon'] ?></td>
                        <td><?php echo $rowAnggota['email'] ?></td>
                        <td><?php echo $rowAnggota['alamat'] ?></td>
                        <td>
                            <div class="btn-setting  gap-3">
                                <a type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" name="hapus" href="?pg=nama_anggota&hapus=<?php echo $rowAnggota['id'] ?>" class="btn btn-danger">Hapus</a>
                                <a type="submit" name='edit' href="?pg=tambah_anggota&edit=<?php echo $rowAnggota['id'] ?>" class="btn btn-warning">Edit</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade p-5" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Anggota</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="mb-3 mx-auto">
                        <label for="exampleInputEmail1" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama_anggota" value="<?php echo isset($_GET['edit']) ? $rowEdit['nama_anggota'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Telepon</label>
                        <input type="text" class="form-control" name="telepon" value="<?php echo isset($_GET['edit']) ? $rowEdit['telepon'] : ''  ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo isset($_GET['edit']) ? $rowEdit['email'] : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="<?php echo isset($_GET['edit']) ? $rowEdit['alamat'] : '' ?>">
                    </div>
                    <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>