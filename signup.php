<?php
session_start();
require_once 'db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($email) && !empty($password)) {
        // Check if email exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->fetch()) {
            $error = "Email already registered.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            
            if ($stmt->execute([$username, $email, $hashed_password])) {
                $success = "Account created! You can now login.";
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    } else {
        $error = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Blogger Clone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <a href="index.php">Home</a>
    <a href="login.php">Login</a>
    <a href="signup.php" class="active">Sign Up</a>
</nav>

<div class="container" style="max-width: 400px; margin-top: 5rem;">
    <div class="card" style="padding: 2rem;">
        <h2 style="text-align: center; margin-bottom: 1.5rem;">Create Account</h2>
        
        <?php if ($error): ?>
            <div style="background: #fee2e2; color: #b91c1c; padding: 0.75rem; border-radius: 6px; margin-bottom: 1rem; text-align: center;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div style="background: #d1fae5; color: #065f46; padding: 0.75rem; border-radius: 6px; margin-bottom: 1rem; text-align: center;">
                <?php echo $success; ?>
                <br><a href="login.php" style="color: inherit; text-decoration: underline; font-weight: bold;">Login now</a>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required placeholder="Choose a username">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required placeholder="Enter your email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="Create a password">
            </div>
            <button type="submit" class="btn" style="width: 100%;">Sign Up</button>
        </form>
        
        <p style="text-align: center; margin-top: 1rem; color: #6b7280; font-size: 0.9rem;">
            Already have an account? <a href="login.php" style="color: var(--primary-color);">Login</a>
        </p>
    </div>
</div>

</body>
</html>
