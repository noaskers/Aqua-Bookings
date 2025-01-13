<?php
include_once '../config/database.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Delete associated rents
    $query = "DELETE FROM Rents WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Delete user
    $query = "DELETE FROM Users WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        header("Location: users.php");
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }
} else {
    header("Location: users.php");
    exit();
}
?>