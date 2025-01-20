<?php
session_start();
include_once '../config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$rent_id = $_GET['id'];

// Fetch rent details
$query = "SELECT * FROM Rents WHERE rent_id = ? AND user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $rent_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$rent = $result->fetch_assoc();

if (!$rent) {
    header("Location: current_rents.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $total_price = $_POST['total_price'];

    // Update rent details
    $query = "UPDATE Rents SET start_time = ?, end_time = ?, total_price = ? WHERE rent_id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssdii", $start_time, $end_time, $total_price, $rent_id, $user_id);

    if ($stmt->execute()) {
        header("Location: current_rents.php");
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }
}

// Fetch boat details
$query = "SELECT * FROM Boats WHERE boat_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $rent['boat_id']);
$stmt->execute();
$result = $stmt->get_result();
$boat = $result->fetch_assoc();
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h1 class="display-4">Edit Rent for <?php echo $boat['name']; ?></h1>
    <p class="lead">Update the rental duration for the boat.</p>
    <hr class="my-4">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST" action="">
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
            <input type="number" step="0.01" class="form-control" id="total_price" name="total_price" value="<?php echo $rent['total_price']; ?>" readonly required>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const startTimeInput = document.getElementById('start_time');
    const endTimeInput = document.getElementById('end_time');
    const totalPriceInput = document.getElementById('total_price');
    const pricePerHour = <?php echo $boat['price_per_hour']; ?>;

    function calculateTotalPrice() {
        const startTime = new Date(startTimeInput.value);
        const endTime = new Date(endTimeInput.value);

        if (startTime && endTime && !isNaN(pricePerHour)) {
            const hours = (endTime - startTime) / 36e5; // Convert milliseconds to hours
            const totalPrice = hours * pricePerHour;
            totalPriceInput.value = totalPrice.toFixed(2);
        } else {
            totalPriceInput.value = '';
        }
    }

    startTimeInput.addEventListener('input', calculateTotalPrice);
    endTimeInput.addEventListener('input', calculateTotalPrice);
});
</script>
</body>
</html>