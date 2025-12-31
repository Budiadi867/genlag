<?php
// Change password page
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/auth.php';

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
checkAccess();

// Process change password form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    
    if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
        $error = 'Semua kolom harus diisi.';
    } elseif ($newPassword !== $confirmPassword) {
        $error = 'Password baru dan konfirmasi password tidak cocok.';
    } else {
        // Verify current password
        if (verifyPassword($_SESSION['user'], $currentPassword)) {
            // Update password
            if (updatePassword($_SESSION['user'], $newPassword)) {
                $success = 'Password berhasil diubah.';
            } else {
                $error = 'Gagal mengubah password.';
            }
        } else {
            $error = 'Password saat ini tidak valid.';
        }
    }
}

// Include header
include __DIR__ . '/templates/header.php';

// Include change password template
include __DIR__ . '/templates/change_password.php';

// Include footer
include __DIR__ . '/templates/footer.php';

/**
 * Verify user password
 * 
 * @param string $username Username
 * @param string $password Password to verify
 * @return bool Whether password is valid
 */
function verifyPassword($username, $password) {
    $users = readJsonFile(USERS_FILE);
    
    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === hash('sha256', $password)) {
            return true;
        }
    }
    
    return false;
}

/**
 * Update user password
 * 
 * @param string $username Username
 * @param string $newPassword New password
 * @return bool Success status
 */
function updatePassword($username, $newPassword) {
    $users = readJsonFile(USERS_FILE);
    
    foreach ($users as &$user) {
        if ($user['username'] === $username) {
            $user['password'] = hash('sha256', $newPassword);
            return writeJsonFile(USERS_FILE, $users);
        }
    }
    
    return false;
}
