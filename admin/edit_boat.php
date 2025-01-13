<?php
include_once '../config/database.php';
include 'header.php';

if (isset($_GET['id'])) {
    $boat_id = $_GET['id'];

    // Fetch boat details
    $query = "SELECT * FROM Boats WHERE boat_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $boat_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $boat = $result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price_per_hour = $_POST['price_per_hour'];
        $available = isset($_POST['available']) ? 1 : 0;

        // Update boat details
        $query = "UPDATE Boats SET name = ?, description = ?, price_per_hour = ?, available = ? WHERE boat_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssdii", $name, $description, $price_per_hour, $available, $boat_id);

        if ($stmt->execute()) {
            header("Location: boats.php");
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }
    }
} else {
    header("Location: boats.php");
    exit();
}
?>

<div class="container mt-5">
    <h1 class="display-4">Edit Boat</h1>
    <p class="lead">Edit boat details.</p>
    <hr class="my-4">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $boat['name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required><?php echo $boat['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="price_per_hour">Price per Hour</label>
            <input type="number" step="0.01" class="form-control" id="price_per_hour" name="price_per_hour" value="<?php echo $boat['price_per_hour']; ?>" required>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="available" name="available" <?php echo $boat['available'] ? 'checked' : ''; ?>>
            <label class="form-check-label" for="available">Available</label>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>