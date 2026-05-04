<?php
/**
 * Database Configuration
 * Update credentials before deployment
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'blog_system');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

define('SITE_NAME', 'CharmVibe Blog');
define('SITE_URL', 'http://localhost/blog-system');
define('SITE_TAGLINE', 'Stories That Move You');
define('ADMIN_EMAIL', 'admin@charmvibe.com');

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    die('<!DOCTYPE html><html><head><meta charset="UTF-8">
    <title>Database Error</title>
    <style>
        body { font-family: sans-serif; background: #0f0f0e; color: #f0ede6; display: flex;
               align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
        .box { background: #1a1917; border: 1px solid #2a2826; border-radius: 12px;
               padding: 40px; max-width: 520px; width: 90%; }
        h2 { color: #D14343; margin-bottom: 16px; }
        p  { color: #9a9a9a; line-height: 1.7; margin-bottom: 12px; }
        code { background: #0f0f0e; padding: 2px 8px; border-radius: 4px;
               color: #C8A96E; font-size: 0.9rem; }
        ul { color: #9a9a9a; line-height: 2; padding-left: 20px; }
    </style></head><body>
    <div class="box">
        <h2>&#x26A0; Database Connection Failed</h2>
        <p>Error: <code>' . htmlspecialchars($e->getMessage()) . '</code></p>
        <p>Please check the following:</p>
        <ul>
            <li>XAMPP — MySQL is <strong style="color:#3A8E64">running (green)</strong></li>
            <li><code>blog_system</code> database exists in phpMyAdmin</li>
            <li><code>database.sql</code> has been imported</li>
            <li>Credentials in <code>includes/db.php</code> are correct</li>
        </ul>
    </div>
    </body></html>');
}