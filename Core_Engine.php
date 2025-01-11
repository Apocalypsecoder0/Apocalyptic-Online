<?php

// Core_Engine.php

class Core_Engine {
    private $db;
    private $user_id;

    // Constructor to initialize database connection and user ID
    public function __construct($db, $user_id) {
        $this->db = $db;
        $this->user_id = $user_id;
    }

    // Get user information
    public function getUserInfo() {
        $query = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update user resources
    public function updateUserResources($metal, $crystal, $deuterium) {
        $query = "UPDATE users SET metal = :metal, crystal = :crystal, deuterium = :deuterium WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->bindParam(':metal', $metal, PDO::PARAM_INT);
        $stmt->bindParam(':crystal', $crystal, PDO::PARAM_INT);
        $stmt->bindParam(':deuterium', $deuterium, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Get current game time (for turn-based or real-time gameplay)
    public function getCurrentGameTime() {
        $query = "SELECT NOW() as current_time";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get leaderboard
    public function getLeaderboard() {
        $query = "SELECT user_id, username, score FROM users ORDER BY score DESC LIMIT 10";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
