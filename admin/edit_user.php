<?php
include_once '../config/database.php';
include 'header.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Fetch user details
    $query = "SELECT * FROM Users WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $is_admin = isset($_POST['is_admin']) ? 1 : 0;

        // Update user details
        $query = "UPDATE Users SET username = ?, email = ?, is_admin = ? WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssii", $username, $email, $is_admin, $user_id);

        if ($stmt->execute()) {
            header("Location: users.php");
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }
    }
} else {
    header("Location: users.php");
    exit();
}
?>

<div class="container mt-5">
    <h1 class="display-4">Edit User</h1>
    <p class="lead">Edit user details.</p>
    <hr class="my-4">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" <?php echo $user['is_admin'] ? 'checked' : ''; ?>>
            <label class="form-check-label" for="is_admin">Admin</label>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>