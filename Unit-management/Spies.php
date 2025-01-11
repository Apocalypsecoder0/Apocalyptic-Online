<?php
require_once 'db.php';

class Spies {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function trainSpies($quantity) {
        try {
            $query = "INSERT INTO spies (type, quantity) 
                      VALUES ('Covert Agent', :quantity)
                      ON DUPLICATE KEY UPDATE quantity = quantity + :quantity";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':quantity', $quantity);

            $stmt->execute();
            return "$quantity spies trained successfully!";
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function deploySpies($target, $mission) {
        try {
            // Logic to deploy spies
            return "Spies deployed to $target for mission: $mission.";
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}

// Example Usage
$spies = new Spies();
echo $spies->trainSpies(20);
?>
