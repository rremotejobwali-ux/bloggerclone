<?php
session_start();
require_once 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$message = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $image_url = $_POST['image_url'];
    // Use session username as author
    $author = $_SESSION['username'];

    if (!empty($title) && !empty($content)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO posts (title, content, author, category, image_url) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute([$title, $content, $author, $category, $image_url])) {
                $message = "Post published successfully!";
            } else {
                $error = "Error saving post to database.";
            }
        } catch (PDOException $e) {
            $error = "Database Error: " . $e->getMessage();
        }
    } else {
        $error = "Title and Content are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post - Blogger Clone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Create New Blog Post</h1>
</header>

<nav>
    <a href="index.php">Home</a>
    <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
    <a href="logout.php">Logout</a>
</nav>

<div class="container" style="max-width: 800px;">
    <?php if ($message): ?>
        <div style="padding: 1rem; margin-bottom: 2rem; border-radius: 6px; background: #d1fae5; color: #065f46; text-align: center;">
            <?php echo $message; ?>
            <br>
            <a href="index.php" style="color: inherit; text-decoration: underline;">View on Homepage</a>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div style="padding: 1rem; margin-bottom: 2rem; border-radius: 6px; background: #fee2e2; color: #b91c1c; text-align: center;">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <div class="card" style="padding: 2rem;">
        <form method="POST">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" required placeholder="Enter post title" value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label>Category</label>
                <select name="category">
                    <option value="General">General</option>
                    <option value="Technology">Technology</option>
                    <option value="Health">Health</option>
                    <option value="Education">Education</option>
                    <option value="Lifestyle">Lifestyle</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Image URL (Optional)</label>
                <input type="text" name="image_url" placeholder="https://example.com/image.jpg" value="<?php echo isset($_POST['image_url']) ? htmlspecialchars($_POST['image_url']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label>Content</label>
                <textarea name="content" required placeholder="Write your content here..."><?php echo isset($_POST['content']) ? htmlspecialchars($_POST['content']) : ''; ?></textarea>
            </div>
            
            <button type="submit" class="btn" style="width: 100%; padding: 1rem; font-size: 1rem;">Publish Post</button>
        </form>
    </div>
</div>

</body>
</html>
<?php
session_start();
require_once 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$message = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $image_url = $_POST['image_url'];
    // Use session username as author
    $author = $_SESSION['username'];

    if (!empty($title) && !empty($content)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO posts (title, content, author, category, image_url) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute([$title, $content, $author, $category, $image_url])) {
                $message = "Post published successfully!";
            } else {
                $error = "Error saving post to database.";
            }
        } catch (PDOException $e) {
            $error = "Database Error: " . $e->getMessage();
        }
    } else {
        $error = "Title and Content are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post - Blogger Clone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Create New Blog Post</h1>
</header>

<nav>
    <a href="index.php">Home</a>
    <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
    <a href="logout.php">Logout</a>
</nav>

<div class="container" style="max-width: 800px;">
    <?php if ($message): ?>
        <div style="padding: 1rem; margin-bottom: 2rem; border-radius: 6px; background: #d1fae5; color: #065f46; text-align: center;">
            <?php echo $message; ?>
            <br>
            <a href="index.php" style="color: inherit; text-decoration: underline;">View on Homepage</a>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div style="padding: 1rem; margin-bottom: 2rem; border-radius: 6px; background: #fee2e2; color: #b91c1c; text-align: center;">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <div class="card" style="padding: 2rem;">
        <form method="POST">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" required placeholder="Enter post title" value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label>Category</label>
                <select name="category">
                    <option value="General">General</option>
                    <option value="Technology">Technology</option>
                    <option value="Health">Health</option>
                    <option value="Education">Education</option>
                    <option value="Lifestyle">Lifestyle</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Image URL (Optional)</label>
                <input type="text" name="image_url" placeholder="https://example.com/image.jpg" value="<?php echo isset($_POST['image_url']) ? htmlspecialchars($_POST['image_url']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label>Content</label>
                <textarea name="content" required placeholder="Write your content here..."><?php echo isset($_POST['content']) ? htmlspecialchars($_POST['content']) : ''; ?></textarea>
            </div>
            
            <button type="submit" class="btn" style="width: 100%; padding: 1rem; font-size: 1rem;">Publish Post</button>
        </form>
    </div>
</div>

</body>
</html>
