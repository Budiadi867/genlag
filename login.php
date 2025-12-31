<?php
// Login page
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/auth.php';

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is already logged in
if (isLoggedIn()) {
    redirect('generator.php');
}

// Process login form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = sanitizeInput($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = 'Username dan password harus diisi.';
    } else {
        // Authenticate user
        if (authenticateUser($username, $password)) {
            redirect('generator.php');
        } else {
            $error = 'Username atau password salah.';
        }
    }
}

// Include header
include __DIR__ . '/templates/header.php';

// Include login template
include __DIR__ . '/templates/login.php';

// Include footer
include __DIR__ . '/templates/footer.php';
