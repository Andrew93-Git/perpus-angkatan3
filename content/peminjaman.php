<?php
$query = mysqli_query($connection, "SELECT anggota.nama_anggota, peminjaman.* FROM peminjaman  LEFT JOIN anggota ON anggota.id = peminjaman.id_anggota ORDER BY id DESC");
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
        <h5 class="card-title">Data Peminjaman</h5>
    </div>
    <div class="button-card mt-5 ">
        <a href="?pg=tambah-peminjaman" class="btn btn-primary">Tambah</a>
    </div>
    <div class="table-peminjaman mt-5">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Anggota</th>
                    <th scope="col">No Peminjaman</th>
                    <th scope="col">Tanggal Peminjaman</th>
                    <th scope="col">Tanggal Pengembalian</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($query)) :
                ?>
                    <tr>
                        <th scope="row"><?php echo $no++ ?></th>
                        <td><?php echo $row['nama_anggota'] ?></td>
                        <td><?php echo $row['no_peminjam'] ?></td>
                        <td><?php echo $row['tgl_peminjaman'] ?></td>
                        <td><?php echo $row['tgl_pengembalian'] ?></td>
                        <td><?php echo $row['status'] ?></td>
                        <td>
                            <div class="btn-setting  gap-3">
                                <a href="?pg=tambah&hapus=<?php echo $row['id'] ?>" class="btn btn-danger">Hapus</a>
                                <a href="?pg=tambah-peminjaman&detail=<?php echo $row['id'] ?>" class="btn btn-warning">Detail</a>
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