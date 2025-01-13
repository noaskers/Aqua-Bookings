<?php
include_once '../config/database.php';
include 'header.php';

// Fetch boats from the database
$query = "SELECT * FROM Boats";
$result = $conn->query($query);
?>

<div class="container mt-5">
    <h1 class="display-4">Manage Boats</h1>
    <p class="lead">Add, edit, or delete boats.</p>
    <hr class="my-4">
    <a href="add_boat.php" class="btn btn-primary mb-3">Add Boat</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price per Hour</th>
                <th>Available</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['boat_id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['price_per_hour']; ?></td>
                <td><?php echo $row['available'] ? 'Yes' : 'No'; ?></td>
                <td>
                    <a href="edit_boat.php?id=<?php echo $row['boat_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_boat.php?id=<?php echo $row['boat_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
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