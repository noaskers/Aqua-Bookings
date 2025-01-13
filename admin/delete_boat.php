<?php
include_once '../config/database.php';

if (isset($_GET['id'])) {
    $boat_id = $_GET['id'];

    // Delete boat
    $query = "DELETE FROM Boats WHERE boat_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $boat_id);

    if ($stmt->execute()) {
        header("Location: boats.php");
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }
} else {
    header("Location: boats.php");
    exit();
}
?>