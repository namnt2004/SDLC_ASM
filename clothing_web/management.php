<?php

require('db.php');

// Xóa tài khoản nếu nhận được 'delete'
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: management.php"); // Redirect để tránh gửi lại yêu cầu xóa khi refresh trang
    exit();
}

// Lấy danh sách người dùng
$users = $conn->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <title>User Account Management</title>
</head>
<body>
    <h1>User Account Management</h1>

    <!-- User List -->
    <h2>User List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Role</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['username'] ?></td>
            <td><?= $user['password'] ?></td>
            <td><?= $user['role'] ?></td>
            <td><?= $user['created_at'] ?></td>
            <td>
                <a href="?delete=<?= $user['id'] ?>" onclick="return confirm('Are you sure you want to delete this account?')">
                    Delete
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <div style="margin-top: 20px;">
        <a href="index.php">
            <button>Back to Product Management</button>
        </a>
    </div>
</body>
</html>
