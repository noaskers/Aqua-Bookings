<?php
include_once '../config/database.php';
include 'header.php'; 

// Fetch rents from the database with user and boat details
$query = "SELECT Rents.*, Users.username, Users.email, Boats.name AS boat_name FROM Rents 
          JOIN Users ON Rents.user_id = Users.user_id
          JOIN Boats ON Rents.boat_id = Boats.boat_id";
$result = $conn->query($query);
?>

<div class="container mt-5">
    <h1 class="display-4">Manage Rents</h1>
    <p class="lead">View and manage boat rentals.</p>
    <hr class="my-4">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
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
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
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