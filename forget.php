<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
// Kiểm tra xem người dùng đã submit form chưa
if (isset($_POST["submit"])) {
    // Lấy thông tin email từ form
    $email = $_POST["email"];
    // Tạo kết nối tới cơ sở dữ liệu để kiểm tra xem email có tồn tại trong hệ thống hay không
    require_once "config.php";
    // Tạo truy vấn để kiểm tra xem email có tồn tại trong cơ sở dữ liệu hay không
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die('Query error: ' . mysqli_error($conn));
    }
    // Kiểm tra xem email có tồn tại trong cơ sở dữ liệu hay không
    if (mysqli_num_rows($result) > 0) {
        // Nếu email tồn tại, tạo mật khẩu mới ngẫu nhiên
        $new_password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
        // Cập nhật mật khẩu mới vào cơ sở dữ liệu
        $sql = "UPDATE user SET password = '$new_password' WHERE email = '$email'";
        mysqli_query($conn, $sql);
        // Gửi email thông báo về mật khẩu mới
        // Gửi email thông báo về mật khẩu mới
        $mail = new PHPMailer(true);
        try {
            // Cài đặt các cài đặt SMTP để sử dụng dịch vụ Gmail
            $mail->SMTPDebug = 0;
            $mail->CharSet = "utf-8";
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'vhau1010@gmail.com';
            $mail->Password = 'dslbxouaddkytyqa';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            // Thiết lập người gửi và người nhận
            $mail->setFrom('vhau1010@gmail.com', 'Admin');
            $mail->addAddress($email);
            // Thiết lập tiêu đề và nội dung email
            $mail->Subject = 'Mật khẩu mới';
            $mail->Body = 'Mật khẩu mới của bạn là: ' . $new_password;
            $mail->smtpConnect(
                array(
                    "tls" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                        "allow_self_signed" => true
                    )
                )
            );
            // Gửi email
            $mail->send();
            // Hiển thị thông báo cho người dùng
            echo "<script>alert('Mật khẩu mới đã được gửi đến địa chỉ email của bạn.'); window.location.replace('index.html');</script>";
        } catch (Exception $e) {
            // Nếu gửi email thất bại, hiển thị thông báo lỗi
            echo "Không thể gửi email: " . $mail->ErrorInfo;
        }
    } else {
        // Nếu email không tồn tại trong cơ sở dữ liệu, hiển thị thông báo lỗi
        echo "<script>alert('Địa chỉ email không tồn tại trong hệ thống.');window.history.back();</script>";
        // Đóng kết nối tới cơ sở dữ liệu
        mysqli_close($conn);
    }
}
?>