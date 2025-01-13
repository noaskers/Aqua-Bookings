<?php
include_once '../config/database.php';

if (isset($_GET['id'])) {
    $rent_id = $_GET['id'];

    // Delete rent
    $query = "DELETE FROM Rents WHERE rent_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $rent_id);

    if ($stmt->execute()) {
        header("Location: rents.php");
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }
} else {
    header("Location: rents.php");
    exit();
}
?>