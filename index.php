<?php
  session_start();
  include "koneksi.php";
  if (!isset($_SESSION['id_login'])){
    $id_login = "";
  }else{
    $noTransaksi  = "";
    $qtyPesan     = "";
    $id_login = $_SESSION['id_login'];
    if($id_login!="sudahLogin"){
      $id_login="";
    }else{
      $idCustomer = $_SESSION['id_customer'];
      $nama       = $_SESSION['nama'];
      $username   = $_SESSION['username'];

      $sql = "SELECT sum(b.qty) AS qty, a.no_transaksi FROM tbl_transaksi a INNER JOIN tbl_transaksi_detail b ON a.no_transaksi = b.no_transaksi WHERE a.id_pegawai = '$idCustomer' AND a.total_bayar = 0 ORDER BY a.no_transaksi DESC";
      $query = mysqli_query($koneksi, $sql);
      if(mysqli_num_rows($query)>0){
        $data         = mysqli_fetch_array($query);
        $noTransaksi  = $data['no_transaksi'];
        $qtyPesan     = $data['qty'];
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en" id="home">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tempat Makan KA</title>
    <link rel="shorcut icon" type="text/css" href="img/logo1.png">

    <link rel="stylesheet" href="css/bootstrap-4_4_1.min.css">
    <link rel="stylesheet" href="assets/fontawesome-free/css/all.min.css" >
    <link rel="stylesheet" href="css/styleku.css">
  </head>
  <body>
    <!-- SweetAlert2 -->
	  <div class="info-data" data-infodata="<?php if(isset($_SESSION['info'])){ echo $_SESSION['info']; } unset($_SESSION['info']); ?>"></div>
    
    <!-- Jika belum login -->
    <?php 
    if($id_login==""){?>
      <!-- Jumbotron -->
      <div class="jumbotron text-center">
        <img src="img/logo1.png" alt="Logo" class="rounded-circle" >
        <h1 class="textWarning">Tempat Makan KA</h1>
        <p class="kopi">Tempat Makannya Orang Lapar </p>
      </div>
      <!-- Akhir Jumbtron -->
      <?php 
    }?>

    <!-- Navbar -->
    <nav class="navbar sticky-top navbar-expand-lg shadow">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand text-dark" href="#"><img src="img/logo1.png" alt="Logo" width="20px" height="20px" class="pt-1 mr-2"> 
        <?php 
        if($id_login==""){
          echo "Tempat Makan KA";
        }else{
          echo "Selamat Datang <b>" .strtoupper($nama)."</b> di Tempat Makan KA"; 
        }?>
      </a>

      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto mt-lg-0">
          <!-- Jika belum login -->
          <?php 
          if($id_login==""){?>
            <li><a href="#about" class="page-scroll">ABOUT</a></li>
            <li><a href="#portfolio" class="page-scroll">MENU</a></li>
            <li><a href="#contact" class="page-scroll">CONTACT</a></li>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-weight: bold;">LOGIN
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <!-- Form login -->
                <form action="proses.php" method="post">
                  <!-- Username -->
                  <div class="form-group mx-2 my-0 py-0">
                    <input type="text" name="username" class="form-control form-control-sm" placeholder="Username"  autocomplete="off" required>
                  </div>

                  <!-- Password -->
                  <div class="form-group mx-2 my-0 py-0">
                    <input type="password" name="password" class="form-control form-control-sm" placeholder="Password" autocomplete="off" required>
                  </div>
                  <button type="submit" class="btn btn-primary btn-sm ml-2 py-1 my-0">&nbsp;<i class="fa fa-lock"></i>&nbsp;&nbsp;Login&nbsp;&nbsp;</button>
                </form>
              </div>
            </li>
            <?php 
          }else{?>
            <!-- Jika sudah login -->
            <li><a href="dashboard-customer.php" class="page-scroll"><i class="fa fa-shopping-cart" title="Daftar Belanja"></i> <span class="badge badge-success qtyPesan" id="qtyPesan"><?= $qtyPesan; ?></span></a></li>
            <li><a href="logout.php" class="page-scroll" title="LogOut">LOG OUT</a></li>
            <?php 
          }?>
        </ul>
      </div>
    </nav>
    <!-- Akhir Navbar  -->

    <!-- Jika belum login about-->
    <?php 
    if($id_login==""){?>
      <!-- About -->
      <section class="about" id="about">
        <div class="container-fluid imgAbout">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="text-dark">About</h2>
              <hr class="hr">
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-6">
              <p class="pKiri">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Selamat datang di KA, tempat makan yang menghadirkan pengalaman kuliner yang menggabungkan cita rasa autentik dan suasana yang nyaman. Kami di KA percaya bahwa setiap hidangan memiliki cerita, dan kami berusaha menyajikan pengalaman makan yang tak terlupakan melalui menu kami yang kaya akan cita rasa lokal dan internasional. <br>
              
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Di KA, kami menggunakan bahan-bahan segar dan berkualitas untuk memastikan setiap sajian terasa istimewa. Tim koki kami dengan teliti meracik setiap hidangan untuk memenuhi selera para pengunjung, dari hidangan tradisional hingga sentuhan modern yang inovatif..<br>
              
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nikmati suasana yang hangat dan layanan yang ramah di KA, tempat yang dirancang untuk menjadi ruang berkumpul yang nyaman, baik untuk keluarga, teman, maupun kolega. Kami mengundang Anda untuk datang, mencicipi, dan merasakan pengalaman kuliner yang berbeda di KA!</p>
            </div>
            <div class="col-md-6">
              <p class="pKanan">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Selamat datang di KA, tempat makan yang menggabungkan kelezatan kuliner dan kehangatan suasana dalam setiap kunjungan. Kami percaya bahwa setiap hidangan adalah sebuah karya, dan di KA, kami menghadirkan pengalaman makan yang memanjakan seluruh indera Anda. Dari pilihan menu yang beragam hingga desain interior yang nyaman, kami berkomitmen untuk memberikan yang terbaik bagi setiap pengunjung.

Di KA, kami mengutamakan bahan-bahan lokal yang segar dan berkualitas tinggi. Setiap hidangan disiapkan dengan cermat oleh tim koki berpengalaman yang memiliki hasrat besar terhadap dunia kuliner. Dari sajian klasik yang kaya akan cita rasa tradisional, hingga pilihan menu modern yang menggabungkan teknik masak terkini, kami berusaha menghadirkan variasi yang memuaskan selera semua orang.

Kenapa Memilih KA?

Rasa Autentik: Kami bangga menyajikan makanan dengan cita rasa yang asli, diracik dari resep yang telah diuji dan dikembangkan untuk memastikan kepuasan pelanggan.
Lingkungan yang Nyaman untuk pengunjung yang datang.



            </div>
          </div>
        </div>
      </section>
      <!-- Akhir About  -->
      <?php 
    }?>

    <!-- Menu -->
    <section class="portfolio" id="portfolio">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 text-center">
            <h2>M E N U</h2>
            <hr class="hr">
          </div>
        </div>
        <div class="row menuCustomerBeli">
          <?php 
          $sql = "SELECT * FROM tbl_menu ORDER BY id_jenis_menu, nama_menu";
          $query = mysqli_query($koneksi, $sql);
          while ($data = mysqli_fetch_array($query)) {
            if ($data['img']==""){
              $img = "img/no-logo.png";
            }else{ 
              $img = "img/".$data['img'];
            }
            $id_menu    = $data['id_menu'];
            $nama_menu  = strtoupper($data['nama_menu']);
            $harga      = number_format($data['harga']);
            $qty        = $data['qty'];
            $jual       = $data['jual'];?>

            <div class="col-sm-3 mb-1">
              <a class="gambar">
                <input type="hidden" name="noTrans" value="<?= $noTransaksi; ?>">
                <img src="<?= $img; ?>" alt="<?= $nama_menu; ?>" class="img-responsive">
                <span></span>
                <div class="menuNama"><?= $nama_menu; ?></div>
                <div class="menuHarga"><?= "Rp. " .$harga; ?></div>
                <?php 
                if($qty-$jual>0){?>
                  <div class="menuPesan"><small class="btn btn-sm btn-success pesanMenu" id2="<?= $id_menu; ?>" id3="<?= $idCustomer; ?>"><i class="fa fa-plus"></i></small></div>
                  <?php 
                }else{?>
                  <div class="soldOut"><img src="img/soldOut.png" class="imgSold"></div>
                  <?php 
                }?>
              </a>
            </div>
            <?php 
          }?>
        </div>
      </div>
    </section>
    <!-- Akhir Menu -->

    <!-- Jika belum login buat akun-->
    <?php 
    if($id_login==""){?>
      <!-- Contact -->
      <section class="contact" id="contact">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 text-center">
        <h2>Contact</h2>
        <hr class="hr">
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-sm-10 col-md-8 col-lg-6 mx-auto">
        <form name="formContact" method="post" action="customer-simpan.php">
          <!-- Nama -->
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
              <input name="nama" type="text" class="form-control" placeholder="masukan nama" autocomplete="off">
            </div>
          </div>

          <!-- Email -->
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
              <input name="email" type="email" class="form-control" placeholder="masukan email" autocomplete="off" onKeyUp="testEmailChars(this);">
              <small id="cekEmail"></small>
            </div>
          </div>

          <!-- Username -->
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-9">
              <input name="username2" type="text" class="form-control" placeholder="masukan username" autocomplete="off">
            </div>
          </div>

          <!-- Password -->
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
              <input name="password2" type="password" class="form-control" placeholder="masukan password untuk login" autocomplete="off">
            </div>
          </div>

          <!-- Telp -->
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">No. Telp / WA</label>
            <div class="col-sm-9">
              <input name="telp" type="text" class="form-control" placeholder="masukan no telp" autocomplete="off">
            </div>
          </div>

          <!-- Alamat -->
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-9">
              <textarea name="alamat" class="form-control" placeholder="masukan alamat" cols="30" rows="3"></textarea>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="form-group row">
            <div class="col-sm-9 offset-sm-3">
              <input name='buatAkun' type="submit" class="btn btn-primary buatAkun" value="Buat Akun" style="width:100px;">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

      <!-- Akhir Contact -->
      <?php 
    }?>

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <p class="footer"></p>
          </div>
        </div>
      </div>
    </footer>
    <!-- Akhir Footer -->

    <!-- <script src="js/jquery.min.js"></script> -->
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
	  <script src="js/style-sweetalert2.js"></script>
    
    <?php 
    if($id_login==""){?>
      <script src="js/script.js"></script>
      <?php 
    }else{?>
      <script src="js/script_login.js"></script>
      <?php 
    }?>
    <script>
      $(document).ready(function () {
        $(document).on("click", ".buatAkun", function () {
          var nama      = $('[name="nama"]').val();
          var email     = $('[name="email"]').val();
          var cekEmail  = $('#cekEmail').text();
          var username  = $('[name="username2"]').val();
          var password  = $('[name="password2"]').val();
          var telp      = $('[name="telp"]').val();
          var alamat    = $('[name="alamat"]').val();
          if (nama == "") {
            Swal.fire('Nama belum diisi!');
            return false;
          } else if (email == "") {
            Swal.fire('Email belum diisi!');
            return false;
          } else if (cekEmail != "valid") {
            Swal.fire('format Email salah!');
            return false;
          } else if (username == "") {
            Swal.fire('username belum diisi!');
            return false;
          } else if (password == "") {
            Swal.fire('Password belum diisi!');
            return false;
          } else if (telp == "") {
            Swal.fire('Telp belum diisi!');
            return false;
          } else if (alamat == "") {
            Swal.fire('alamat belum diisi!');
            return false;
          }
        });

        $(document).on("click", ".pesanMenu", function () {
          var idMenu      = $(this).attr('id2');
          var idCustomer  = $(this).attr('id3');
          var noTrans     = $('[name="noTrans"]').val();
          $.ajax({
            method: 'POST',
            data: {
              idMenu: idMenu,
              idCustomer: idCustomer,
              noTrans: noTrans
            },
            url: 'transaksi-customer-ajax.php',
            cache: false,
            success: function(a) {
              var row = JSON.parse(a);
              var noTransaksi = row.no_transaksi;
              var qtyPesan = row.qty;
              var stock = row.stock;
              $('[name="noTrans"]').val(noTransaksi);
              $('#qtyPesan').text(qtyPesan);
              $('.menuCustomerBeli').load('transaksi-customer-beli.php', {
                idCustomer: idCustomer,
                noTransaksi:noTransaksi
              });
            }
          });
        });

        $(document).on("click", "#userDropdown", function () {
          $('[name="username"]').focus();
        });

      });

      
      // Cek Validasi Email
      function testEmailChars(){
        var rs = document.forms["formContact"]["email"].value;
        var atps=rs.indexOf("@");
        var dots=rs.lastIndexOf(".");
        if (atps<1 || dots<atps+2 || dots+2>=rs.length) {
          $("#cekEmail").html("not valid");
        } else {
	        $("#cekEmail").html("valid");
        }
      }


    </script>
    
   </body>
</html>
