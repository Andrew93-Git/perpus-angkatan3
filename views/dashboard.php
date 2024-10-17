<?php
session_start();
include '../koneksi.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="../bootstrap-5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="row">
        <div class="col-md">
            <!-- navbar -->
            <?php include '../inc/navbar.php' ?>
            <!-- end of navbar -->
            <div class="content">
                <?php
                if (isset($_GET['pg'])) {
                    if (file_exists('../content/' . $_GET['pg'] . '.php')) {
                        include '../content/' . $_GET['pg'] . '.php';
                    }
                } else {
                    include '../content/dashboard.php';
                }
                ?>
            </div>
            <!-- hero section dasboard -->

            <!-- end of hero section dasboard -->

            <?php include '../inc/footer.php' ?>
        </div>
    </div>

    <script src="../bootstrap-5.3.3/dist//js//bootstrap.bundle.js"></script>
    <script src="app.js"></script>

</body>

</html>