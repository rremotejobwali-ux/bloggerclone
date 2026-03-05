<?php
session_start();
require_once 'db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$_GET['id']]);
$post = $stmt->fetch();

if (!$post) {
    echo "Post not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?> - Blogger Clone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1><?php echo htmlspecialchars($post['title']); ?></h1>
</header>

<nav>
    <a href="index.php">Home</a>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="create_post.php">New Post</a>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a>
        <a href="signup.php">Sign Up</a>
    <?php endif; ?>
</nav>

<div class="container">
    <article>
        <?php if ($post['image_url']): ?>
            <img src="<?php echo htmlspecialchars($post['image_url']); ?>" class="post-image" alt="<?php echo htmlspecialchars($post['title']); ?>">
        <?php endif; ?>
        
        <div class="post-meta">
            <span>Posted on: <?php echo date("F j, Y", strtotime($post['created_at'])); ?></span> | 
            <span>By: <?php echo htmlspecialchars($post['author']); ?></span> | 
            <span>Category: <?php echo htmlspecialchars($post['category']); ?></span>
        </div>

        <div class="post-content">
            <?php echo nl2br(htmlspecialchars($post['content'])); ?>
        </div>
    </article>

    <div style="margin-top: 3rem;">
        <a href="index.php" class="btn">Back to Home</a>
    </div>
</div>

<footer>
    <div class="container" style="text-align: center; color: #6b7280; padding: 2rem 0;">
        &copy; <?php echo date("Y"); ?> Blogger Clone. All rights reserved.
    </div>
</footer>

</body>
</html>
