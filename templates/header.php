<?php
// Header template
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo"><?php echo APP_NAME; ?></div>
            <?php if (isLoggedIn()): ?>
            <nav>
                <ul>
                    <li><a href="/generator.php">Generator URL</a></li>
                    <li><a href="/history.php">Histori URL</a></li>
                    <?php if (isAdmin()): ?>
                    <li><a href="/users.php">Kelola User</a></li>
                    <li><a href="/random_content.php">Konten Acak</a></li>
                    <?php endif; ?>
                    <li><a href="/change_password.php">Ubah Password</a></li>
                    <li><a href="/logout.php">Logout</a></li>
                </ul>
            </nav>
            <?php endif; ?>
        </div>
    </header>
    
    <div class="main-content">
        <div class="container">
