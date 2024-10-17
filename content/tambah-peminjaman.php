<?php
$books = mysqli_query($connection, "SELECT * FROM buku ORDER BY id DESC");

//hapus data buku
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $queryHapus = mysqli_query($connection, "DELETE FROM buku WHERE id='$id'");
    header('location: ?pg=book&hapusberhasil');
}


if (isset($_GET['detail'])) {
    $id = $_GET['detail'];
    $queryPeminjam = mysqli_query($connection, "SELECT anggota.nama_anggota,peminjaman.* FROM peminjaman LEFT JOIN anggota ON anggota.id = peminjaman.id_anggota WHERE peminjaman.id = '$id'");
    $rowPeminjam = mysqli_fetch_assoc($queryPeminjam);
}
// print_r($rowPeminjam);
// die;
if (isset($_POST['simpan'])) {
    // print_r($_POST);
    // die;
    $no_peminjam = $_POST['no_peminjam'];
    $id_anggota = $_POST['id_anggota'];
    $tgl_peminjaman = $_POST['tgl_peminjaman'];
    $tgl_pengembalian = $_POST['tgl_pengembalian'];
    $id_buku = $_POST['id_buku'];

    $insert = mysqli_query($connection, "INSERT INTO peminjaman (no_peminjam,id_anggota,tgl_peminjaman,tgl_pengembalian) VALUES ('$no_peminjam','$id_anggota','$tgl_peminjaman','$tgl_pengembalian')");
    $id_peminjam = mysqli_insert_id($connection);

    foreach ($id_buku as $key => $buku) {
        $id_buku = $_POST['id_buku'][$key];

        $insertDetail = mysqli_query($connection, "INSERT INTO detail_peminjaman (id_peminjaman, id_buku) VALUES ('$id_peminjam','$id_buku')");
    }

    header('location: ?pg=peminjaman&tambah=berhasil');
}

$queryBuku = mysqli_query($connection, "SELECT * FROM buku");
$queryAnggota = mysqli_query($connection, "SELECT * FROM anggota");
$queryKodePnjm = mysqli_query($connection, "SELECT MAX(id) as id_pinjam FROM peminjaman");
$rowPeminjaman = mysqli_fetch_assoc($queryKodePnjm);
$id_pinjam = $rowPeminjaman['id_pinjam'];
$id_pinjam++;

$kode_pinjam = "PJM/" . date('dmy') . "/" . sprintf("%03s", $id_pinjam);

$queryDetailPinjam = mysqli_query($connection, "SELECT buku.judul_buku, detail_peminjaman.* FROM detail_peminjaman LEFT JOIN buku ON buku.id = detail_peminjaman.id_buku WHERE id_peminjaman ='$id'");


?>
<div class="container">
    <div class="row">
        <div class="col-sm-8 mx-auto">
            <div class="card p-5 mt-5 mx-5 shadow-lg">
                <fieldset class="border border-black border-2 p-3 shadow">
                    <legend class="float-none w-auto px-3"><?php echo isset($_GET['detail']) ? 'Detail' : 'Tambah' ?> Buku
                    </legend>
                    <form action="" method="post">
                        <div class="mb-3 row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="">No Peminjaman</label>
                                    <input type="text"
                                        class="form-control"
                                        name="no_peminjam"
                                        value="<?php echo isset($_GET['detail']) ? $rowPeminjam['no_peminjam'] : $kode_pinjam ?>"
                                        readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="">Tanggal Peminjaman</label>
                                    <input required type="date"
                                        class="form-control"
                                        name="tgl_peminjaman"
                                        value="<?php echo isset($_GET['detail']) ? $rowPeminjam['tgl_peminjaman'] : '' ?>" readonly>
                                </div>
                                <?php if (empty($_GET['detail'])): ?>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Nama Buku</label>
                                        <select require name="" id="id_buku"
                                            class="form-control">
                                            <option value="">Pilih Buku</option>
                                            <!-- ambil data buku dari table buku -->
                                            <?php while ($rowBuku = mysqli_fetch_assoc($queryBuku)): ?>
                                                <option value="<?php echo $rowBuku['id'] ?>">
                                                    <?php echo $rowBuku['judul_buku']; ?>
                                                </option>

                                            <?php endwhile ?>
                                        </select>
                                    </div>
                                <?php endif ?>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">Nama Anggota</label>
                                    <?php if (!isset($_GET['detail'])): ?>
                                        <select require name="id_anggota" id="id_anggota"
                                            class="form-control">
                                            <option value="">Pilih Anggota</option>
                                            <!-- ambil data buku dari table buku -->
                                            <?php while ($rowAnggota = mysqli_fetch_assoc($queryAnggota)): ?>
                                                <option value="<?php echo $rowAnggota['id'] ?>">
                                                    <?php echo $rowAnggota['nama_anggota'] ?>
                                                </option>
                                            <?php endwhile ?>
                                        </select>
                                    <?php else : ?>
                                        <input type="text" class="form-control" readonly value="<?php echo $rowPeminjam['nama_anggota'] ?>">
                                    <?php endif  ?>
                                </div>
                                <div class="mb-3">
                                    <label for="">Tanggal Pengembalian</label>
                                    <input required type="date"
                                        class="form-control"
                                        name="tgl_pengembalian"
                                        value="<?php echo isset($_GET['detail']) ? $rowPeminjam['tgl_pengembalian'] : '' ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <?php if (empty($_GET['detail'])): ?>
                            <div align="right" class="mb-3">
                                <button type="button" id="add-row" class="btn btn-primary">Tambah Row</button>
                            </div>
                        <?php endif ?>
                        <!-- table data dari query dengan php -->
                        <?php if (!empty($_GET['detail'])): ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Buku</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    while ($rowDetailPeminjaman = mysqli_fetch_assoc($queryDetailPinjam)): ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $rowDetailPeminjaman['judul_buku'] ?></td>
                                        </tr>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <table id="table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Buku</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-row">
                                </tbody>
                            </table>
                            <div class="mt-3">
                                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                            </div>
                        <?php endif ?>
                        <!-- ini table dari js -->
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
</div>