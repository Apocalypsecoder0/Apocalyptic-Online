<?php
// Database Design Class
class DatabaseDesign {
    public $dbType;
    public $tables;
    
    public function __construct($dbType, $tables) {
        $this->dbType = $dbType;
        $this->tables = $tables;
    }

    public function displayDatabaseDetails() {
        echo "<h3>Database Design:</h3>";
        echo "<p>Database Type: " . $this->dbType . "</p>";
        echo "<h4>Tables:</h4><ul>";
        foreach ($this->tables as $table) {
            echo "<li>" . $table . "</li>";
        }
        echo "</ul>";
    }
}

// Example usage
$database = new DatabaseDesign("MySQL", ["Users", "Transactions", "Fleet"]);
$database->displayDatabaseDetails();
?>
