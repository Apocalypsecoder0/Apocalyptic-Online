<?php

// UniverseCore_Engine.php

class UniverseCore_Engine {
    private $db;
    private $user_id;

    // Constructor to initialize database connection and user ID
    public function __construct($db, $user_id) {
        $this->db = $db;
        $this->user_id = $user_id;
    }

    // Get all galaxies
    public function getAllGalaxies() {
        $query = "SELECT * FROM galaxies";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a specific galaxy's information
    public function getGalaxyInfo($galaxy_id) {
        $query = "SELECT * FROM galaxies WHERE galaxy_id = :galaxy_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':galaxy_id', $galaxy_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all star systems within a galaxy
    public function getStarSystems($galaxy_id) {
        $query = "SELECT * FROM star_systems WHERE galaxy_id = :galaxy_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':galaxy_id', $galaxy_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get all planets in a star system
    public function getPlanetsInSystem($star_system_id) {
        $query = "SELECT * FROM planets WHERE star_system_id = :star_system_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':star_system_id', $star_system_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new galaxy (if needed)
    public function addGalaxy($name, $galaxy_coordinates) {
        $query = "INSERT INTO galaxies (name, coordinates) VALUES (:name, :coordinates)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':coordinates', $galaxy_coordinates, PDO::PARAM_STR);
        $stmt->execute();
        
        return $this->db->lastInsertId(); // Return the ID of the new galaxy
    }

    // Add a star system to a galaxy
    public function addStarSystem($galaxy_id, $name, $coordinates) {
        $query = "INSERT INTO star_systems (galaxy_id, name, coordinates) VALUES (:galaxy_id, :name, :coordinates)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':galaxy_id', $galaxy_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':coordinates', $coordinates, PDO::PARAM_STR);
        $stmt->execute();
        
        return $this->db->lastInsertId(); // Return the ID of the new star system
    }

    // Add a new planet in a star system
    public function addPlanet($star_system_id, $name, $coordinates) {
        $query = "INSERT INTO planets (star_system_id, name, coordinates) VALUES (:star_system_id, :name, :coordinates)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':star_system_id', $star_system_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':coordinates', $coordinates, PDO::PARAM_STR);
        $stmt->execute();
        
        return $this->db->lastInsertId(); // Return the ID of the new planet
    }

    // Get all players within a specific galaxy
    public function getPlayersInGalaxy($galaxy_id) {
        $query = "SELECT * FROM players WHERE galaxy_id = :galaxy_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':galaxy_id', $galaxy_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get interactions between players in a galaxy
    public function getPlayerInteractions($galaxy_id) {
        $query = "SELECT * FROM player_interactions WHERE galaxy_id = :galaxy_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':galaxy_id', $galaxy_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Send fleet across galaxies (for inter-galactic movement)
    public function sendFleetAcrossGalaxies($fleet_id, $target_galaxy_id, $target_planet_id) {
        $query = "UPDATE fleets SET target_galaxy_id = :target_galaxy_id, target_planet_id = :target_planet_id, mission_status = 'in_progress' WHERE fleet_id = :fleet_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':fleet_id', $fleet_id, PDO::PARAM_INT);
        $stmt->bindParam(':target_galaxy_id', $target_galaxy_id, PDO::PARAM_INT);
        $stmt->bindParam(':target_planet_id', $target_planet_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Handle space exploration missions
    public function initiateSpaceExploration($user_id, $star_system_id, $mission_type) {
        $query = "INSERT INTO space_exploration (user_id, star_system_id, mission_type, status) VALUES (:user_id, :star_system_id, :mission_type, 'initiated')";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':star_system_id', $star_system_id, PDO::PARAM_INT);
        $stmt->bindParam(':mission_type', $mission_type, PDO::PARAM_STR);
        $stmt->execute();
    }

    // Get space exploration status for a player
    public function getSpaceExplorationStatus($user_id) {
        $query = "SELECT * FROM space_exploration WHERE user_id = :user_id AND status = 'initiated'";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
