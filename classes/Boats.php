<?php
class Boats {
    private $conn;
    private $table_name = "Boats";

    public $boat_id;
    public $name;
    public $description;
    public $price_per_hour;
    public $available;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Read all boats
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Create a new boat
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (name, description, price_per_hour, available) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price_per_hour = htmlspecialchars(strip_tags($this->price_per_hour));
        $this->available = htmlspecialchars(strip_tags($this->available));

        $stmt->bind_param("ssdi", $this->name, $this->description, $this->price_per_hour, $this->available);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Update a boat
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET name = ?, description = ?, price_per_hour = ?, available = ? WHERE boat_id = ?";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price_per_hour = htmlspecialchars(strip_tags($this->price_per_hour));
        $this->available = htmlspecialchars(strip_tags($this->available));
        $this->boat_id = htmlspecialchars(strip_tags($this->boat_id));

        $stmt->bind_param("ssdii", $this->name, $this->description, $this->price_per_hour, $this->available, $this->boat_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete a boat
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE boat_id = ?";
        $stmt = $this->conn->prepare($query);

        $this->boat_id = htmlspecialchars(strip_tags($this->boat_id));

        $stmt->bind_param("i", $this->boat_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>