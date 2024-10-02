<?php
require_once("inc/session.php");
require_once("inc/db.php");
require_once("inc/function.php");

// Check if the user is logged in
if (isset($_SESSION["userid"])) {
    $user_id = $_SESSION["userid"];

    try {
        // Update the is_online field to 0 for the logged-out user
        $sqlUpdateStatus = "UPDATE users SET is_online = 0 WHERE id = :user_id";
        $stmt = $conn->prepare($sqlUpdateStatus);
        $stmt->execute(['user_id' => $user_id]);

        // Clear session variables
        $_SESSION["userid"] = null;
        $_SESSION["username"] = null;

        // Destroy the session
        session_unset();
        session_destroy();

        // Redirect to login page
        Redirect_to("login.php");
    } catch (PDOException $e) {
        // Handle database-related errors
        echo "Failed to update offline status: " . htmlspecialchars($e->getMessage());
    }
} else {
    // If no user is logged in, just redirect to login page
    Redirect_to("login.php");
}
?>
