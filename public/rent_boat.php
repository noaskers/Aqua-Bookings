<?php
session_start();
include_once '../config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch available boats
$query = "SELECT * FROM Boats WHERE available = 1";
$result = $conn->query($query);
$boats = [];
while ($row = $result->fetch_assoc()) {
    $boats[] = $row;
}
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h1 class="display-4">Rent a Boat</h1>
    <p class="lead">Select a boat to rent.</p>
    <hr class="my-4">
    <div class="row">
        <?php foreach ($boats as $boat): ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $boat['name']; ?></h5>
                    <p class="card-text"><?php echo $boat['description']; ?></p>
                    <p class="card-text"><strong>$<?php echo $boat['price_per_hour']; ?>/hour</strong></p>
                    <a href="rent_boat_duration.php?boat_id=<?php echo $boat['boat_id']; ?>" class="btn btn-primary">Rent Boat</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>