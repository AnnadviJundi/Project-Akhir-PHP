<?php 
session_start();

if(!isset($_SESSION["signIn"]) ) {
  header("Location: ../../sign/member/sign_in.php");
  exit;
}
require "../../config/config.php";
$akunMember = $_SESSION["member"]["nisn"];
$dataPengembalian = queryReadData("SELECT pengembalian.id_pengembalian, pengembalian.id_buku, buku.judul, buku.kategori, pengembalian.nisn, member.nama, admin.nama_admin, pengembalian.buku_kembali, pengembalian.keterlambatan, pengembalian.denda
FROM pengembalian
INNER JOIN buku ON pengembalian.id_buku = buku.id_buku
INNER JOIN member ON pengembalian.nisn = member.nisn
INNER JOIN admin ON pengembalian.id_admin = admin.id
WHERE pengembalian.nisn = $akunMember");

if(isset($_POST["search"]) ) {
  $dataPengembalian = search($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
     <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
     <title>Transaksi Pengembalian Buku || Member</title>
  </head>
  <body>
    <nav class="navbar fixed-top bg-body-tertiary shadow-sm">
      <div class="container-fluid p-3">
        <a class="navbar-brand" href="#">
          <img src="../../assets/Pustaka.png" alt="logo" width="120px">
        </a>
        
        <a class="btn btn-tertiary" href="../dashboardMember.php">Dashboard</a>
      </div>
    </nav>
    
    <div class="p-4 mt-5">
      <div class="mt-5 alert alert-primary" role="alert">Riwayat transaksi Pengembalian Buku Anda - <span class="fw-bold text-capitalize"><?php echo htmlentities($_SESSION["member"]["nama"]); ?></span></div>
      
    <div class="table-responsive mt-3">
    <table class="table table-striped table-hover" style="border: 1px solid black; border-collapse: collapse;">
      <thead class="text-center">
      <tr>
                <th class="bg-primary text-light" style="border: 1px solid black;">Id Pengembalian</th>
                <th class="bg-primary text-light" style="border: 1px solid black;">Id Buku</th>
                <th class="bg-primary text-light" style="border: 1px solid black;">Judul Buku</th>
                <th class="bg-primary text-light" style="border: 1px solid black;">Kategori</th>
                <th class="bg-primary text-light" style="border: 1px solid black;">Nisn</th>
                <th class="bg-primary text-light" style="border: 1px solid black;">Nama</th>
                <th class="bg-primary text-light" style="border: 1px solid black;">Nama Admin</th>
                <th class="bg-primary text-light" style="border: 1px solid black;">Tanggal Pengembalian</th>
                <th class="bg-primary text-light" style="border: 1px solid black;">Keterlambatan</th>
                <th class="bg-primary text-light" style="border: 1px solid black;">Denda</th>
            </tr>
      </thead>
        <?php foreach ($dataPengembalian as $item) : ?>
          <tr>
                    <td style="border: 1px solid black;"><?= $item["id_pengembalian"]; ?></td>
                    <td style="border: 1px solid black;"><?= $item["id_buku"]; ?></td>
                    <td style="border: 1px solid black;"><?= $item["judul"]; ?></td>
                    <td style="border: 1px solid black;"><?= $item["kategori"]; ?></td>
                    <td style="border: 1px solid black;"><?= $item["nisn"]; ?></td>
                    <td style="border: 1px solid black;"><?= $item["nama"]; ?></td>
                    <td style="border: 1px solid black;"><?= $item["nama_admin"]; ?></td>
                    <td style="border: 1px solid black;"><?= $item["buku_kembali"]; ?></td>
                    <td style="border: 1px solid black;"><?= $item["keterlambatan"]; ?></td>
                    <td style="border: 1px solid black;"><?= $item["denda"]; ?></td>
                </tr>
        <?php endforeach; ?>
    </table>
    </div>
    </div>
    
    <footer class="fixed-bottom shadow-lg bg-subtle p-3">
      <div class="container-fluid d-flex justify-content-between">
      <p class="mt-2">Created by <span class="text-primary"> Annadvi Jundz</span> © 2023</p>
      <p class="mt-2">versi 1.0</p>
      </div>
  </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>