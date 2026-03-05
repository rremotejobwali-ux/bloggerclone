<?php
session_start();
require_once 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Handle deletion
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header("Location: admin.php");
    exit();
}

$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Blogger Clone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Admin Dashboard</h1>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="admin.php">Admin Panel</a>
    <a href="create_post.php">New Post</a>
    <a href="logout.php">Logout</a>
</nav>

<div class="container">
    <h2>Manage Posts</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post): ?>
            <tr>
                <td><?php echo $post['id']; ?></td>
                <td><?php echo htmlspecialchars($post['title']); ?></td>
                <td><?php echo htmlspecialchars($post['author']); ?></td>
                <td><?php echo htmlspecialchars($post['category']); ?></td>
                <td><?php echo date("Y-m-d", strtotime($post['created_at'])); ?></td>
                <td>
                    <a href="view_post.php?id=<?php echo $post['id']; ?>" class="btn" style="background: #10b981;">View</a>
                    <a href="admin.php?delete=<?php echo $post['id']; ?>" class="btn" style="background: #ef4444;" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
