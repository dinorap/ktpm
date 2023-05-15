<?php
// Lấy thông tin đăng nhập từ phía client
$email = $_POST['email'];
$password = $_POST['password'];
require_once "config.php";
// Kết nối đến cơ sở dữ liệu
// Thực hiện truy vấn kiểm tra thông tin đăng nhập
$sql = "SELECT * FROM user WHERE email='$email' AND password ='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $ad_value = $row['ad'];

    // Trả về phản hồi JSON kèm giá trị "ad"
    $response = array('success' => true, 'ad' => $ad_value);
} else {
    $response = array('success' => false, 'message' => 'Email hoạc mật khẩu không đúng.');
}

mysqli_close($conn);

echo json_encode($response);

?>