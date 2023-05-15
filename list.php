<?php
// Kết nối tới cơ sở dữ liệu
require_once "config.php";
// Truy vấn danh sách người dùng
$sql = "SELECT * FROM user ORDER BY id ASC";

$result = mysqli_query($conn, $sql);
// Hiển thị danh sách người dùng
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Quyền</th><th>Tên</th><th>Email</th><th>Mật Khẩu</th><th>Thao tác</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $role = $row["ad"] == 1 ? "Admin" : "Khách";
        echo "<tr >
            <td>" . $row["id"] . "</td>
            <td>" . $role . "</td>
            <td>" . $row["username"] . "</td>
            <td>" . $row["email"] . "</td>
            <td>" . $row["password"] . "</td>
            <td class='nut'>
                <a href='update.php?id=" . $row["id"] . "' class='edit-btn'>Sửa</a>
                <a href='delete.php?id=" . $row["id"] . "'onclick='return confirm(\"Bạn chắc chắn muốn xóa tài khoản này?\")' class='delete-btn'>Xóa</a>
            </td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "No users found.";
}
// Đóng kết nối
mysqli_close($conn);
?>