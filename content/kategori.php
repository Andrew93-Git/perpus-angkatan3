<?php
$kategori = mysqli_query($connection, "SELECT * FROM kategori ORDER BY id DESC");

if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];
    $jenisKelamin = $_POST['jenis_kelamin'];

    $queryInsert = mysqli_query($connection, "INSERT INTO user (nama, telepon, email, jenis_kelamin) VALUES ('$nama','$telepon', '$email', '$jenisKelamin')");

    if (!$queryInsert) {
        echo "Gagal";
    } else {
        header('location: ?pg=user');
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 mt-5">
            <fieldset class="border border-black border-2 p-3 shadow">
                <div class="btn-action">
                    <a href="?pg=tambah-kategori" class="btn btn-success">Tambah</a>
                </div>
                <legend class="float-none w-auto px-3">
                    Data Kategori
                </legend>
                <div class="table-responsive mt-5">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama kategori</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($rowKategori = mysqli_fetch_assoc($kategori)) :
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no++ ?></th>
                                    <td><?php echo $rowKategori['nama_kategori'] ?></td>
                                    <td>
                                        <div class="btn-setting  gap-3">
                                            <a type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" name="hapus" href="?pg=tambah-kategori&hapus=<?php echo $rowKategori['id'] ?>" class="btn btn-danger">Hapus</a>
                                            <a type="submit" name='edit' href="?pg=tambah-kategori&edit=<?php echo $rowKategori['id'] ?>" class="btn btn-warning">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile ?>
                        </tbody>
                    </table>
                </div>
            </fieldset>
        </div>

        <!-- Modal -->
        <div class="modal fade p-5" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="mb-3 mx-auto">
                                <label for="exampleInputEmail1" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" value="<?php echo isset($_GET['edit']) ? $rowEdit['nama'] : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="telepon" value="<?php echo isset($_GET['edit']) ? $rowEdit['telepon'] : ''  ?>">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo isset($_GET['edit']) ? $rowEdit['email'] : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
                                <br>
                                <input <?php echo isset($_GET['edit']) ? ($rowEdit['jenis_kelamin'] == "laki-laki") ? 'checked' : '' : '' ?> type="radio" name="jenis_kelamin" value="laki-laki"> Laki-laki
                                <br>
                                <input <?php echo isset($_GET['edit']) ? ($rowEdit['jenis_kelamin'] == "Perempuan") ? 'checked' : '' : '' ?> type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan
                            </div>
                            <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>