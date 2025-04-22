<?php
include("../config.php");
$page = "checkout";

if (!isset($_SESSION['user'])) {
     header("Location: /BSU/Login");
     exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy'])) {
     $username = $_SESSION['user'] ?? 'guest';
     $productName = $_POST['product_name'] ?? '';
 
     $conn = connDB();
     $insert = $conn->prepare("INSERT INTO logs_buy (username, name) VALUES (?, ?)");
     $insert->bind_param("ss", $username, $productName);

     ob_clean();
     header('Content-Type: application/json');
 
     if ($insert->execute()) {
         echo json_encode(['success' => true]);
     } else {
         echo json_encode(['success' => false, 'error' => 'ไม่สามารถบันทึกข้อมูลได้']);
     }
     exit;
}
 
$slug = $_GET['name'] ?? '';
$decodedName = str_replace('-', ' ', $slug);

$conn = connDB();
$stmt = $conn->prepare("SELECT * FROM Products WHERE LOWER(name) = ?");
$decodedName = strtolower($decodedName);
$stmt->bind_param("s", $decodedName);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
     header("Location: /BSU/Home");
     exit;
 }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../assets/images/favicon.ico">
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
        <title>BSU License Store</title>
        <!-- Bootstrap core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Additional CSS Files -->
        <link rel="stylesheet" href="../assets/css/fontawesome.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/owl.css">
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
     <!-- Header --> <?php include("../components/header.php"); ?>
     <!-- Page Content -->
     <div class="page-heading about-heading header-text" style="background-image: url(../assets/images/background_window11_1.jpg);">
          <div class="container">
               <div class="row">
               <div class="col-md-12">
                    <div class="text-content">
                         <h4><?= $product['name'] ?></h4>
                         <h2>Checkout</h2>
                    </div>
               </div>
               </div>
          </div>
     </div>
     <div class="products call-to-action">
          <div class="container">
               <ul class="list-group list-group-flush">
               <li class="list-group-item">
                    <div class="row">
                         <div class="col-6">
                              <em>Sub-total</em>
                         </div>
                         <div class="col-6 text-right">
                              <strong><?= AddComma($product['price']) ?> ฿</strong>
                         </div>
                    </div>
               </li>
               <li class="list-group-item">
                    <div class="row">
                         <div class="col-6">
                              <em>Tax</em>
                         </div>
                         <div class="col-6 text-right">
                              <strong><?= AddComma($product['price'] * 0.07) ?> ฿</strong>
                         </div>
                    </div>
               </li>
               <li class="list-group-item">
                    <div class="row">
                         <div class="col-6">
                              <em>Total</em>
                         </div>
                         <div class="col-6 text-right">
                              <strong><?= AddComma($product['price'] + $product['price'] * 0.07) ?> ฿</strong>
                         </div>
                    </div>
               </li>
               </ul>
               <br>
               
               <div class="row">
                    <div class="col-6">
                         <a href="/BSU/Home" class="btn btn-danger btn-block">Cancel</a>
                    </div>
                    <div class="col-6">
                         <form id="buyForm">
                              <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['name']) ?>">
                              <button type="submit" class="btn btn-primary btn-block" id="buyButton">Buy</button>
                         </form>
                    </div>
               </div>
          </div>
     </div>
     <!-- Footer -->
     <?php include("../components/footer.php"); ?>

     <!-- Bootstrap core JavaScript -->
     <script src="../vendor/jquery/jquery.min.js"></script>
     <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
     <!-- Additional Scripts -->
     <script src="../assets/js/custom.js"></script>
     <script src="../assets/js/owl.js"></script>

     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script>
     document.getElementById("buyForm").addEventListener("submit", function (e) {
     e.preventDefault();

     const formData = new FormData(this);
     formData.append("buy", "1");

     fetch(window.location.href, {
          method: "POST",
          body: formData
     })
     .then(response => response.text())
     .then(text => {

          try {
               const data = JSON.parse(text);

               if (data.success) {
                    Swal.fire({
                         icon: 'success',
                         title: 'สั่งซื้อสำเร็จ',
                         text: 'ขอบคุณที่สั่งซื้อสินค้า!'
                    }).then(() => {
                         window.location.href = "/BSU/Home";
                    });
               } else {
                    Swal.fire({
                         icon: 'error',
                         title: 'ผิดพลาด',
                         text: data.error || 'เกิดข้อผิดพลาด'
                    });
               }
          } catch (e) {
               console.error("JSON parsing error:", e);
               Swal.fire({
                    icon: 'error',
                    title: 'ไม่สามารถประมวลผลข้อมูล',
                    text: 'ข้อมูลที่ได้กลับมาไม่ถูกต้อง'
               });
          }
     })
     .catch(err => {
          console.error("Fetch error:", err);
          Swal.fire({
               icon: 'error',
               title: 'ไม่สามารถเชื่อมต่อได้',
               text: 'โปรดลองอีกครั้งภายหลัง'
          });
     });
     });
     </script>
</body>
</html>