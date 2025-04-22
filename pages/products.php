<?php
include("../config.php");
$page = "products";
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/favicon.ico">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>BSU License Store</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/owl.css">

  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
   <?php include("../components/header.php"); ?>

    <!-- Page Content -->
    <div class="page-heading about-heading header-text" style="background-image: url(assets/images/background_window11_1.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Welcome to</h4>
              <h2>Products</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="products">
      <div class="container">
        <div class="row">

        <?php $query = mysqli_query(connDB(), "SELECT * FROM products ORDER BY product_id DESC");
          while ($row = mysqli_fetch_array($query)) {
            $slug = generateSlug($row['name']);?>
            <div class="col-md-4">
              <div class="product-item">
                <a href="Product-Details/<?= urlencode($slug); ?>">
                  <img src="assets/images/<?= $slug ?>-1.png" alt="">
                </a>
                <div class="down-content">
                  <a href="Product-Details/<?= urlencode($slug); ?>">
                    <h4><?= $row['name']; ?></h4>
                  </a>
                  <h6><small><del><?= ($row['price']*1.2); ?>.00฿ </del></small> <?= ($row['price']); ?>.00฿</h6>
                  <p class="font-kanit"><?= nl2br(shortDescription($row['description'])); ?></p>
                </div>
              </div>
            </div>
        <?php } ?>

          <div class="col-md-12">
            <ul class="pages">
              <li class="active"><a href="#">1</a></li>
              <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <?php include("../components/footer.php"); ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
  </body>

</html>
