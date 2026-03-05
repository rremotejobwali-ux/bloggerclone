<?php
session_start();
require_once 'db.php';

$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Blogger Clone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Welcome to My Blog</h1>
    <p>Insights, Stories, and more.</p>
</header>


<nav>
    <a href="index.php">Home</a>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="create_post.php">New Post</a>
        <a href="logout.php">Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a>
    <?php else: ?>
        <a href="login.php">Login</a>
        <a href="signup.php">Sign Up</a>
    <?php endif; ?>
</nav>

<div class="container">
    <div class="blog-grid">
        <?php foreach ($posts as $post): ?>
        <div class="card">
            <?php if ($post['image_url']): ?>
                <img src="<?php echo htmlspecialchars($post['image_url']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
            <?php endif; ?>
            <div class="card-content">
                <p class="post-meta"><?php echo htmlspecialchars($post['category']); ?> | By <?php echo htmlspecialchars($post['author']); ?></p>
                <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                <p><?php echo substr(htmlspecialchars($post['content']), 0, 150) . '...'; ?></p>
                <a href="view_post.php?id=<?php echo $post['id']; ?>" class="btn">Read More</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<footer>
    <div class="container" style="text-align: center; color: #6b7280; padding: 2rem 0;">
        &copy; <?php echo date("Y"); ?> Blogger Clone. All rights reserved.
    </div>
</footer>

</body>
</html>
