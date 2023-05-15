<?php
// Lấy thông tin đăng ký từ phía client
$username = $_POST['new-username'];
$email = $_POST['new-email'];
$password = $_POST['new-password'];
$ad = isset($_POST['new-ad']) ? $_POST['new-ad'] : 0;
// Kiểm tra tính hợp lệ của email và mật khẩu
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response = array('success' => false, 'message' => 'Địa chỉ Email không hợp lệ');
    echo json_encode($response);
    exit();
}

if (strlen($password) < 8) {
    $response = array('success' => false, 'message' => 'Mật khẩu phải tối thiểu 8 ký tự');
    echo json_encode($response);
    exit();
}

// Kết nối đến cơ sở dữ liệu
require_once "config.php";

// Kiểm tra xem tài khoản đã tồn tại hay chưa
$sql = "SELECT * FROM user WHERE email=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    $response = array('success' => false, 'message' => 'Địa chỉ Email đã tồn tại');
} else {
    // Thêm tài khoản mới vào cơ sở dữ liệu
    $sql = "INSERT INTO user (ad,username, email, password) VALUES (?,?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssss', $ad, $username, $email, $password);
    if (mysqli_stmt_execute($stmt)) {
        $response = array('success' => true, );
    } else {
        $response = array('success' => false, 'message' => 'Error: ' . mysqli_error($conn));
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);

// Trả về response dưới dạng JSON
echo json_encode($response);
?>