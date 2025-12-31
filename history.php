<?php
// History page
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

// Read URL history
$urls = readJsonFile(URLS_FILE);
$urls = array_reverse($urls); // Show newest first

// Check for messages
$successMessage = $_SESSION['success_message'] ?? null;
$errorMessage = $_SESSION['error_message'] ?? null;

// Clear messages after retrieving them
unset($_SESSION['success_message']);
unset($_SESSION['error_message']);

// Include header
include __DIR__ . '/templates/header.php';

// Include history template
include __DIR__ . '/templates/history.php';

// Include footer
include __DIR__ . '/templates/footer.php';
