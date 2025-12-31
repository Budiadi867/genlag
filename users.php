<?php
// User management page
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/auth.php';

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in and is admin
checkAdminAccess();

// Process add user form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $username = sanitizeInput($_POST['username']);
    $password = $_POST['password'];
    $role = sanitizeInput($_POST['role'] ?? 'user');
    
    if (empty($username) || empty($password)) {
        $error = 'Username dan password harus diisi.';
    } else {
        // Add new user
        if (addUser($username, $password, $role)) {
            $success = 'Pengguna berhasil ditambahkan.';
        } else {
            $error = 'Gagal menambahkan pengguna.';
        }
    }
}

// Process delete user form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $username = sanitizeInput($_POST['username']);
    
    if (empty($username)) {
        $error = 'Username harus diisi.';
    } else {
        // Delete user
        if (deleteUser($username)) {
            $success = 'Pengguna berhasil dihapus.';
        } else {
            $error = 'Gagal menghapus pengguna.';
        }
    }
}

// Get all users
$users = readJsonFile(USERS_FILE);

// Include header
include __DIR__ . '/templates/header.php';

// Include users template
include __DIR__ . '/templates/users.php';

// Include footer
include __DIR__ . '/templates/footer.php';

/**
 * Add a new user
 * 
 * @param string $username Username
 * @param string $password Password (will be hashed)
 * @param string $role User role
 * @return bool Success status
 */
function addUser($username, $password, $role = 'user') {
    // Check if username already exists
    $users = readJsonFile(USERS_FILE);
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            return false; // Username already exists
        }
    }
    
    // Add new user
    $users[] = [
        'username' => $username,
        'password' => hash('sha256', $password),
        'role' => $role
    ];
    
    return writeJsonFile(USERS_FILE, $users);
}

/**
 * Delete a user
 * 
 * @param string $username Username
 * @return bool Success status
 */
function deleteUser($username) {
    $users = readJsonFile(USERS_FILE);
    $newUsers = [];
    $found = false;
    
    // Don't allow deleting the last admin
    $adminCount = 0;
    foreach ($users as $user) {
        if (($user['role'] ?? 'user') === 'admin') {
            $adminCount++;
        }
    }
    
    foreach ($users as $user) {
        if ($user['username'] !== $username) {
            $newUsers[] = $user;
        } else {
            $found = true;
            // If we're trying to delete an admin, check if it's the last one
            if (($user['role'] ?? 'user') === 'admin' && $adminCount <= 1) {
                return false; // Cannot delete the last admin
            }
        }
    }
    
    if ($found) {
        return writeJsonFile(USERS_FILE, $newUsers);
    }
    
    return false;
}

