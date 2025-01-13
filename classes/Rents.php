<?php
class Rents {
    private $conn;
    private $table_name = "Rents";

    public $rent_id;
    public $user_id;
    public $boat_id;
    public $start_time;
    public $end_time;
    public $total_price;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Read all rents
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Create a new rent
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (user_id, boat_id, start_time, end_time, total_price) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->boat_id = htmlspecialchars(strip_tags($this->boat_id));
        $this->start_time = htmlspecialchars(strip_tags($this->start_time));
        $this->end_time = htmlspecialchars(strip_tags($this->end_time));
        $this->total_price = htmlspecialchars(strip_tags($this->total_price));

        $stmt->bind_param("iissd", $this->user_id, $this->boat_id, $this->start_time, $this->end_time, $this->total_price);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Update a rent
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET user_id = ?, boat_id = ?, start_time = ?, end_time = ?, total_price = ? WHERE rent_id = ?";
        $stmt = $this->conn->prepare($query);

        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->boat_id = htmlspecialchars(strip_tags($this->boat_id));
        $this->start_time = htmlspecialchars(strip_tags($this->start_time));
        $this->end_time = htmlspecialchars(strip_tags($this->end_time));
        $this->total_price = htmlspecialchars(strip_tags($this->total_price));
        $this->rent_id = htmlspecialchars(strip_tags($this->rent_id));

        $stmt->bind_param("iissdi", $this->user_id, $this->boat_id, $this->start_time, $this->end_time, $this->total_price, $this->rent_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete a rent
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE rent_id = ?";
        $stmt = $this->conn->prepare($query);

        $this->rent_id = htmlspecialchars(strip_tags($this->rent_id));

        $stmt->bind_param("i", $this->rent_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>