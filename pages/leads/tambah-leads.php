<?php
require "../../webservices/connection.php";
include "../../constant/Constant.php";

$queryGetAllSales = "SELECT * FROM sales";
$getAllSales = $conn->query($queryGetAllSales);
$sales = [];
while ($row = $getAllSales->fetch_assoc()) {
    $sales[] = $row;
}

$queryGetAllProduk = "SELECT * FROM produk";
$getAllProduk = $conn->query($queryGetAllProduk);
$produk = [];
while ($row = $getAllProduk->fetch_assoc()) {
    $produk[] = $row;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST['tanggal'];
    $id_sales = $_POST['sales'];
    $nama_leads = $_POST['namaLeads'];
    $id_produk = $_POST['produk'];
    $no_whatsapp = $_POST['noWhatsapp'];
    $kota = $_POST['kota'];
    $userId = 1;

    $stmt = $conn->prepare("INSERT INTO leads (tanggal, id_sales, id_produk, no_wa, nama_lead, kota, id_user) VALUES (?, ?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("siisssi", $tanggal, $id_sales, $id_produk, $no_whatsapp, $nama_leads, $kota, $userId);

        if ($stmt->execute()) {
            $_SESSION["success"] = "Data berhasil disimpan";
        } else {
            $_SESSION["error"] = "Data gagal disimpan";
        }

        $stmt->close();
    } else {
        $_SESSION["error"] = "Data gagal disimpan";
    }

    header("Location: $baseURL/pages/leads/leads.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leads App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php
            include "../../partials/sidebar.php";
            ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex align-items-center py-3 border-bottom">
                    <h5 class="mb-0">Selamat datang di Tambah Leads</h5>
                </div>

                <div class="pt-3">
                    <a class="btn btn-primary mb-3" href="<?= "$baseURL/pages/leads/leads.php" ?>" role="
                        button">Kembali</a>
                    <form method="post">
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                            <div class="col-4">
                                <label for="sales">Sales</label>
                                <select class="form-select form-select" name="sales" id="sales" required>
                                    <option selected value="">Pilih sales</option>
                                    <?php
                                    foreach ($sales as $row):
                                        ?>
                                        <option value="<?= $row['id_sales'] ?>"><?= $row["nama_sales"] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="nama-leads">Nama Leads</label>
                                <input type="text" class="form-control" id="nama-leads" placeholder="Nama Leads"
                                    name="namaLeads">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="produk">Produk</label>
                                <select class="form-select form-select" name="produk" id="produk" required>
                                    <option selected value="">Pilih Produk</option>
                                    <?php
                                    foreach ($produk as $row):
                                        ?>
                                        <option value="<?= $row['id_produk'] ?>"><?= $row["nama_produk"] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="no-whatsapp">No. Whatsapp</label>
                                <input type="number" class="form-control" id="no-whatsapp" placeholder="No. Whatsapp"
                                    name="noWhatsapp">
                            </div>
                            <div class="col-4">
                                <label for="kota">Kota</label>
                                <input type="text" class="form-control" name="kota" id="kota" placeholder="Pilih Kota">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center gap-3">
                            <button type="submit" class="btn btn-primary col-auto">
                                Simpan
                            </button>
                            <button type="reset" class="btn btn-secondary col-auto">
                                Cancel
                            </button>
                        </div>

                    </form>
                </div>
            </main>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
    crossorigin="anonymous"></script>

</html>