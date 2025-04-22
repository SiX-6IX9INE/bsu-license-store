<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy'])) {
    $slug = $_GET['name'] ?? '';
    $decodedName = str_replace('-', ' ', $slug);
    $decodedName = strtolower($decodedName);

    $conn = connDB();
    $stmt = $conn->prepare("SELECT * FROM Products WHERE LOWER(name) = ?");
    $stmt->bind_param("s", $decodedName);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        $productName = $product['name'];

        $insert = $conn->prepare("INSERT INTO logs_buy (name) VALUES (?)");
        $insert->bind_param("s", $productName);
        $insert->execute();

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'ไม่พบสินค้า']);
    }
    exit; // ต้องหยุดที่นี่ เพื่อไม่ให้โหลด HTML ด้านล่าง
}

// ดึงข้อมูลสินค้าไว้แสดงในหน้า
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