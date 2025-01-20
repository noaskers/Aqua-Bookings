<?php
include_once '../config/database.php';

if (isset($_GET['id'])) {
    $rent_id = $_GET['id'];

    // Fetch the boat_id associated with the rent
    $query = "SELECT boat_id FROM Rents WHERE rent_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $rent_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $rent = $result->fetch_assoc();
    $boat_id = $rent['boat_id'];

    // Delete rent
    $query = "DELETE FROM Rents WHERE rent_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $rent_id);

    if ($stmt->execute()) {
        // Update boat availability
        $query = "UPDATE Boats SET available = 1 WHERE boat_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $boat_id);
        $stmt->execute();

        header("Location: current_rents.php");
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }
} else {
    header("Location: current_rents.php");
    exit();
}
?>