<?php
// Generator page
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/url_generator.php';

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
checkAccess();

// Process generator form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate'])) {
    $title = sanitizeInput($_POST['title'] ?? '');
    $description = sanitizeInput($_POST['description'] ?? '');
    $imageUrl = sanitizeInput($_POST['imageUrl'] ?? '');
    $finalUrl = sanitizeInput($_POST['finalUrl'] ?? '');
    
    if (empty($imageUrl) || empty($finalUrl)) {
        $error = 'URL gambar dan URL tujuan harus diisi.';
    } else {
        // Generate URL
        $result = generateUrl($title, $description, $imageUrl, $finalUrl);
        $generatedUrl = $result['url'];
        $success = 'URL berhasil dibuat!';
    }
}

// Include header
include __DIR__ . '/templates/header.php';

// Include generator template
include __DIR__ . '/templates/generator.php';

// Include footer
include __DIR__ . '/templates/footer.php';
