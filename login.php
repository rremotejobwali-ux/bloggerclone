<?php
session_start();
require_once 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Blogger Clone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <a href="index.php">Home</a>
    <a href="signup.php">Sign Up</a>
    <a href="login.php" class="active">Login</a>
</nav>

<div class="container" style="max-width: 400px; margin-top: 5rem;">
    <div class="card" style="padding: 2rem;">
        <h2 style="text-align: center; margin-bottom: 1.5rem;">Welcome Back</h2>
        
        <?php if ($error): ?>
            <div style="background: #fee2e2; color: #b91c1c; padding: 0.75rem; border-radius: 6px; margin-bottom: 1rem; text-align: center;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" required placeholder="Enter your email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="Enter your password">
            </div>
            <button type="submit" class="btn" style="width: 100%;">Login</button>
        </form>
        
        <p style="text-align: center; margin-top: 1rem; color: #6b7280; font-size: 0.9rem;">
            Don't have an account? <a href="signup.php" style="color: var(--primary-color);">Sign up</a>
        </p>
    </div>
</div>

</body>
</html>
