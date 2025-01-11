<?php
// Infrastructure and Server Setup System
class InfrastructureAndServerSetup {
    public $serverType;
    public $hostingProvider;
    
    public function __construct($serverType, $hostingProvider) {
        $this->serverType = $serverType;
        $this->hostingProvider = $hostingProvider;
    }

    public function displayServerDetails() {
        echo "<h3>Infrastructure & Server Setup:</h3>";
        echo "<p>Server Type: " . $this->serverType . "</p>";
        echo "<p>Hosting Provider: " . $this->hostingProvider . "</p>";
    }
}

// Example usage
$infrastructure = new InfrastructureAndServerSetup("Dedicated Servers", "AWS");
$infrastructure->displayServerDetails();
?>
