<?php
// session_helper.php - Helper functions for session management
// Based on the chapter 14 examples structure

// Start session if not already started
function startSession() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

// Store data in session
function storeInSession($key, $value) {
    startSession();
    $_SESSION[$key] = $value;
}

// Get data from session
function getFromSession($key, $default = null) {
    startSession();
    return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
}

// Check if session key exists
function sessionExists($key) {
    startSession();
    return isset($_SESSION[$key]);
}

// Clear specific session data
function clearSessionData($key) {
    startSession();
    if (isset($_SESSION[$key])) {
        unset($_SESSION[$key]);
    }
}

// Clear all session data
function clearAllSessionData() {
    startSession();
    session_destroy();
}

// Display session information (for debugging)
function displaySessionInfo() {
    startSession();
    echo "<div style='background-color: #f0f0f0; padding: 10px; margin: 10px 0; border: 1px solid #ccc;'>";
    echo "<h4>Session Information:</h4>";
    echo "<p><strong>Session ID:</strong> " . session_id() . "</p>";
    echo "<p><strong>Session Status:</strong> " . (session_status() == PHP_SESSION_ACTIVE ? 'Active' : 'Inactive') . "</p>";
    echo "<p><strong>Session Data:</strong></p>";
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
    echo "</div>";
}

// Add item to session array
function addToSessionArray($key, $value) {
    startSession();
    if (!isset($_SESSION[$key])) {
        $_SESSION[$key] = array();
    }
    if (!in_array($value, $_SESSION[$key])) {
        $_SESSION[$key][] = $value;
    }
}

// Remove item from session array
function removeFromSessionArray($key, $value) {
    startSession();
    if (isset($_SESSION[$key]) && is_array($_SESSION[$key])) {
        $index = array_search($value, $_SESSION[$key]);
        if ($index !== false) {
            unset($_SESSION[$key][$index]);
            $_SESSION[$key] = array_values($_SESSION[$key]); // Reindex array
        }
    }
}

// Get session array count
function getSessionArrayCount($key) {
    startSession();
    return isset($_SESSION[$key]) && is_array($_SESSION[$key]) ? count($_SESSION[$key]) : 0;
}

// Check if value exists in session array
function inSessionArray($key, $value) {
    startSession();
    return isset($_SESSION[$key]) && is_array($_SESSION[$key]) && in_array($value, $_SESSION[$key]);
}

?>
