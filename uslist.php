<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />

    <title>Quản lý tài khoản</title>
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    th {
        background-color: #0DD6B8;
        color: white;
    }

    .edit-btn,
    .delete-btn {
        background-color: #0DD6B8;
        border: none;
        color: white;
        padding: 6px 6px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 3x 2px;
        cursor: pointer;
        border-radius: 5px;
    }

    .delete-btn {
        background-color: #f44336;
    }

    .nut {
        padding-right: 10px;
    }
    </style>
    <style>
    #addForm {

        margin: center;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-top: 20px;
        padding: 20px;
        width: 100%;
        background-color: #f2f2f2;
        /* Thêm màu nền cho phần thêm tài khoản */

    }

    #addForm label {
        display: inline-block;
        width: 100px;
        font-weight: bold;
        margin-bottom: 10px;
        /* Thêm khoảng cách giữa các label */
    }

    #addForm input[type=email],
    #addForm input[type=text],
    #addForm input[type=password],
    #addForm select {
        width: 250px;
        padding: 5px;
        margin-bottom: 10px;
        border-radius: 3px;
        border: 1px solid #ccc;
    }

    #addForm button[type=submit] {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 6px 6px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-top: 10px;
        cursor: pointer;
        border-radius: 5px;
    }

    .right {
        margin-left: 1313px;
    }
    </style>

    <script>
    function showAddForm() {
        var addForm = document.getElementById("addForm");
        if (addForm.style.display === "none") {
            addForm.style.display = "block";
        } else {
            addForm.style.display = "none";
        }
    }
    </script>

</head>

<body>
    <style>
    h1 {
        text-align: center;
    }

    h2 {
        text-align: center;
    }
    </style>


    <h1>Quản lý tài khoản</h1>
    <button type="button" onclick="showAddForm()">Thêm tài khoản</button>
    <button type="button" onclick="window.location.href='test/admin-dashboard'">ADMIN</button>
    <button type="button" onclick="window.location.href='index.html'" class="right">Đăng xuất</button>
    <div id="addForm" style="display: none; text-align: center;">
        <form id="registers-form" style="display: inline-block; text-align: left;">
            <h2>Thêm tài khoản</h2>
            <label>Tên:</label>
            <input type="text" name="new-username" id="new-username" placeholder="Tên tài khoản" />
            <br>
            <label>Email:</label>
            <input type="email" name="new-email" id="new-email" placeholder="Email" />
            <br>
            <label>Mật khẩu:</label>
            <input type="password" name="new-password" id="new-password" placeholder="Mật khẩu" />
            <br>
            <label>Quyền:</label>
            <select name="new-ad" id="new-email">
                <option value="0">Khách</option>
                <option value="1">Admin</option>
            </select>
            <br>
            <div style=" text-align: center;">
                <button type="submit">Thêm</button>
            </div>
        </form>
    </div>
    <h3></h3>
    <?php require_once("list.php"); ?>
    <script src="uslist.js"></script>
</body>

</html>