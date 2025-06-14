<?php
session_start(); // Simulan ang session para ma-access ang cart at CSRF token

// iseset ang response type bilang JSON
header('Content-Type: application/json');

// ivavalidate kung POST ang request method 
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Sisiguraduhin na pareho ang token na galing sa form at ang token sa session
if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    echo json_encode(['success' => false, 'message' => 'Invalid CSRF token']);
    exit;
}

// ichecheck kung may item index na ipinasa
if (!isset($_POST['index'])) {
    echo json_encode(['success' => false, 'message' => 'No item index specified']);
    exit;
}

// Kunin ang index ng item na tatanggalin at siguraduhing ito ay integer
$index = (int)$_POST['index'];

// ichecheck kung ang item ay talagang nasa cart
if (!isset($_SESSION['cart'][$index])) {
    echo json_encode(['success' => false, 'message' => 'Item not found in cart']);
    exit;
}

// Alisin ang item sa cart gamit ang index 
unset($_SESSION['cart'][$index]);

// irereindex ang cart array upang ang mga susunod na index ay maging sunod-sunod ulit
$_SESSION['cart'] = array_values($_SESSION['cart']);


echo json_encode(['success' => true]);
exit;
?>
