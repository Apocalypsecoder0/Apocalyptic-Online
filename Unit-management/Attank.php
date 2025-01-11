<?php
require_once 'db.php';

class AttackTroops {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function trainAttackTroops($troopType, $quantity) {
        try {
            $query = "INSERT INTO troops (type, quantity) 
                      VALUES (:type, :quantity)
                      ON DUPLICATE KEY UPDATE quantity = quantity + :quantity";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':type', $troopType);
            $stmt->bindParam(':quantity', $quantity);

            $stmt->execute();
            return "$quantity $troopType trained successfully!";
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function deployAttackTroops($troopType, $quantity, $target) {
        try {
            // Check if there are enough troops available
            $query = "SELECT quantity FROM troops WHERE type = :type";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':type', $troopType);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && $result['quantity'] >= $quantity) {
                // Reduce troops and deploy
                $query = "UPDATE troops SET quantity = quantity - :quantity WHERE type = :type";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':type', $troopType);
                $stmt->bindParam(':quantity', $quantity);
                $stmt->execute();

                return "$quantity $troopType deployed to $target!";
            } else {
                return "Not enough $troopType available.";
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}

// Example Usage
$attack = new AttackTroops();
echo $attack->trainAttackTroops("Super Attack Troop", 100);
echo $attack->deployAttackTroops("Super Attack Troop", 50, "Enemy Base");
?>
