<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

$id = $_GET["id"];

require 'function.php';

?>
<!doctype html>
<html lang="en">
    
    
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,700" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--bootstrap CSS-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!--Style-->
    <link rel="stylesheet" href="css/style-navbar.css">
    <link rel="stylesheet" href="/css/style.css">
    <title>Mahastore | Website keperluan Mahasiswa</title>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container-fluid">
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="fa fa-bars"></span> Menu</button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="index.php" class="nav-link"><i class='bx bxs-store' style="color:red;"></i></i> MAHASTORE</a></li>
                </ul>
                <ul class="navbar-nav m-auto">
                    <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="produk-cart.php" class="nav-link">Cart</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                           Halo, <?php echo $_SESSION['login']['nama']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="logout.php">Sign Out</a></li>
                        </ul>
                    </li>
                </ul>    
            </div>
        </div>
        
    </nav>
    <!-- END nav -->
    <br>

    <section class="konten">
        <div class="container">
            <?php 
            $qry = mysqli_query($conn,"SELECT * FROM produk WHERE id='$id'");
            foreach($qry as $row){
            ?>        
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <img src="admin/img/<?= $row["gambar"]; ?>" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-6">
                    <h2><?php echo $row["nama_barang"]; ?></h2>

                    <form action="" method="post">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" min="1" class="form-control" name="jumlah" max="<?php echo $row['stok']; ?>" >
                                    <button class="btn btn-outline-dark btn-flat btn-sm" name="beli">Beli</button>
                            </div>
                        </div>
                    </form>
                    
                    <?php 
                    if (isset($_POST["beli"])){
                        $jumlah = $_POST["jumlah"];
                        $_SESSION["produk-cart"][$id] = $jumlah;
                        echo "<script> alert ('produk telah masuk ke keranjang belanja');</script>";
                    }
                    ?>

                    <h6>Rp.<?php echo number_format($row["harga"]);  ?></h6>
                    
                    <p>Stok : <?php echo $row['stok']; ?></p>

                    <p><?php echo $row["deskripsi"]; ?></p>
                    <p><?php if($row['status'] == 1): ?>
                        <span class="badge badge-success px-3 rounded-pill">Masih Ada</span>
                    <?php else: ?>
                        <span class="badge badge-danger px-3 rounded-pill">Stok Habis</span>
                    <?php endif; ?></p>
                </div>
            </div>
        </div>
        <?php 
        }
        ?>
    </section>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/main.js"></script>

</body>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<footer class="sticky-footer bg-black" style="padding: 30px;">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Hamzah Raihan Ikhsanul Fikri</span>
        </div>
    </div>
</footer>
</html>