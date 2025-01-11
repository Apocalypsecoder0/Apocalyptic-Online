<?php

// PlanetsCore_Engine.php

class PlanetsCore_Engine {
    private $db;
    private $user_id;

    // Constructor to initialize database connection and user ID
    public function __construct($db, $user_id) {
        $this->db = $db;
        $this->user_id = $user_id;
    }

    // Get all planets for the user
    public function getUserPlanets() {
        $query = "SELECT * FROM planets WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a specific planet's information
    public function getPlanetInfo($planet_id) {
        $query = "SELECT * FROM planets WHERE planet_id = :planet_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':planet_id', $planet_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get resources for a specific planet
    public function getPlanetResources($planet_id) {
        $query = "SELECT * FROM resources WHERE planet_id = :planet_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':planet_id', $planet_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update resources for a specific planet
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
    public function addPlanet($star_system_id, $name, $coordinates) {
        $query = "INSERT INTO planets (star_system_id, user_id, name, coordinates) VALUES (:star_system_id, :user_id, :name, :coordinates)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':star_system_id', $star_system_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $this->user_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':coordinates', $coordinates, PDO::PARAM_STR);
        $stmt->execute();
        
        return $this->db->lastInsertId(); // Return the ID of the new planet
    }

    // Add a building or structure to a planet
    public function buildStructure($planet_id, $structure_type, $level) {
        // Check if the structure exists for the planet
        $query = "SELECT * FROM structures WHERE planet_id = :planet_id AND structure_type = :structure_type";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':planet_id', $planet_id, PDO::PARAM_INT);
        $stmt->bindParam(':structure_type', $structure_type, PDO::PARAM_STR);
        $stmt->execute();
        
        $existing_structure = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($existing_structure) {
            // Update the existing structure level
            $query = "UPDATE structures SET level = :level WHERE planet_id = :planet_id AND structure_type = :structure_type";
        } else {
            // Add a new structure
            $query = "INSERT INTO structures (planet_id, structure_type, level) VALUES (:planet_id, :structure_type, :level)";
        }

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':planet_id', $planet_id, PDO::PARAM_INT);
        $stmt->bindParam(':structure_type', $structure_type, PDO::PARAM_STR);
        $stmt->bindParam(':level', $level, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Get all structures on a planet
    public function getPlanetStructures($planet_id) {
        $query = "SELECT * FROM structures WHERE planet_id = :planet_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':planet_id', $planet_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Upgrade a specific structure on a planet
    public function upgradeStructure($planet_id, $structure_type) {
        $query = "SELECT level FROM structures WHERE planet_id = :planet_id AND structure_type = :structure_type";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':planet_id', $planet_id, PDO::PARAM_INT);
        $stmt->bindParam(':structure_type', $structure_type, PDO::PARAM_STR);
        $stmt->execute();

        $structure = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($structure) {
            $new_level = $structure['level'] + 1;
            $update_query = "UPDATE structures SET level = :new_level WHERE planet_id = :planet_id AND structure_type = :structure_type";
            $update_stmt = $this->db->prepare($update_query);
            $update_stmt->bindParam(':planet_id', $planet_id, PDO::PARAM_INT);
            $update_stmt->bindParam(':structure_type', $structure_type, PDO::PARAM_STR);
            $update_stmt->bindParam(':new_level', $new_level, PDO::PARAM_INT);
            $update_stmt->execute();
        } else {
            // The structure doesn't exist, so add it
            $this->buildStructure($planet_id, $structure_type, 1); // Start from level 1
        }
    }

    // Collect resources from a planet
    public function collectResources($planet_id) {
        $resources = $this->getPlanetResources($planet_id);

        // Simulate resource collection (you can adjust this logic)
        $metal = $resources['metal'] + rand(100, 500);
        $crystal = $resources['crystal'] + rand(100, 500);
        $deuterium = $resources['deuterium'] + rand(50, 300);

        $this->updatePlanetResources($planet_id, $metal, $crystal, $deuterium);

        return ['metal' => $metal, 'crystal' => $crystal, 'deuterium' => $deuterium];
    }

    // Get planet's defense structures
    public function getPlanetDefenseStructures($planet_id) {
        $query = "SELECT * FROM defense_structures WHERE planet_id = :planet_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':planet_id', $planet_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add or upgrade defense structures on a planet
    public function addDefenseStructure($planet_id, $defense_type, $level) {
        $query = "SELECT * FROM defense_structures WHERE planet_id = :planet_id AND defense_type = :defense_type";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':planet_id', $planet_id, PDO::PARAM_INT);
        $stmt->bindParam(':defense_type', $defense_type, PDO::PARAM_STR);
        $stmt->execute();

        $existing_defense = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing_defense) {
            // Upgrade the defense structure level
            $query = "UPDATE defense_structures SET level = :level WHERE planet_id = :planet_id AND defense_type = :defense_type";
        } else {
            // Add a new defense structure
            $query = "INSERT INTO defense_structures (planet_id, defense_type, level) VALUES (:planet_id, :defense_type, :level)";
        }

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':planet_id', $planet_id, PDO::PARAM_INT);
        $stmt->bindParam(':defense_type', $defense_type, PDO::PARAM_STR);
        $stmt->bindParam(':level', $level, PDO::PARAM_INT);
        $stmt->execute();
    }
}

?>
