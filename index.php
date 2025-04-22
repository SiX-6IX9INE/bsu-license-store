<?php
include("config.php");
$page = "home";
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
   <?php include("components/header.php"); ?>
  

  <!-- Page Content -->
  <!-- Banner Starts Here -->
  <div class="banner header-text">
    <div class="owl-banner owl-carousel">
      <div class="banner-item-01 bg-black">
        <div class="text-content">
          <h4>Welcome to</h4>
          <h2>BSU License Store</h2>
        </div>
      </div>
      <div class="banner-item-02 bg-black">
        <div class="text-content">
          <h4>Welcome to</h4>
          <h2>BSU License Store</h2>
        </div>
      </div>
      <div class="banner-item-03 bg-black">
        <div class="text-content">
          <h4>Welcome to</h4>
          <h2>BSU License Store</h2>
        </div>
      </div>
    </div>
  </div>
  <!-- Banner Ends Here -->

  <div class="latest-products">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Featured Products</h2>
            <a href="Products">view more <i class="fa fa-angle-right"></i></a>
          </div>
        </div>
        <?php $query = mysqli_query(connDB(), "SELECT * FROM products ORDER BY product_id DESC");
            while ($row = mysqli_fetch_array($query)) {
            ?>
        <?php if ($row['featured']) { 
          $slug = generateSlug($row['name']);
          ?>
          <div class="col-md-4">
            <div class="product-item">
            <a href="Product-Details/<?= urlencode($slug); ?>">
                <img src="assets/images/<?= $slug ?>-1.png" alt="">
            </a>         
            <div class="down-content">
                <a href="Product-Details/<?= urlencode($slug); ?>">
                  <h4><?= $row['name']; ?></h4>
                </a>
                <h6><small><del><?= ($row['price']*1.2); ?>.00฿</del></small> <?= $row['price']; ?>.00฿</h6>
                <p class="font-kanit">
                  <?= nl2br(shortDescription($row['description'])); ?>
                </p>
              </div>
            </div>
          </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </div>

  <div class="best-features">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>About Us</h2>
          </div>
        </div>
        <div class="col-md-6">
          <div class="left-content">
          <p class="font-kanit">เราจำหน่าย License Windows ของแท้ ทั้ง Windows 10 และ 11 — Home และ Pro พร้อมส่งโค้ดภายในไม่กี่นาทีหลังสั่งซื้อ ลูกค้ามั่นใจได้ว่าใช้งานได้จริง มีบริการหลังการขายหากติดตั้งหรือ Activate ไม่ได้</p>

          <ul class="featured-list font-kanit">
            <li><a href="#">License ของแท้ Activate ได้ทันที</a></li>
            <li><a href="#">รองรับทั้ง Windows 10 และ 11</a></li>
            <li><a href="#">มีทั้งเวอร์ชัน Home และ Pro</a></li>
            <li><a href="#">บริการช่วยเหลือหลังการขาย</a></li>
          </ul>

            <a href="About-Us" class="filled-button">Read More</a>
          </div>
        </div>
        <div class="col-md-6">
          <div class="right-image">
            <img src="assets/images/background_window11_1.jpg" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="call-to-action">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="inner-content">
            <div class="row">
              <div class="col-md-8 font-kanit">
                <h4>มีคำถามเกี่ยวกับ License Windows?</h4>
                <p>หากคุณต้องการสอบถามเกี่ยวกับการติดตั้ง การ Activate หรือเลือกซื้อเวอร์ชันที่เหมาะกับคุณ เราพร้อมให้คำแนะนำ</p>
              </div>
              <div class="col-lg-4 col-md-6 text-right">
                <a href="Contact" class="filled-button">Contact Us</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include("components/footer.php"); ?>


  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


  <!-- Additional Scripts -->
  <script src="assets/js/custom.js"></script>
  <script src="assets/js/owl.js"></script>
</body>

</html>