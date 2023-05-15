<?php
// Kết nối tới cơ sở dữ liệu
require_once "config.php";

// Kiểm tra xem người dùng đã bấm nút Cập nhật hay chưa
if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Sử dụng prepared statement để cập nhật thông tin tài khoản người dùng vào cơ sở dữ liệu
    $stmt = mysqli_prepare($conn, "UPDATE user SET username=?, email=?, password=?, ad=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "sssii", $username, $email, $password, $role, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>setTimeout(function(){ window.location.href = 'uslist.php'; }, 500);</script>";
        exit;
    } else {
        echo "Có lỗi xảy ra khi cập nhật thông tin: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}

// Lấy thông tin tài khoản người dùng từ cơ sở dữ liệu và hiển thị trên form cập nhật
$id = $_GET['id'];
$sql = "SELECT * FROM user WHERE id=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Cập nhật thông tin tài khoản</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="submit"],
        button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        button:hover {
            background-color: #3e8e41;
        }

        button {
            background-color: #ccc;
            color: #fff;
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <h2>Cập nhật thông tin tài khoản</h2>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label>Tên người dùng:</label>
        <input type="text" name="username" value="<?php echo $row['username']; ?>"><br>
        <label>Email:</label>
        <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
        <label>Mật khẩu:</label>
        <input type="text" name="password" value="<?php echo $row['password']; ?>"><br>
        <label>Quyền:</label>
        <select name="role">
            <option value="0" <?php if ($row['ad'] == 0)
                echo "selected"; ?>>Khách</option>
            <option value="1" <?php if ($row['ad'] == 1)
                echo "selected"; ?>>Admin</option>
        </select><br>
        <input type="submit" name="update" value="Cập nhật" onclick="showMessage()">
        <button type="button" onclick="location.href='uslist.php'">Thoát</button>
    </form>
    <script>
        function showMessage() {
            const messageBox = document.createElement("div");
            messageBox.style.zIndex = "9999";
            messageBox.textContent = "Cập nhật thông tin thành công";
            messageBox.style.position = "fixed";
            messageBox.style.top = "10px";
            messageBox.style.left = "50%";
            messageBox.style.transform = "translateX(-50%)";
            messageBox.style.width = "30%";
            messageBox.style.backgroundColor = "#00e5ff";
            messageBox.style.color = "white";
            messageBox.style.textAlign = "center";
            messageBox.style.padding = "10px";
            document.body.appendChild(messageBox);
            setTimeout(function () {
                window.location.href = "uslist.php";
            }, 2000); // Chuyển hướng trang sau 2 giây
            setTimeout(function () {
                messageBox.style.display = "none";
            }, 2000);
        }
    </script>
</body>

</html>