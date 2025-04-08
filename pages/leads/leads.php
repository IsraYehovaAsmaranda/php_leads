<?php
require "../../webservices/connection.php";
include "../../constant/Constant.php";

$queryGetAllLeads = "SELECT * FROM leads";
$getAllLeads = $conn->query("SELECT * FROM leads");
$leads = [];
while ($row = $getAllLeads->fetch_assoc()) {
    $leads[] = $row;
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
                    <h5 class="mb-0">Selamat datang di Leads</h5>
                </div>

                <div class="pt-3">
                    <a class="btn btn-primary mb-3" href="<?= "$baseURL/pages/leads/tambah-leads.php" ?>" role="
                        button">Tambah Leads</a>

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Id Leads</th>
                                <th scope="col">Nama Leads</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($leads) > 0) {
                                $rowNumber = 1;
                                foreach ($leads as $row) {
                                    ?>
                                    <tr>
                                        <td><?= $rowNumber++ ?></td>
                                        <td><?= $row["id_leads"] ?></td>
                                        <td><?= $row["nama_leads"] ?></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada leads</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
    crossorigin="anonymous"></script>

</html>