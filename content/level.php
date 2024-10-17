<?php
$level = mysqli_query($connection, "SELECT * FROM level ORDER BY id DESC");

if (isset($_POST['tambah'])) {
    $nama_level = $_POST['nama_level'];


    $queryTambah = mysqli_query($connection, "INSERT INTO level (nama_level) VALUES('$nama_level')");

    if (!$queryTambah) {
        echo "Gagal menambahkan data";
    } else {
        header('location: ?pg=level');
    }
}

?>

<div class="card p-5 mt-5 mx-5 shadow-lg">
    <div class="card-header">
        <h5 class="card-title">Tambah Level</h5>
    </div>
    <div class="button-card mt-5 ">
        <a href="?pg=tambah-level" type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah</a>
    </div>
    <div class="table-buku mt-5">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Level</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($rowLevel = mysqli_fetch_assoc($level)) :
                ?>
                    <tr>
                        <th scope="row"><?php echo $no++ ?></th>
                        <td><?php echo $rowLevel['nama_level'] ?></td>
                        <td>
                            <div class="btn-setting  gap-3">
                                <a href="?pg=tambah-level&hapus=<?php echo $rowLevel['id'] ?>" class="btn btn-danger">Hapus</a>
                                <a href="?pg=tambah-level&edit=<?php echo $rowLevel['id'] ?>" class="btn btn-warning">Edit</a>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Level</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Level</label>
                        <input type="text" class="form-control" name="nama_level" value="">
                    </div>
                    <button type="submit" name="<?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?>" class="btn btn-primary"><?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?></button>
                </form>
            </div>
        </div>
    </div>
</div>