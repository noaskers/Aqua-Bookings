<?php
session_start();
include_once '../config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch rents for the logged-in user with boat names
$query = "SELECT Rents.*, Boats.name AS boat_name FROM Rents 
          JOIN Boats ON Rents.boat_id = Boats.boat_id 
          WHERE Rents.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h1 class="display-4">Current Rents</h1>
    <p class="lead">View and manage your current rents.</p>
    <hr class="my-4">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Boat Name</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Total Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['rent_id']; ?></td>
                <td><?php echo $row['boat_name']; ?></td>
                <td><?php echo $row['start_time']; ?></td>
                <td><?php echo $row['end_time']; ?></td>
                <td><?php echo $row['total_price']; ?></td>
                <td>
                    <a href="edit_rent.php?id=<?php echo $row['rent_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_rent.php?id=<?php echo $row['rent_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>