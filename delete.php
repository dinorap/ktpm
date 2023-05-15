<?php
require_once "config.php";

// Kiểm tra xem id của user cần xóa có tồn tại trong URL hay không
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $id = trim($_GET["id"]);

    // Chuẩn bị truy vấn xóa user
    $sql = "DELETE FROM user WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Gán các tham số vào statement
        mysqli_stmt_bind_param($stmt, "i", $id);

        // Thực hiện truy vấn
        if (mysqli_stmt_execute($stmt)) {
            // Nếu xóa user thành công, cập nhật lại ID
            $sql = "SET @count = 0";
            mysqli_query($conn, $sql);

            $sql = "UPDATE user SET id = @count:= @count + 1";
            mysqli_query($conn, $sql);

            $sql = "ALTER TABLE user AUTO_INCREMENT = 1";
            mysqli_query($conn, $sql);

            // Chuyển hướng về trang danh sách user
            header("location: uslist.php");
            exit();
        }
    }

    // Đóng statement
    mysqli_stmt_close($stmt);
}

// Đóng kết nối
mysqli_close($conn);
// Nếu id của user không tồn tại trong URL hoặc xóa không thành công, chuyển hướng về trang 404 Not Found
header("location: error404.php");
exit();
?>