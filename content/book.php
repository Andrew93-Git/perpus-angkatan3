<?php
$books = mysqli_query($connection, "SELECT kategori.nama_kategori,buku.* FROM buku  LEFT JOIN kategori ON kategori.id = buku.id_kategori ORDER BY id DESC");

if (isset($_POST['tambah'])) {
    $judulBuku = $_POST['judul_buku'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $id_kategori = $_POST['id_kategori'];

    $queryTambah = mysqli_query($connection, "INSERT INTO buku (judul_buku, pengarang, penerbit, tahun_terbit, id_kategori)
     VALUES('$judulBuku', '$pengarang', '$penerbit', '$tahun_terbit','$id_kategori')");

    if (!$queryTambah) {
        echo "Gagal menambahkan data";
    } else {
        header('location: ?pg=book');
    }
}


$queryKategori = mysqli_query($connection, "SELECT * FROM kategori");


?>

<div class="card p-5 mt-5 mx-5 shadow-lg">
    <div class="card-header">
        <h5 class="card-title">Tambah Buku</h5>
    </div>
    <div class="button-card mt-5 ">
        <a href="?pg=tambah-buku" type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah</a>
    </div>
    <div class="table-buku mt-5">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Kategori</th>
                    <th scope="col">Judul Buku</th>
                    <th scope="col">Pengarang</th>
                    <th scope="col">Penerbit</th>
                    <th scope="col">Tahun Terbit</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($rowBuku = mysqli_fetch_assoc($books)) :
                ?>
                    <tr>
                        <th scope="row"><?php echo $no++ ?></th>
                        <td><?php echo $rowBuku['nama_kategori'] ?></td>
                        <td><?php echo $rowBuku['judul_buku'] ?></td>
                        <td><?php echo $rowBuku['pengarang'] ?></td>
                        <td><?php echo $rowBuku['penerbit'] ?></td>
                        <td><?php echo $rowBuku['tahun_terbit'] ?></td>
                        <td>
                            <div class="btn-setting  gap-3">
                                <a href="?pg=tambah-buku&hapus=<?php echo $rowBuku['id'] ?>" class="btn btn-danger">Hapus</a>
                                <a href="?pg=tambah-buku&edit=<?php echo $rowBuku['id'] ?>" class="btn btn-warning">Edit</a>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Buku</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Kategori</label>
                        <select name="id_kategori" id="" class="form-control">
                            <option value="">Pilih Kategori</option>
                            <!-- option yang datanya di ambil dari tabel kategori -->
                            <?php while ($rowKategori = mysqli_fetch_assoc($queryKategori)): ?>
                                <option value="<?php echo $rowKategori['id'] ?>"> <?php echo $rowKategori['nama_kategori'] ?></option>
                            <?php endwhile ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Judul Buku</label>
                        <input type="text" class="form-control" name="judul_buku" value="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Pengarang</label>
                        <input type="text" class="form-control" name="pengarang" value="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" name="penerbit" value="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Tahun Terbit</label>
                        <input type="text" class="form-control" name="tahun_terbit" value="">
                    </div>
                    <button type="submit" name="<?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?>" class="btn btn-primary"><?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?></button>
                </form>
            </div>
        </div>
    </div>
</div>