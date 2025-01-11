<?php

// BattleCore_Engine.php

class BattleCore_Engine {
    private $db;
    private $user_id;

    // Constructor to initialize database connection and user ID
    public function __construct($db, $user_id) {
        $this->db = $db;
        $this->user_id = $user_id;
    }

    // Start a battle between two players
    public function startBattle($attacker_id, $defender_id) {
        // Basic battle simulation
        $attacker = $this->getUserShips($attacker_id);
        $defender = $this->getUserShips($defender_id);

        // Simulate battle logic (simplified version)
        $attacker_strength = $this->calculateFleetStrength($attacker);
        $defender_strength = $this->calculateFleetStrength($defender);

        if ($attacker_strength > $defender_strength) {
            // Attacker wins
            $this->recordBattleResult($attacker_id, $defender_id, 'win');
            $this->recordBattleResult($defender_id, $attacker_id, 'loss');
            return 'Attacker wins!';
        } else {
            // Defender wins
            $this->recordBattleResult($attacker_id, $defender_id, 'loss');
            $this->recordBattleResult($defender_id, $attacker_id, 'win');
            return 'Defender wins!';
        }
    }

    // Get ships of a specific user
    public function getUserShips($user_id) {
        $query = "SELECT * FROM ships WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Calculate the fleet strength (simplified)
    public function calculateFleetStrength($ships) {
        $total_strength = 0;

        foreach ($ships as $ship) {
            // Add ship strength based on type and quantity (simplified)
            $ship_strength = $this->getShipStrength($ship['type']);
            $total_strength += $ship_strength * $ship['quantity'];
        }

        return $total_strength;
    }

    // Get the strength of a specific ship type
    public function getShipStrength($ship_type) {
        $strengths = [
            'fighter' => 100,
            'bomber' => 200,
            'cruiser' => 300,
            'destroyer' => 500,
            'battleship' => 700,
        ];

        return isset($strengths[$ship_type]) ? $strengths[$ship_type] : 0;
    }

    // Record battle result
    public function recordBattleResult($winner_id, $loser_id, $result) {
        $query = "INSERT INTO battle_logs (winner_id, loser_id, result) VALUES (:winner_id, :loser_id, :result)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':winner_id', $winner_id, PDO::PARAM_INT);
        $stmt->bindParam(':loser_id', $loser_id, PDO::PARAM_INT);
        $stmt->bindParam(':result', $result, PDO::PARAM_STR);
        $stmt->execute();
    }
}

?>
