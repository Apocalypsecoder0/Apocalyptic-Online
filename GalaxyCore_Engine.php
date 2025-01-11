<?php

// GalaxyCore_Engine.php

class GalaxyCore_Engine {
    private $db; // Database connection
    private $user_id;

    // Constructor to initialize database connection and user ID
    public function __construct($db, $user_id) {
        $this->db = $db;
        $this->user_id = $user_id;
    }

    // Get the user's planets
    public function getUserPlanets() {
        $query = "SELECT * FROM planets WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get the resources of a specific planet
    public function getPlanetResources($planet_id) {
        $query = "SELECT metal, crystal, deuterium FROM resources WHERE planet_id = :planet_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':planet_id', $planet_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update resources of a planet
    public function updatePlanetResources($planet_id, $metal, $crystal, $deuterium) {
        $query = "UPDATE resources SET metal = :metal, crystal = :crystal, deuterium = :deuterium WHERE planet_id = :planet_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':planet_id', $planet_id, PDO::PARAM_INT);
        $stmt->bindParam(':metal', $metal, PDO::PARAM_INT);
        $stmt->bindParam(':crystal', $crystal, PDO::PARAM_INT);
        $stmt->bindParam(':deuterium', $deuterium, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Add a new planet
    public function addPlanet($name, $x, $y, $z) {
        $query = "INSERT INTO planets (user_id, name, x, y, z) VALUES (:user_id, :name, :x, :y, :z)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':x', $x, PDO::PARAM_INT);
        $stmt->bindParam(':y', $y, PDO::PARAM_INT);
        $stmt->bindParam(':z', $z, PDO::PARAM_INT);
        $stmt->execute();
        
        return $this->db->lastInsertId(); // Return the ID of the new planet
    }

    // Get fleet details for a specific user
    public function getUserFleets() {
        $query = "SELECT * FROM fleets WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create or update a fleet
    public function manageFleet($fleet_id, $planet_id, $ship_type, $quantity, $mission) {
        $query = $fleet_id ? 
            "UPDATE fleets SET planet_id = :planet_id, ship_type = :ship_type, quantity = :quantity, mission = :mission WHERE fleet_id = :fleet_id" :
            "INSERT INTO fleets (user_id, planet_id, ship_type, quantity, mission) VALUES (:user_id, :planet_id, :ship_type, :quantity, :mission)";
        
        $stmt = $this->db->prepare($query);
        
        if ($fleet_id) {
            $stmt->bindParam(':fleet_id', $fleet_id, PDO::PARAM_INT);
        }
        
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->bindParam(':planet_id', $planet_id, PDO::PARAM_INT);
        $stmt->bindParam(':ship_type', $ship_type, PDO::PARAM_STR);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':mission', $mission, PDO::PARAM_STR);
        
        $stmt->execute();
    }

    // Handle fleet movements or missions
    public function sendFleetOnMission($fleet_id, $target_planet_id) {
        $query = "UPDATE fleets SET target_planet_id = :target_planet_id, mission_status = 'in_progress' WHERE fleet_id = :fleet_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':fleet_id', $fleet_id, PDO::PARAM_INT);
        $stmt->bindParam(':target_planet_id', $target_planet_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Return available technology tree (just a simple example)
    public function getTechnologyTree() {
        $query = "SELECT * FROM technologies";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
