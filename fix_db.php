<?php
require_once 'db.php';

try {
    // Attempt to add missing columns to the posts table
    $alterCommands = [
        "ALTER TABLE posts ADD COLUMN IF NOT EXISTS title VARCHAR(255) NOT NULL;",
        "ALTER TABLE posts ADD COLUMN IF NOT EXISTS content TEXT NOT NULL;",
        "ALTER TABLE posts ADD COLUMN IF NOT EXISTS author VARCHAR(100) NOT NULL;",
        "ALTER TABLE posts ADD COLUMN IF NOT EXISTS category VARCHAR(50) DEFAULT 'General';",
        "ALTER TABLE posts ADD COLUMN IF NOT EXISTS image_url VARCHAR(255);"
    ];

    foreach ($alterCommands as $command) {
        try {
            $pdo->exec($command);
            echo "Executed: " . htmlspecialchars($command) . "<br>";
        } catch (PDOException $e) {
            echo "Error executing command: " . htmlspecialchars($command) . " - " . $e->getMessage() . "<br>";
        }
    }

    echo "<h3>Database repair complete. Please try creating a post now.</h3>";
    echo "<a href='create_post.php'>Go back to Create Post</a>";

} catch (PDOException $e) {
    echo "<h1>Database Error</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>
