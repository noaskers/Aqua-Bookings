<?php
include_once '../config/database.php';
include 'header.php';

if (isset($_GET['id'])) {
    $rent_id = $_GET['id'];

    // Fetch rent details
    $query = "SELECT * FROM Rents WHERE rent_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $rent_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $rent = $result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_POST['user_id'];
        $boat_id = $_POST['boat_id'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        $total_price = $_POST['total_price'];

        // Update rent details
        $query = "UPDATE Rents SET user_id = ?, boat_id = ?, start_time = ?, end_time = ?, total_price = ? WHERE rent_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iissdi", $user_id, $boat_id, $start_time, $end_time, $total_price, $rent_id);

        if ($stmt->execute()) {
            header("Location: rents.php");
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }
    }
} else {
    header("Location: rents.php");
    exit();
}
?>

<div class="container mt-5">
    <h1 class="display-4">Edit Rent</h1>
    <p class="lead">Edit rent details.</p>
    <hr class="my-4">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="form-group">
            <label for="user_id">User ID</label>
            <input type="number" class="form-control" id="user_id" name="user_id" value="<?php echo $rent['user_id']; ?>" required>
        </div>
        <div class="form-group">
            <label for="boat_id">Boat ID</label>
            <input type="number" class="form-control" id="boat_id" name="boat_id" value="<?php echo $rent['boat_id']; ?>" required>
        </div>
        <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="datetime-local" class="form-control" id="start_time" name="start_time" value="<?php echo date('Y-m-d\TH:i', strtotime($rent['start_time'])); ?>" required>
        </div>
        <div class="form-group">
            <label for="end_time">End Time</label>
            <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="<?php echo date('Y-m-d\TH:i', strtotime($rent['end_time'])); ?>" required>
        </div>
        <div class="form-group">
            <label for="total_price">Total Price</label>
            <input type="number" step="0.01" class="form-control" id="total_price" name="total_price" value="<?php echo $rent['total_price']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>