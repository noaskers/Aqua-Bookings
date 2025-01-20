<?php
class User {
    private $conn;
    private $table_name = "Users";

    public $user_id;
    public $username;Wat is overerving in OOP?

    public $password;
    public $email;
    public $is_admin;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Read all users
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Create a new user
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (username, password, email, is_admin) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->is_admin = htmlspecialchars(strip_tags($this->is_admin));

        $stmt->bind_param("sssi", $this->username, $this->password, $this->email, $this->is_admin);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Update a user
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET username = ?, password = ?, email = ?, is_admin = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->is_admin = htmlspecialchars(strip_tags($this->is_admin));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));

        $stmt->bind_param("sssii", $this->username, $this->password, $this->email, $this->is_admin, $this->user_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete a user
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);

        $this->user_id = htmlspecialchars(strip_tags($this->user_id));

        $stmt->bind_param("i", $this->user_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>