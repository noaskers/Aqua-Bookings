<?php
include_once '../config/database.php';
include 'header.php';
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active">Dashboard</a>
                <a href="boats.php" class="list-group-item list-group-item-action">Boats</a>
                <a href="rents.php" class="list-group-item list-group-item-action">Rents</a>
                <a href="users.php" class="list-group-item list-group-item-action">Users</a>
                <a href="settings.php" class="list-group-item list-group-item-action">Settings</a>
            </div>
        </div>
        <div class="col-md-9">
            <h1 class="display-4">Admin Dashboard</h1>
            <p class="lead">Manage boats, rents, and users from this dashboard.</p>
            <hr class="my-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Boats</div>
                        <div class="card-body">
                            <h5 class="card-title">Manage Boats</h5>
                            <p class="card-text">Add, edit, or delete boats.</p>
                            <a href="boats.php" class="btn btn-light">Go to Boats</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Rents</div>
                        <div class="card-body">
                            <h5 class="card-title">Manage Rents</h5>
                            <p class="card-text">View and manage boat rentals.</p>
                            <a href="rents.php" class="btn btn-light">Go to Rents</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-header">Users</div>
                        <div class="card-body">
                            <h5 class="card-title">Manage Users</h5>
                            <p class="card-text">View and manage users.</p>
                            <a href="users.php" class="btn btn-light">Go to Users</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>