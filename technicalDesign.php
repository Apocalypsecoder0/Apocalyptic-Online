<?php
// Technical Design Class
class TechnicalDesign {
    public $infrastructureAndServerSetup;
    public $databaseDesign;
    public $realTimeCommunication;
    
    public function __construct($infrastructureAndServerSetup, $databaseDesign, $realTimeCommunication) {
        $this->infrastructureAndServerSetup = $infrastructureAndServerSetup;
        $this->databaseDesign = $databaseDesign;
        $this->realTimeCommunication = $realTimeCommunication;
    }

    public function displayTechnicalDesign() {
        echo "<h3>Technical Design:</h3>";
        echo "<p>Infrastructure & Server Setup: " . $this->infrastructureAndServerSetup . "</p>";
        echo "<p>Database Design: " . $this->databaseDesign . "</p>";
        echo "<p>Real-Time Communication: " . $this->realTimeCommunication . "</p>";
    }
}

// Example usage
$technical = new TechnicalDesign("Dedicated Servers, Cloud Infrastructure", "SQL Database for User Data", "WebSocket for Real-Time Chat");
$technical->displayTechnicalDesign();
?>
